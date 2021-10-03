<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\User;

class UserController extends ApiController
{
    public function index()
    {
        $users = User::all();
        // return response()->json(['data_users' => $users], 200);
        // return $users;
        return $this->showAll($users);
    }
    public function store(Request $request)
    {
        
        $ruler = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];
        $this->validate($request, $ruler);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGUlAR_USER;
        $user = User::create($data);

        // return response()->json(['data' => $user], 201);
        return $this->showOne($user,201);
    }
    public function show(User $user)
    {
        /**
         * Chức năng tìm User theo ID
         * Khi chuyền User model vào function thì hệ thống sẽ tự hiểu user đó đã tồn tại rồi, nên không cần đưa id vào
         * => Xóa: $user = User::findOrFail($id);
         * https://www.youtube.com/watch?v=-luW4dDmWfo&t=3s
         */
        // return response()->json(['data' => $user], 200);
        return $this->showOne($user);
    }

    public function update(User $user, Request $request)
    {
        // $user = User::findOrFail($id);
        $ruler = [
            'email' => 'email|unique:users,email' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGUlAR_USER,
        ];
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        /**
         * xac minh xem ng dung co phai admin hay khong, isVerified mang gia tri la 1
         */
        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                // return response()->json(['error' => 'Only verifiel user can modify the', 'code' => 409], 409);
                return $this->errorResponser('Only verifiel user can modify the',409);
            }
            $user->admin = $request->admin;
        }
        if (!$user->isDirty()) {
            // return response()->json(['error' => 'You nedd to specify a different value to update', 'code' => 422], 422);
            return $this->errorResponser('You nedd to specify a different value to update',422);
        }
        $user->save();
        // return response()->json(['data' => $user], 200);
        return $this->showOne($user);

    }

    public function destroy(User $user)
    {
        $user->delete();
        // return response()->json(['data'=>$user],200);
        return $this->showOne($user);
    }

    /**
     * https://www.youtube.com/watch?v=X-BLt-4kVx4&list=PLw_73jI5PQ-Lpl8mkPdqhK5Nr-UyzjNDx&index=113
     */
    public function verify($token)
    {
        $user=User::where('verification_token',$token)->firstOrFail();
        $user->verified=User::VERIFIED_USER;
        $user->verification_token=null;
        $user->save();
        return $this->showMessage('THe account has been verified successfuly');
    }
}
