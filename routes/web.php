<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


Route::get('/', function () {
    response()->json([
        'api'=> 'traxporta'
    ]);
});


Route::get('/password/reset/{token}',  function ($token) {
    return view('welcome')->with(['token' => $token]);
});


Route::get('/password/success',  function ($token) {
    return view('success');
})->name('dashboard');


Route::post('/password/update}',  function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
        'token' => 'required',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            Auth::login($user);
        }
    );

    // Redirigir según el estado del restablecimiento
    return $status == Password::PASSWORD_RESET
        ? redirect()->route('dashboard')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');
