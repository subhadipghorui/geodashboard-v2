<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Laravel\Socialite\Facades\Socialite;

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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        // Find User
        $authUser = User::where('email', $user->email)->first();
        if($authUser){
            Auth::login($authUser);
            return redirect()->route('app.index');
        }
        else{
            $newUser = new User();
            $newUser->email = $user->email;
            $newUser->name = $user->name;
            $newUser->email_verified_at = Date::now();
            $newUser->g_group = ["1"];
            $newUser->password = bcrypt(uniqid().uniqid()); 
            $newUser->save();


            // SendCreateCustomerNotificationJob::dispatch($user);
            // Login
            Auth::login($newUser);
            return redirect()->route('app.index');
        }
        
    }
}
