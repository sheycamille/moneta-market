<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Mail\NewNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Models\Admin;
use App\Models\Setting;

use Spatie\Permission\Models\Role;

use Carbon\Carbon;

use DataTables;


class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:madmin-list|madmin-create|madmin-edit|madmin-delete', ['only' => ['index']]);
        $this->middleware('permission:madmin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:madmin-edit', ['only' => ['update', 'adminchangepassword', 'adminresetadminpass', 'adminupdatepass']]);
        $this->middleware('permission:madmin-delete', ['only' => ['destroy']]);
        $this->middleware('permission:madmin-message', ['only' => ['sendmail']]);
        $this->middleware('permission:madmin-block', ['only' => ['ublock', 'unblock']]);
        $this->middleware('permission:', ['only' => ['']]);
        $this->middleware('permission:', ['only' => ['']]);
        $this->middleware('permission:', ['only' => ['']]);
        $this->middleware('permission:', ['only' => ['']]);
    }


    public function index()
    {
        $roles = Role::get();
        $admins = Admin::orderby('created_at', 'desc')->get();
        return view('admin.madmins')->with(array(
            'title' => 'Add new manager',
            'admins' => $admins,
            'roles' => $roles
        ));
    }


    // Return admin data
    public function getadmins()
    {
        $data = Admin::latest()->get();
        $fdata = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function($admin) {
                return $admin->id;
            })
            ->addColumn('firstName', function($admin) {
                return $admin->firstName;
            })
            ->addColumn('lasttName', function($admin) {
                return $admin->lastName;
            })
            ->addColumn('email', function($admin) {
                return $admin->email;
            })
            ->addColumn('phone', function($admin) {
                return $admin->phone;
            })
            ->addColumn('type', function($admin) {
                return $admin->type;
            })
            ->addColumn('status', function($admin) {
                return $admin->acnt_type_active;
            })
            ->addColumn('role', function($admin) {
                $roles = '';
                foreach($admin->roles as $role) {
                    $roles .= $role->name . ', ';
                }

                return $roles;
            })
            ->addColumn('action', function($admin) {
                $action = '<a href="#" data-toggle="modal" data-target="#resetpswdModal{{ $admin->id }}" class="m-1 btn btn-warning btn-sm text-nowrap">Reset Password</a>';
                $action = '<a href="#" data-toggle="modal" data-target="#sendmailModal' . $admin->id . '" class="m-1 btn btn-info btn-sm text-nowrap">Send Email</a>';

                if (auth('admin')->user()->hasPermissionTo('madmin-block', 'admin')) {
                    if ($admin->acnt_type_active == null || $admin->acnt_type_active == 'blocked') {
                        $action .= ' <a class="m-1 btn btn-primary btn-sm" href="' . route("adminunblock", $admin->id) . '">Unblock</a>';
                    } else {
                        $action .= '<a class="m-1 btn btn-danger btn-sm text-nowrap" href="' . route("adminublock", $admin->id) . '">Block</a>';
                    }
                }

                if (auth('admin')->user()->hasPermissionTo('madmin-delete', 'admin') && auth('admin')->user()->id != $admin->id) {
                    $action .= '<a href="#" data-toggle="modal" data-target="#deleteModal' . $admin->id . '" class="m-1 btn btn-danger btn-sm">Delete</a>';
                }

                if (auth('admin')->user()->hasPermissionTo('madmin-edit', 'admin')) {
                    $action .= '<a href="#" data-toggle="modal" data-target="#edituser' . $admin->id . '" class="m-1 btn btn-secondary btn-sm">Edit</a>';
                }

                $roles = Role::get();

                $action .= view('admin.admin_actions', compact('admin', 'roles'))->render();

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);

             return $fdata;
    }


    public function create()
    {
        $roles = Role::get();
        return view('admin.addadmin')->with(array(
            'title' => 'Add new manager',
            'roles' => $roles
        ));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|max:255',
            'l_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Admin::create(
            [
                'firstName' => $request['fname'],
                'lastName' => $request['l_name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'type' => $request['type'],
                'acnt_type_active' => "active",
                'status' => "active",
                'dashboard_style' => "dark",
                'password' => Hash::make($request['password']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        $admin->syncRoles($request->roles);

        $perms = [];
        foreach ($request->roles as $role) {
            $role = Role::find($role);
            $perms = array_merge($perms, $role->permissions->pluck('name')->toArray());
        }

        $admin->syncPermissions($perms);

        return redirect()->route('madmins')
            ->with('message', 'Manager added Sucessfull!y');
    }


    // update users info
    public function update(Request $request)
    {

        $admin = Admin::find($request->user_id);
        $admin->update([
            'firstName' => $request->fname,
            'lastName' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'roles' => $request->roles
        ]);

        $admin->syncRoles($request->roles);

        $perms = [];
        foreach ($request->roles as $role) {
            $role = Role::find($role);
            array_push($perms, $role->permissions->pluck('name')->toArray());
        }

        $admin->syncPermissions($perms);
        return redirect()->back()
            ->with('message', 'Account updated Successfully!');
    }


    public function destroy($id)
    {
        Admin::where('id', $id)->delete();
        return redirect()->back()
            ->with('message', 'Manager has been deleted!');
    }


    // serves admin update self password
    public function adminchangepassword()
    {
        return view('admin.changepassword')->with(array(
            'title' => 'Change Password',
        ));
    }



    // update Password
    public function adminupdatepass(Request $request)
    {
        if (!password_verify($request['old_password'], $request['current_password'])) {
            return redirect()->back()
                ->with('message', 'Incorrect Old Password');
        }
        $this->validate($request, [
            'password_confirmation' => 'same:password',
            'password' => 'min:8',
        ]);

        Admin::where('id', $request['id'])
            ->update([
                'password' => Hash::make($request['password']),
            ]);
        return redirect()->back()
            ->with('message', 'Password Changed Sucessfully');
    }


    // reset Password
    public function adminresetadminpass($id)
    {
        Admin::where('id', $id)
            ->update([
                'password' => Hash::make('admin01236'),
            ]);
        return redirect()->back()
            ->with('message', 'Password reset Successful.');
    }


    // block user
    public function ublock($id)
    {
        Admin::where('id', $id)
            ->update([
                'acnt_type_active' => 'blocked',
            ]);
        return redirect()->back()
            ->with('message', 'Manager Blocked');
    }


    // unblock user
    public function unblock($id)
    {
        Admin::where('id', $id)
            ->update([
                'acnt_type_active' => 'active',
            ]);
        return redirect()->back()
            ->with('message', 'Manager Unblocked');
    }


    // send mail to one user
    public function sendmail(Request $request)
    {
        $site_name = Setting::getValue('site_name');
        $mailer = 'smtp';

        //send email notification
        $mailduser = Admin::where('id', $request->user_id)->first();
        $objDemo = new \stdClass();
        $objDemo->message = "\r Hello $mailduser->name, \r \n"
            . "\r $request->message \r\n";
        $objDemo->sender = $site_name;
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "$site_name Notification";

        Mail::mailer($mailer)->bcc($mailduser->email)->send(new NewNotification($objDemo));
        return redirect()->back()->with('message', 'Your message was sent successful!');
    }
}