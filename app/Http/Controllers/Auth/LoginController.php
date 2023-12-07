<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    protected $url;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated($request, $user)
    {
        return redirect('/');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = env('BACK_END');
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $client = new Client();
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
            $api_response = $client->post($this->url.'login', ['headers' => ['headers' =>['Accept ' => 'application/json']]
            , 'json' => [
                'email' => $request->email,
                'password' => $request->password,
            ]]);
        
        $response = json_decode($api_response->getBody());
        if($response->status){
            session(['user_token' => $response->data->api_token, 'user_id' => $response->data->user->id]);
            return redirect(route('blogs.index'));
        }else{
            session(['info' => $response->message]);
            return redirect(route('login'));
        }
    }

}
