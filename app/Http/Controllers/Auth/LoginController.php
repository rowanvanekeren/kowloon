<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function logout($locale){
        App::setLocale($locale);
        Auth::logout();
        return redirect()->intended(App::getLocale() . '/home');
    }
    public function getLogin($locale){

        App::setLocale($locale);
        $categories = Category::with('translation')->get();
        return View('auth/login', ['categories' => $categories]);
    }
/*    public function postLogin($locale, Request $request)
    {
        App::setLocale($locale);
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required|max:255',

        ]);

        if (Auth::attempt(['email' => $request->name, 'password' => $request->password])) {
            // Authentication passed...
            return redirect(App::getLocale() . '/home')->intended('wish');
        }else{

            return redirect(App::getLocale() . '/home')
                ->withInput($request->only($request->email, 'remember'));
        }
    }*/
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
