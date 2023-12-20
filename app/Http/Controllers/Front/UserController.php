<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\UpdateUserUnVerifyRequest;
use App\Http\Requests\Front\UpdateUserVerifyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.profile.users.index');
    }

    public function detail(int $id)
    {
        $user = User::query()->findOrFail($id);
        return view('pages.profile.users.detail', compact('user'));
    }


    public function updateUserUnVerify(UpdateUserUnVerifyRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            $id = ((Crypt::decrypt($request['id'])) - 1) / 2;
            $user = User::query()->findOrFail($id);
            $cleanData =
                ['name' => $request['name'], 'email' => $request['email'], 'admin' => boolval($request['isAdmin'])];

            if ($request['verifyAccount']) $cleanData += ['email_verified_at' => now('Asia/Tehran')];

            $user->update($cleanData);
            return redirect()->back()->with('alert', 'کاربر بروزرسانی شد');
        } else {
            return abort(403);
        }
    }

    public function updateUserVerify(UpdateUserVerifyRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            $id = ((Crypt::decrypt($request['id'])) - 1) / 2;
            $user = User::query()->findOrFail($id);
            $cleanData =
                ['name' => $request['name'], 'email' => $request['email'], 'admin' => boolval($request['isAdmin'])];
            $user->update($cleanData);
            return redirect()->back()->with('alert', 'کاربر بروزرسانی شد');
        } else {
            return abort(403);
        }
    }
}
