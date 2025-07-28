<?php

namespace App\Http\Controllers;


use App\Mail\ForgetMail;
use App\Mail\SecurityMail;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\RegisterMail;
use App\Mail\PasswordMail;
use Illuminate\Support\Str;
use App\Rules\NotSameAsCurrentPassword;


class AuthController extends Controller
{
    public function register()
    {
        return view('home.register');
    }

    public function add_user(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|string|min:2|max:255|regex:/^(?!.* {2})[A-Za-z]+( [A-Za-z]+)*$/',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/',
                'password_confirmation' => 'required',
                'phone' => 'required|digits:10',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required|string|min:2|max:255',
                'gender' => 'required',
            ],
            [
                'name.regex'=>'Name only should contains alphabets and no extra spaces',
                'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one special character.',

            ]

        );

        $user = new user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->activation_token = Str::random(60); // Generate a random activation token
        $user->save();
        $mailData = [
            'title' => 'DesignAura Account Confirmation',
            'body' => 'Click Here to confirm your account',
            'name' => $request->name,
            'activation_link' => url('/activate-account?token=' . $user->activation_token)

        ];
        try{
        Mail::to($request->email)->send(new RegisterMail($mailData));

        return redirect()->back()->with('message', 'User registered successfully. Please check your email to activate your account.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send activation link. Please try again later.');
        }
    }

    public function login()
    {
        return view('home.login');
    }

    public function activateAccount(Request $request)
    {
        $token = $request->query('token');

        $user = user::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('login')->with('error', 'Invalid activation token.');
        }

        $user->is_active = true;
        $user->activation_token = null; 
        $user->save();


        return redirect('login')->with('message', 'Your account has been activated. You can now log in to your account.');
    }

    public function auth_check(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'This email is not registered in our system.'])->withInput();
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->usertype == 'admin') {
                return redirect('dashboard');
            }
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors('Your account is not activated. Please check your email for the activation link.')->withInput();
            }

            return redirect('/');
        }
        return back()->withErrors(['password' => 'The password is incorrect.'])->withInput();
    }



    public function logout()
    {
        Auth::logout();
        session()->flush();

        return redirect('/');
    }

    public function password_email(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
            ],
            [
                'email.exists' => 'No account registered with this email address',

            ]


        );
        $user = User::where('email', $request->email)->first();
        $name=$user->name;

        if ($user) {
            $user->password_reset_token = Str::random(60);
            $user->save();
            $mailData = [
                'title' => 'DesignAura Password Reset',
                'body' => 'Click Here to Reset Your Password',
                'name' => $name,
                'activation_link' => url('reset-password?token=' . $user->password_reset_token)

            ];
            try{
            Mail::to($request->email)->send(new ForgetMail($mailData));
            return redirect()->back()->with('message', 'Password reset link has been sent to your email');
            }
            catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to send password reset email. Please try again later.');
            }
            
        }

        return redirect()->back()->with('error', 'Unable to process your request.');
    }



    // AuthController
    public function showResetForm(Request $request)
    {
        
        // Display the password reset form
        return view('home.resetpassword');
    }

    public function reset_password(Request $request)
    {
        $token = $request->input('token');
        $user = User::where('password_reset_token', $token)->first();
        // Validate and process the password reset request
        $request->validate([
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/',
            'password_confirmation' => 'required|',
        

        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one special character.',
        ]);

        $user = User::where('password_reset_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired token');
        }

        $user->password = Hash::make($request->password);
        $user->password_reset_token = null; // Clear the token after activation
      
        $user->save();

        return redirect()->route('login')->with('message', 'Password reset successfully');
    }

    public function change_password()
    {
        
        if (Auth::user()->usertype == 'admin') {
            return view('admin.change_password');
        }
        return view('home.change_password');
    }

    public function update_password(Request $request)
    {
        $user = auth()->user();
        // Validate the input
        $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Old password is incorrect.');
                    }
                }
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/',
                function ($attribute, $value, $fail) use ($user) {
                    if (Hash::check($value, $user->password)) {
                        $fail('New password cannot be the same as the current password.');
                    }
                }
            ],
            'password_confirmation' => 'required',
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one special character.',
        ]);

        // Update the password
        $user->password = Hash::make($request->input('password'));
       
        $user->save();
        $mailData = [
            'title' => 'Critical security alert! Password Changed',
            'body' => 'Critical security alert your password has been changed',
            'name' => $user->name,
          
        ];
        try{
        Mail::to($user->email)->send(new SecurityMail($mailData));

        return redirect()->back()->with('message', 'Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to change password. Please try again later.');
        }
    }
}
