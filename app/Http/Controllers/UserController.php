<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Validator;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        $roles = Role::orderBy('name', 'asc')->get();

        $create   = FunctionHelper::checkAction('create_user');
        $show     = FunctionHelper::checkAction('show_user');
        $update   = FunctionHelper::checkAction('update_user');
        $delete   = FunctionHelper::checkAction('delete_user');

        return view('moduls.setting.users', [
            'users'   => $users,
            'roles'   => $roles,
            'create'  => $create,
            'show'    => $show,
            'update'  => $update,
            'delete'  => $delete
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'confirmpassword' => 'required|same:password',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        if (!strcmp($request->password, $request->confirmpassword) == 0) {
            $msg = ['password is not same as confirm password'];
            return response()->json([
                'error' => true,
                'messages' => $msg,
            ], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = bcrypt($request->confirmpassword);
        $user->save();

        return response()->json([
            'error' => false,
            'success' => 'Created succesfully!',
            'data' => $user,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'error' => false,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user = User::findOrFail($id);

        $validator = Validator::make($request->input(), array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        if ($request->email == $user->email) {
            $user->name = $request->name;
            $user->role_id = $request->role_id;
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;

            if ($validator->fails()) {
                return response()->json([
                    'error'    => true,
                    'messages' => $validator->errors(),
                ], 422);
            }
        }

        $user->save();

        return response()->json([
            'error' => false,
            'success'  => 'Update successfully!',
            'data' => $user,
        ], 200);
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
        $user->delete();

        return response()->json([
            'error' => false,
            'success' => 'Deleted succesfully!',
        ], 200);
    }

    /**
     * Menampilkan Halaman Profile User yang sedang login
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $user = Auth::User();
        $role = $user->role;

        return view('pages.profile', ['user' => $user, 'role' => $role]);
    }

    /**
     * Mengambil data User yang akan diubah password di menu Edit Password oleh User yang sedang login
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        $userId = Input::get('user_id');
        $user = User::find($userId);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Menampilkan semua User di menu User
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('moduls.setting.editPassword', compact('users'));
    }

    /**
     * Mengubah Password User yang sedang login di halaman profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'currentpassword' => 'required',
            'newpassword' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'confirmpassword' => 'required|same:newpassword',
        ));

        $error = $validator->errors();

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $error,
            ], 422);
        }

        $hashedPassword = Auth::user()->password;

        if (!(Hash::check($request->currentpassword, $hashedPassword))) {
            $msg = ['your current password does not match'];
            return response()->json([
                'error' => true,
                'messages' => $msg,
            ], 422);
        }

        if (strcmp($request->currentpassword, $request->newpassword) == 0) {
            $msg = ['new password can not be same as your current password'];
            return response()->json([
                'error' => true,
                'messages' => $msg,
            ], 422);
        }

        if (!strcmp($request->newpassword, $request->confirmpassword) == 0) {
            $msg = ['new password is not same as confirm password'];
            return response()->json([
                'error' => true,
                'messages' => $msg,
            ], 422);
        }

        $user = Auth::user();
        $user->password = bcrypt($request->confirmpassword);
        $user->save();

        return response()->json([
            'error' => false,
            'messages' => 'password changed successfully',
        ]);
    }

    /**
     * Mengubah Password Semua User di menu Edit Password oleh User yang sedang login
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'newpassword' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'confirmpassword' => 'required|same:newpassword',
        ));

        $error = $validator->errors();

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $error,
                'data' => $request->input(),
            ], 422);
        }

        if (!strcmp($request->newpassword, $request->confirmpassword) == 0) {
            $msg = ['new password is not same as confirm password'];
            return response()->json([
                'error' => true,
                'messages' => $msg,
            ], 422);
        }

        $user = User::find(id);
        $user->password = bcrypt($request->confirmpassword);
        $user->save();

        return response()->json([
            'error' => false,
            'messages' => 'password changed successfully',
        ]);
    }

}
