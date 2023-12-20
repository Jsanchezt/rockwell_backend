<?php

namespace App\Http\Controllers;

use App\Exceptions\UserRegistered;
use App\Http\Requests\UserRequest;
use App\Notifications\RegisterNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * @throws UserRegistered
     */
    public function store(UserRequest $request){
        $pre_user = User::where('email', $request->get('email'))
            ->orWhere('phone', $request->get('phone'))
            ->first();
        if ($pre_user) throw new UserRegistered(); else{
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->get('password'));
        $user->save();
        $user->notify(new RegisterNotification($request->get('name')));
        return $user;
        }
    }

    public function sendResetLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw new Exception('User not found');
        }

        $token = Password::createToken($user);
        $user->sendPasswordResetNotification($token);

        return response()->json([
            'status'=> 'ok'
        ]);
    }

}
