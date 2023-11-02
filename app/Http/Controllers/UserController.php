<?php

namespace App\Http\Controllers;

use App\Exceptions\UserRegistered;
use App\Http\Requests\UserRequest;
use App\User;
use Mockery\Exception;

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
        $user->save();
        return $user;
        }
    }
}
