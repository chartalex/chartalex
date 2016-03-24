<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\EmailLogin;
use Mail;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/mclh/order';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
        ]);
    }

    public function login(Request $request)
    {
        // validate that this is a real email address
        // send off a login email
        // show the users a view saying "check your email"
        //$this->validate($request, ['email' => 'required|email|exists:users']);

        $rules = [
            'email' => 'required|email|exists:users'
        ];

        $messages = [
            'email.exists' => 'You are not yet registered! <br> The only way to create an account is to place an order. <br> <a href="/mclh/">Go to shop</a>.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('auth/login')
                        ->withErrors($validator)
                        ->withInput();
        }

        $emailLogin = EmailLogin::createForEmail($request->input('email'));

        $url = route('auth.email-authenticate', [
            'token' => $emailLogin->token
        ]);

        Mail::send('auth.emails.email-login', ['url' => $url], function ($m) use ($request) {
        $m->from('noreply@chartalex.fr', 'M. Chat L\'Heureux');
        $m->to($request->input('email'))->subject('Login');
        });

        return redirect('auth/email-sent');
    }

    public function authenticateEmail($token)
    {
        $emailLogin = EmailLogin::validFromToken($token);

        Auth::login($emailLogin->user);

        return redirect('/mclh/order');
    }

}
