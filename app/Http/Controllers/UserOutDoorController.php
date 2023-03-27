<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Deposit;
use App\Models\Trader7;

use App\Mail\NewNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;


class UserOutDoorController extends Controller
{

    public function ragapayNotifications(Request $request)
    {
        $data = $request->all();
        $currency = Setting::getValue('currency');
        $site_name = Setting::getValue('site_name');
        $deposit_email = Setting::getValue('deposit_email');

        // $objDemo = new \stdClass();
        // $objDemo->sender = "Test Xpro";
        // $objDemo->date = Carbon::Now();
        // $objDemo->subject = "Data from RagaPay on calling our callback url.";
        // $objDemo->message = json_encode($data);

        // Mail::bcc($deposit_email)->send(new NewNotification($objDemo));

        $order_number = explode('-', $data['order_number']);
        $txn_id = $data['id'];

        $t7_id = $order_number[2];
        $t7 = Trader7::find($t7_id);
        $user = $t7->tuser();
        $amount = $data['order_amount'];

        $deposit = Deposit::find($order_number[1]);
        $deposit->amount = $amount;
        $deposit->txn_id = $txn_id;
        $deposit->save();

        $msg = 'We are processing your payment, check back later. ' . $data['reason'];

        if(strtolower($data['type']) == 'sale' && $data['status'] == 'success' && $deposit->status == 'Pending') {
            $respT7 = $this->performTransaction($data['order_currency'], $t7->number, $amount, 'MM-Ragapay', 'MM-AUTORP-'.$txn_id, 'deposit', 'balance');

            if(gettype($respT7) !== 'integer') {
                $msg = 'Please contact support immediately, an unexpected error has occured but we got your funds.';
                return json_encode(['status' => false, 'message' => $msg]);
            } else {
                $deposit->status = 'Processed';
                $deposit->save();
                $t7->balance += $amount;
                $t7->save();

                //save transaction
                $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                //send email notification to user
                $currency = Setting::getValue('currency');
                $site_name = Setting::getValue('site_name');
                $objDemo = new \stdClass();

                $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
                $objDemo->message = "\r Hello $name, \r\n

                \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                $objDemo->sender = "$site_name";
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Deposit Processed!";

                Mail::bcc($user->email)->send(new NewNotification($objDemo));
                $msg = 'Your deposit was successfully processed!';

                //send email notification to admin
                $objDemo = new \stdClass();
                $objDemo->message = "\r Hello Admin, \r\n" .
                    "\r This is to inform you of a successful deposit of $currency$amount with deposit id $order_number[1] to account number $t7->number by user $name, that just occured on your system through Ragapay. \r\n" .
                    "\r Please no extra action is needed at this time(auto-deposit) \r\n";
                $objDemo->sender = 'RagaPay Deposit: ' . $site_name;
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Action Needed: Successful RagaPay Deposit";
                Mail::mailer('smtp')->bcc($deposit_email)->send(new NewNotification($objDemo));
            }
        }

        return json_encode(['status' => true, 'message' => $msg]);
    }


