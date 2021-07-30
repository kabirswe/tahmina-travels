<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;
use Exception;
use Hash;
use Mail;
use Carbon\Carbon;
use DataTables, File;
use App\Models\User;
// use App\Models\UserProfile;
// use App\Mail\UserMail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // permission for admin
        // $this->middleware('permission:all-account-list|all-account-delete|all-account-edit', ['only' => ['index']]);
        // $this->middleware('permission:operator-create', ['only' => ['create']]);
        // $this->middleware('permission:operator-create|seller-create|buyer-create|seller-buyer-create', ['only' => ['store']]);
        // $this->middleware('permission:all-account-edit|buyer-edit|seller-edit|seller-buyer-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:all-account-delete|buyer-delete|seller-delete|seller-buyer-delete', ['only' => ['destroy']]);

        // // // permission for admin and operator
        // $this->middleware('permission:buyer-list|buyer-delete|seller-buyer-list|seller-buyer-delete', ['only' => ['buyerList']]);
        // $this->middleware('permission:buyer-create|seller-buyer-create', ['only' => ['buyerCreate']]);

        // $this->middleware('permission:seller-list|seller-delete', ['only' => ['sellerList']]);
        // $this->middleware('permission:seller-create', ['only' => ['sellerCreate']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::whereHas('roles', function ($query) {
                $query->where('roles.name', '!=', 'admin');
            })
            ->with('roles')
            ->get();

            $users = $users->transform(function ($item) {
                $item->role_names = $item->roles->pluck('name')->implode(', ');
                return $item;
            })->all();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('role', function($row) {
                    return $row->roles->first()->toJson();
                })
                ->addColumn('action-btn', function($row) {
                    return $row->id;
                })
                ->addColumn('status-data', function($row) {
                    return ['id' => $row->id, 'status' => $row->is_active];
                })
                ->rawColumns(['action-btn', 'status-data', 'role'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Responds with user status change with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $data = User::find($request->id);
        $data->is_active = $request->status;
        $data->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user= Auth::user();
        return view('admin.users.edit-profile-details',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'nid_no' => ['nullable',
                        'regex:/[a-zA-Z0-9]/'],

            'passport_no'=>['nullable','regex:/[a-zA-Z0-9]/',],
            'driving_license_no'=>['nullable','regex:/[a-zA-Z0-9]/'],
            ],
            [
            'nid_no.regex' =>  'Invalid NID no. format',
            'passport_no.regex' =>  'Invalid Passport no. format',
            'driving_license_no.regex' =>  'Invalid  Driving License no. format',
            ]);
        UserProfile::where('user_id', $user->id)
                    ->update(['nid_no' => $request->nid_no,
                              'passport_no' => $request->passport_no,
                              'driving_license_no' => $request->driving_license_no,
                              ]);
        // user activity log
        // createUserActivity($request, '更新', $user->name . '<' . $user->email . '> 更新 自分のメール', '一般的な', null);

        return redirect()->route('settings')->with('success', 'Profile details has been changed');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('name', 'id')->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'email' => 'required|email|unique:users,email|max:120',
            'password' => [
                'required', 'string', 'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
        ], [
            'email.unique' =>  trans('error.unique_email'),
            'email' =>  trans('error.email'),
            'email.max' =>  trans('error.max_mail'),
            'display_name.max' => trans('error.max_char'),
            'password.min' => trans('auth.password_min'),
            'password.regex' => trans('auth.password_regex'),
            'password.confirmed' => trans('auth.password_confirmed')
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        if (!empty($request->is_active)) {
            $data['is_active'] = 1;
        } else {
            $data['is_active'] = 0;
        }
        $data['created_by'] = $user->id;
        $data['updated_by'] = $user->id;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        // dd($data);
        $userData = User::create($data);

        //Role assign
        $userData->assignRole($data['role']);

        return redirect()->route('users.index')
            ->with('success', trans('user.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::with('roles')->find($id);
        $roles = Role::select('name', 'id')->get();
        return view('admin.users.edit', compact('data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!empty($request->password) && (isset($request->password))) {
            $this->validate($request, [
                'password' => [
                    'required', 'string', 'min:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'confirmed',
                ],
            ], [
                'password.min' => trans('auth.password_min'),
                'password.regex' => trans('auth.password_regex'),
                'password.confirmed' => trans('auth.password_confirmed')
            ]);
        }

        $userData = User::with('roles')->find($id);
        $oldRoles = $userData->roles->first()->id;

        //unique email and request email check
        $email = User::where('id', $id)->first()->email;
        if ($request->email != $email) {
            $this->validate($request, [
                'email' => 'required|email|unique:users,email|max:120'],
                [
                    'email.unique' =>  trans('error.unique_email'),
                    'email.max' =>  trans('error.max_mail'),
                ]
            );
        }

        $input = $request->all();
        // dd($input);

        //Role type check for seller
        if (!empty($request->password) && (isset($request->password))) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input['password'] = $userData->password;
        }

        if (!empty($request->is_active)) {
            $input['is_active'] = 1;
        } else {
            $input['is_active'] = 0;
        }

        $input['updated_by'] = $user->id;

        $userData->update($input);

        //Role assign
        $userData->removeRole($oldRoles);
        $userData->assignRole($input['role']);

        //User account info send start
        // if (!empty($request->password) && (isset($request->password))) {
        //     $details = array(
        //         'title' => '口座情報',
        //         'name'=> $userData->name,
        //         'email' => $input['email'],
        //         'password' => $request['password'],
        //         'url' => route('login')
        //     );
        //     $toEmail = $input['email'];
        //     Mail::to($toEmail)->send(new UserMail($details));
        // }
        // //User account info send end

        // $redirectUrl = '';
        // if($user->hasRole('admin')){
        //     $redirectUrl = 'users.index';
        // } elseif($user->hasRole('operator')) {
        //     if($userData->hasRole('seller')){
        //         $redirectUrl = 'seller.list';
        //     } else {
        //         $redirectUrl = 'buyer.list';
        //     }
        // }

        return redirect()->route('users.index')
            ->with('success', trans('user.update'));
    }

    /**
     * Update the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUserStatus(Request $request, $id)
    {
        $user = Auth::user();
        $userData = User::find($id);
        $userData->is_active = $request->status;
        $userData->save();
        $getData = User::find($id);
        // user activity log
        //createUserActivity($request, '削除する', $user->name . '<' . $user->email . '> 更新 ' . $getData->name . '<' . $getData->name . '> アカウント', '一般的な', null);

        return response()->json(['success' => $getData->is_active]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        $userData = User::find($id);
        User::find($id)->delete();

        return response()->json(['success' =>  trans('user.delete')]);
    }

    /**
     * (Edit name,edit email change password) & setting functionality start
     */
    public function settings()
    {
        $user = Auth::user();
        return view('admin.users.setting', compact('user'));
    }

    public function editAccountdetails()
    {
        $user = Auth::user();
        return view('admin.users.edit-account-details', compact('user'));
    }

    public function updateAccountdetails(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'display_name' => 'required|max:255',
            'name'=>'required|max:255'
        ], [
            'display_name.max' => 'error.max_char',
            'name.max' => 'error.max_char',
        ]);
        User::where('id', $user->id)->update(['display_name' => $request->display_name,'name'=>$request->name]);
        // user activity log
        // createUserActivity($request, '更新', $user->name . '<' . $user->email . '> 更新 自分の表示名', '一般的な', null);

        return redirect()->route('settings')->with('success', 'Account Details has been changed');
    }

    public function showChangePassword(Request $request) {
        $user = Auth::user();
        return view('admin.users.change-user-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password' => [
                'required', 'string', 'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
            'password_confirmation' => ['required'],
        ], [
            'password.min' =>  trans('auth.password_min'),
            'password.regex' => trans('auth.password_regex'),
            'password.confirmed' => trans('auth.password_confirmed')
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);
        // user activity log
        //createUserActivity($request, '更新', $user->name . '<' . $user->email . '> 更新 自分のパスワード', '一般的な', null);

        return redirect()->route('settings')->with('success', 'Password has been changed');
    }

    /**
     * Show the application User logs.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userLogs(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Activity::all())
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" id="viewData" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn"><img class="icon-img" src="'. asset("images/admin/search-plus.svg") .'" alt=""></a>';
                    if (auth()->user()->hasRole('admin')) {
                        $btn = $btn.' <a href="javascript:void(0)" id="deleteData"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn"><img class="icon-img" src="'. asset("images/admin/trash.svg") .'" alt=""></a>';
                    }
                    return $btn;

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.user-logs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\userLogShow  $id
     * @return \Illuminate\Http\Response
     */
    public function userLogShow(Request $request)
    {
        $data = Activity::find($request->id);
        $user = User::findOrFail($data->causer_id);
        $role = Role::find($data->causer_id);
        return response()->json([
            'data'=>$data,
            'user'=>$user,
            'role'=>$role->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\userLogDestroy  $id
     * @return \Illuminate\Http\Response
     */
    public function userLogDestroy(Request $request)
    {
        $item = Activity::findOrFail($request->id);
        Activity::find($request->id)->delete();
        return response()->json(['success'=>'User log deleted successfully.']);
    }
}
