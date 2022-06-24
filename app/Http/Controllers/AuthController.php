<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;

class AuthController extends Controller
{

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
    
        $data = $request->validate([
            'login_id' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $login_id = $data['login_id'];
        $password = $data['password'];
        $phone_number = $data['phone_number'];

        $user = User::where('login_id', $login_id)->first();

        if ($user != null) {
            $is_valid_password = Hash::check($password, $user->password);
            if ($is_valid_password) {
                if ($message_sent = $this->send_sms($phone_number)) {
                    $credential = [
                        'login_id' => $data['login_id'],
                        'password' => $data['password'],
                        'phone_number' => $data['phone_number'],
                    ];
                    return view('auth/verify')->with("credential", $credential);
                }
                return redirect()->back()->withErrors("Invalid Phone Number");
            } else {
                return redirect()->back()->withErrors("something went wrong, login_id or password is not correct");
            }
        } else {
            return redirect()->back()->withErrors("something went wrong");
        }
    }



    protected function verify(Request $request)
    {
      
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
        ]);

        $phone_number = $request['phone_number']; 
       
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);

        $verification =  $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], array('to' => $phone_number));
           
        if ($verification->valid) {
            $user = new  User();
            $user->login_id = $request['login_id'];
            $user->phone_number = $request['phone_number'];
            $user->password = Hash::make($request['password']);
            $user->save();
            Auth::login($user);
            return view('welcome')->with(['message' => 'Phone number verified']);
        }
       return back()->with(['phone_number' => $data['phone_number'], 'error' => 'Invalid verification code entered!']);
    }


    protected function resend(Request $request)
    {

        return dd($request['phone_number']);
    }

    protected function send_sms($phone_number)
    {
        /* getting credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");


        $twilio = new Client($twilio_sid, $token);

        try {
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($phone_number, "sms");
            return true;
        } catch (\Twilio\Exceptions\RestException $e) {
            // dd($e->getMessage());          
            return false;
        }
    }
}