    public function verifyChargeMoneyCharge(Request $request)
    {
        $data = $request->all();
        $deposit_email = Setting::getValue('deposit_email');

        // $objDemo = new \stdClass();
        // $objDemo->sender = "Test Xpro";
        // $objDemo->date = Carbon::Now();
        // $objDemo->subject = "Data from ChargeMoney on calling our callback url.";
        // $objDemo->message = json_encode($data);

        // Mail::bcc($deposit_email)->send(new NewNotification($objDemo));

        $order_number = explode('-', $data['customer_order_id']);
        $user = User::find($order_number[2]);
        $dp = $user->dp()->latest()->first();

        $t7_id = $order_number[0];

        $t7 = Trader7::find($t7_id);

        if ($data['status'] == 'success') {
            $amt = $dp->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-ChargeMoney', 'MM-AUTOCM', 'deposit', 'balance');
            if(gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support! ');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // update the deposit
            $dp->status = "Processed";
            $dp->save();

            // send email notification to user
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            //send email notification to admin
            $objDemo = new \stdClass();
            $objDemo->message = "\r Hello Admin, \r\n" .
                "\r This is to inform you of a successful deposit of $currency$amt with deposit id $order_number[1] to account number $t7->number by user $name, that just occured on your system through Ragapay. \r\n" .
                "\r Please no extra action is needed at this time(auto-deposit) \r\n";
            $objDemo->sender = 'RagaPay Deposit: ' . $site_name;
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Action Needed: Successful RagaPay Deposit";
            Mail::mailer('smtp')->bcc($deposit_email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } else {
            return redirect()->back()->with('message', $data['message']);
        }
    }


    public function handlePaycly(Request $request)
    {
        $data = $request->all();
        $order_number = explode('-', $data['id_order']);
        $t7_id = $order_number[2];
        $t7 = Trader7::find($t7_id);
        $deposit_email = Setting::getValue('deposit_email');

        // $objDemo = new \stdClass();
        // $objDemo->sender = "Test Xpro";
        // $objDemo->date = Carbon::Now();
        // $objDemo->subject = "Data from Paycly on calling our callback url.";
        // $objDemo->message = json_encode($data);

        // Mail::bcc($deposit_email)->send(new NewNotification($objDemo));

        $deposit = Deposit::find($order_number[1]);

        $user = $t7->tuser();

        $msg = $data['reason'];

        if($deposit) {
            if($data['status'] == 'Failed') {
                $deposit->status = 'Declined';
                $deposit->save();

                $msg = 'Sorry your payment was delined because for the following reason: ' . $msg;
            } elseif ($data['status'] == 'Success' || $data['status'] == 'Test') {
                $amount = $data['amount'];
                $paymentId =$data['transaction_id'];
                $respT7 = $this->performTransaction($t7->currency, $t7->number, $amount, 'MM-Paycly', 'MM-AUTOPAYCLY-'.$paymentId, 'deposit', 'balance');

                if(gettype($respT7) !== 'integer') {
                    return redirect()->back()->with('message', 'Sorry an error occured, report this to support!');
                } else {
                    $t7->balance += $amount;
                    $t7->save();
                    $deposit->txn_id = $paymentId;
                    $deposit->status = 'Processed';
                    $deposit->save();

                    //save transaction
                    $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                    //send email notification to user
                    $currency = Setting::getValue('currency');
                    $site_name = Setting::getValue('site_name');
                    $objDemo = new \stdClass();

                    $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
                    $objDemo->message = "\r Hello $name, \r\n

                    \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                    $objDemo->sender = "$site_name";
                    $objDemo->date = Carbon::Now();
                    $objDemo->subject = "Deposit Processed!";

                    Mail::bcc($user->email)->send(new NewNotification($objDemo));

                    //send email notification to admin
                    $objDemo = new \stdClass();
                    $objDemo->message = "\r Hello Admin, \r\n" .
                        "\r This is to inform you of a successful deposit of $currency$amount with deposit id $order_number[1] to account number $t7->number by user $name, that just occured on your system through Ragapay. \r\n" .
                        "\r Please no extra action is needed at this time(auto-deposit) \r\n";
                    $objDemo->sender = 'RagaPay Deposit: ' . $site_name;
                    $objDemo->date = Carbon::Now();
                    $objDemo->subject = "Action Needed: Successful RagaPay Deposit";
                    Mail::mailer('smtp')->bcc($deposit_email)->send(new NewNotification($objDemo));

                    $msg = 'Your deposit was successfully processed!';
                }
            } elseif($data['status'] == 'Pending') {
                $deposit->status = 'Processing';
                $deposit->save();

                $msg = 'Sorry your payment is still processing: ' . $data['descriptor'];
            }
        }

        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function xproNotifications(Request $request)
    {
        $data = $request->all();
        $currency = Setting::getValue('currency');
        $site_name = Setting::getValue('site_name');
        $deposit_email = Setting::getValue('deposit_email');

        // $objDemo = new \stdClass();
        // $objDemo->sender = "Test Xpro";
        // $objDemo->date = Carbon::Now();
        // $objDemo->subject = "Data from Xpro on calling our callback url 1.";
        // $objDemo->message = json_encode($data);

        // Mail::bcc($deposit_email)->send(new NewNotification($objDemo));

        $order_number = explode('-', $data['order_number']);
        $txn_id = $data['id'];

        $t7_id = $order_number[2];
        $t7 = Trader7::find($t7_id);
        $user = $t7->tuser();
        $amount = $data['order_amount'];

        $deposit = Deposit::find($order_number[1]);
        $deposit->amount = $amount;
        $deposit->txn_id = $txn_id;
        $deposit->save();

        $msg = 'We are processing your payment, check back later. ' . $data['reason'];

        if(strtolower($data['type']) == 'sale' && $data['status'] == 'success' && $deposit->status == 'Pending') {
            $respT7 = $this->performTransaction($data['order_currency'], $t7->number, $amount, 'MM-Xpro', 'MM-AUTOXPRO-'.$txn_id, 'deposit', 'balance');

            if(gettype($respT7) !== 'integer') {
                $msg = 'Please contact support immediately, an unexpected error has occured but we got your funds.';
                return json_encode(['status' => false, 'message' => $msg]);
            } else {
                $deposit->status = 'Processed';
                $deposit->save();
                $t7->balance += $amount;
                $t7->save();

                //save transaction
                $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                //send email notification to user
                $currency = Setting::getValue('currency');
                $site_name = Setting::getValue('site_name');
                $objDemo = new \stdClass();

                $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
                $objDemo->message = "\r Hello $name, \r\n

                \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                $objDemo->sender = "$site_name";
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Deposit Processed!";

                Mail::bcc($user->email)->send(new NewNotification($objDemo));
                $msg = 'Your deposit was successfully processed!';

                //send email notification to admin
                $objDemo = new \stdClass();
                $objDemo->message = "\r Hello Admin, \r\n" .
                    "\r This is to inform you of a successful deposit of $currency$amount with deposit id $order_number[1] to account number $t7->number by user $name, that just occured on your system through Xpro. \r\n" .
                    "\r Please no extra action is needed at this time(auto-deposit) \r\n";
                $objDemo->sender = 'Xpro Deposit: ' . $site_name;
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Action Needed: Successful Xpro Deposit";
                Mail::mailer('smtp')->bcc($deposit_email)->send(new NewNotification($objDemo));
            }
        }

        return json_encode(['status' => true, 'message' => $msg]);
    }
}