<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\User;
use App\Models\Images;
use App\Models\Content;
use App\Models\Deposit;
use App\Models\Testimony;
use App\Models\Withdrawal;
use App\Models\AccountType;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:mdeposit-list', ['only' => ['mdeposits']]);
        $this->middleware('permission:mdeposit-process', ['only' => ['pdeposit', 'rejectdeposit']]);
        $this->middleware('permission:mwithdrawal-list', ['only' => ['mwithdrawals']]);
        $this->middleware('permission:mwithdrawal-process', ['only' => ['pwithdrawal', 'rejectwithdrawal']]);
        $this->middleware('permission:macctype-list|macctype-create|macctype-edit|macctype-delete', ['only' => ['accounttypes']]);
        $this->middleware('permission:macctype-create', ['only' => ['showaddaccounttype', 'addaccounttype']]);
        $this->middleware('permission:macctype-edit', ['only' => ['updateaccounttype']]);
        $this->middleware('permission:macctype-delete', ['only' => ['delaccounttype']]);
        $this->middleware('permission:mftd-list', ['only' => ['mftds']]);
    }


    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //sum total deposited
        $total_deposited = DB::table('deposits')->select(DB::raw("SUM(amount) as total"))->where('status', 'Processed')->get();
        $pending_deposited = DB::table('deposits')->select(DB::raw("SUM(amount) as total"))->where('status', 'Pending')->get();
        $total_withdrawn = DB::table('withdrawals')->select(DB::raw("SUM(amount) as total"))->where('status', 'Processed')->get();
        $pending_withdrawn = DB::table('withdrawals')->select(DB::raw("SUM(amount) as total"))->where('status', 'Pending')->get();

        $userlist = User::count();
        $activeusers = User::where('status', 'active')->count();
        $blockeusers = User::where('status', 'blocked')->count();
        $unverifiedusers = User::where('account_verify', '!=', 'yes')->count();

        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',
            'total_deposited' => $total_deposited->toArray()[0]->total,
            'pending_deposited' => $pending_deposited->toArray()[0]->total,
            'total_withdrawn' => $total_withdrawn->toArray()[0]->total,
            'pending_withdrawn' => $pending_withdrawn->toArray()[0]->total,
            'user_count' => $userlist,
            'activeusers' => $activeusers,
            'blockeusers' => $blockeusers,
            'unverifiedusers' => $unverifiedusers,
        ]);
    }


    //Return search route for Withdrawals
    public function searchWt(Request $request)
    {
        $dp = Withdrawal::all();
        $searchItem = $request['wtquery'];

        $result = Withdrawal::where('user', $searchItem)
            ->orwhere('amount', $searchItem)
            ->orwhere('payment_mode', $searchItem)
            ->orwhere('status', $searchItem)
            ->paginate(10);

        return view('admin.mwithdrawals')
            ->with(array(
                'dp' => $dp,
                'title' => 'Withdrawals search result',
                'withdrawals' => $result,
            ));
    }


    //Return manage withdrawals route
    public function mwithdrawals()
    {
        return view('admin.mwithdrawals')
            ->with(array(
                'title' => 'Manage users withdrawals',
                'withdrawals' => Withdrawal::orderBy('created_at', 'desc')->get(),
            ));
    }


    //Return manage deposits route
    public function mdeposits()
    {
        return view('admin.mdeposits')
            ->with(array(
                'title' => 'Manage users deposits',
                'deposits' => Deposit::orderBy('created_at', 'desc')->get(),
            ));
    }


    //return front end management page
    public function frontpage(Request $request)
    {
        return view('admin.frontpage')->with(array(
            'title' => 'Frontend management',
            'faqs' => Faq::all(),
            'images' => Images::orderBy('id', 'desc')->get(),
            'testimonies' => Testimony::orderBy('created_at', 'desc')->get(),
            'contents' => Content::orderBy('created_at', 'desc')->get(),
        ));
    }


    //Return KYC route
    public function kyc()
    {
        return view('admin.kyc')
            ->with(array(
                'title' => 'KYC',
                'users' => User::where('id_card', '!=', NULL)
                    ->where('id_card_back', '!=', NULL)
                    ->where('passport', '!=', NULL)
                    ->where('address_document', '!=', NULL)
                    ->orderBy('docs_uploaded_date', 'DESC')
                    ->get(),
            ));
    }


    // Return account types
    public function accounttypes(Request $request)
    {
        $accounttypes = AccountType::all();
        return view('admin.accounttypes', [
            'title' => "Account Types",
            'accounttypes' => $accounttypes,
        ]);
    }


    // Return add account type page
    public function showaddaccounttype(Request $request)
    {
        return view('admin.addaccounttype', [
            'title' => "Add Account Type",
        ]);
    }


    public function addaccounttype(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'cost' => ['required', 'string',],
            'min_deposit' => ['required', 'integer',],
            'max_leverage' => ['required', 'integer',],
            'min_trade_size' => ['required',],
            'max_trade_size' => ['required',],
            'swaps' => ['required', 'string',],
            'fx_commission' => ['required', 'string',],
            'num_fx_pairs' => ['required', 'integer'],
            'num_commodities_pairs' => ['required', 'integer'],
            'num_indices_pairs' => ['required', 'integer',],
            'trading_platforms' => ['required', 'string',],
            'typical_spread' => ['required',],
            'execution_type' => ['required', 'string',],
            'requotes' => ['required', 'string',],
            'available_instruments' => ['required', 'string',],
            'educational_material' => ['required', 'integer',],
            'active' => ['required', 'integer',],
        ])->validate();

        unset($input['_token']);

        $accType = new AccountType($input);
        $accType->save();

        return redirect(route('accounttypes'))->with('message', 'New Account Type Created Sucessfully!');
    }


    public function updateaccounttype(Request $request, $id)
    {
        AccountType::where('id', $id)
            ->update([
                'name' => $request->name,
                'cost' => $request->cost,
                'min_deposit' => $request->min_deposit,
                'max_leverage' => $request->max_leverage,
                'min_trade_size' => $request->min_trade_size,
                'max_trade_size' => $request->max_trade_size,
                'swaps' => $request->swaps,
                'fx_commission' => $request->fx_commission,
                'num_fx_pairs' => $request->num_fx_pairs,
                'num_commodities_pairs' => $request->num_commodities_pairs,
                'num_indices_pairs' => $request->num_indices_pairs,
                'trading_platforms' => $request->trading_platforms,
                'typical_spread' => $request->typical_spread,
                'execution_type' => $request->execution_type,
                'requotes' => $request->requotes,
                'available_instruments' => $request->available_instruments,
                'educational_material' => $request->educational_material,
                'active' => $request->active,
            ]);
        return redirect()->back()
            ->with('message', 'The Account Type Updated Sucessfully!');
    }


    public function delaccounttype(Request $request, $id)
    {
        AccountType::where('id', $id)->delete();
        return redirect()->back()
            ->with('message', 'Account type has been deleted!');
    }


    public function mftds(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.mftds', [
            'title' => "First Time Deposits",
            'users' => $users,
        ]);
    }
}