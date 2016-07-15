<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    protected $redirectPath = '/';
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
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->middleware('lowerEmail');
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
//            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:22',
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Make login to application
     *
     * @param \Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(\Request $request)
    {
        $email = Input::get('email');
        $pass  = Input::get('password');

        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            return redirect()->intended('/');
        }

        return \Redirect::back()->withErrors(
            ['Введённые имя пользователя и пароль не совпадают с сохранёнными в нашей 
            базе данных. Проверьте правильность введённых данных и повторите попытку.']
        );
    }

    /**
     * Logout from application
     */
    public function getLogout()
    {
        Auth::logout();
        return \Redirect::to('/');
    }


}
