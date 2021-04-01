<?php

namespace App\Http\Controllers;

use App\Post;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $user = $request->all();
        $user['password'] = bcrypt(trim($request->password));

        $email = User::where('email',$user['email'])->first();
        if ($email) {
            return back()->withErrors(['email' => 'Email already exists']);
        }

        User::create($user);
        Session::flash('flash_admin', 'User added successfully!');
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function me()
    {
        return view('admin.users.edit')->with('user', Auth::user());
        //$user = User::find($id);
        //$roles = Role::all();

        //return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->except(['profile_pic', 'password']);

        if ($profilePic = $request->file('profile_pic')) {
            $rules = [
                'profile_pic' => 'image|max:1024',
            ];
    
            $validation = Validator::make($request->only('profile_pic'), $rules);
    
            if ($validation->fails()) {
                return back()->withErrors(['profile_pic' => $validation->errors()->first()]);
            }

            $md5 = md5(uniqid(rand(), true));
            $name = $id . '_' . $md5 . '.' . $profilePic->getClientOriginalExtension();
            $profilePic->move('uploads/users', $name);
            $input['profile_pic'] = $name;
        }

        if (!empty(trim($request->password))) {
            $input['password'] = bcrypt($request->password);
        }

        $user->update($input);
        Session::flash('flash_admin', 'User updated successfully!');
        return redirect('/admin/users');
    }

    public function updateMyProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $input = $request->except(['profile_pic', 'password', 'email', 'role_id', 'active']);

        if ($profilePic = $request->file('profile_pic')) {
            $rules = [
                'profile_pic' => 'image|max:1024',
            ];
    
            $validation = Validator::make($request->only('profile_pic'), $rules);
    
            if ($validation->fails()) {
                return back()->withErrors(['profile_pic' => $validation->errors()->first()]);
            }

            $md5 = md5(uniqid(rand(), true));
            $name = Auth::user()->id . '_' . $md5 . '.' . $profilePic->getClientOriginalExtension();
            $profilePic->move('uploads/users', $name);
            $input['profile_pic'] = $name;
        }

        if (!empty(trim($request->password))) {
            $input['password'] = bcrypt($request->password);
        }

        $user->update($input);
        Session::flash('flash_admin', 'Profile updated successfully!');
        return redirect('/admin/users/me');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (File::exists(public_path('/uploads/users/'.$user->profile_pic))) {
            File::delete(public_path('/uploads/users/'.$user->profile_pic));
        } 
        $user->delete();
        Post::whereUserId($id)->delete();

        Session::flash('flash_admin', 'User #'.$id.' deleted successfully!');
        return redirect('/admin/users');
    }
}
