<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Email_verif;
use App\Mail\registerMail;
use Illuminate\Support\Facades\Mail;

class LoginRegistering extends Controller
{
    public function register(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $verify_if_email_exist = User::where('email', "=", $request->email)->count();
            if ($verify_if_email_exist > 0) {
                return 'This email already exists.';
            } else if ($verify_if_email_exist == 0) {
                $token_without_hash = Str::random(100);
                $accounts = new  User;
                $accounts->email =  $request->email;
                $accounts->name =  $request->firstname;
                $accounts->lastname = $request->lastname;
                $accounts->city =  $request->ville;
                $accounts->country =  "FRANCE";
                $accounts->password =  Hash::make($request->password);
                $accounts->remember_token = $token_without_hash;
                $accounts->latitude =  $request->latitude;
                $accounts->longitude  =  $request->longitude;
                $accounts->save();
                $_Email_verif = new Email_verif();
                $codey =  $_Email_verif->index($request->email);
             //   return $codey;
                $info = [
                    'user_name' => $request->firstname . $request->lastname,
                    'code' =>   $codey,
                    'mail' => md5($request->email),
                ];
                //return  $info;
                Mail::to($request->email)->send(new registerMail($info));

                return "confirm mail";
            }
        } else {
            return 'Enter a valid email.';
        }
    }
    public function check_session_token(Request $request)
    {
        $verify_token_correct = User::where('remember_token', "=", $request->token)->count();
        if ($verify_token_correct > 0) {
            return 'Already connected';
        } else {
            return 'token not good.';
        }
    }
    public function login(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $verify_if_email_exist_and_pass_correct =  User::where('email', "=", $request->email)->count();
            $checkifvalidate =  User::where('email', "=", $request->email)->whereNull('email_verified_at')->count();
            if ($checkifvalidate == 0) {
                if ($verify_if_email_exist_and_pass_correct > 0) {
                    $hashedPassword =  User::where('email', "=", $request->email)->value("password");
                    if (Hash::check($request->password, $hashedPassword)) {
                        $token_without_hash = Str::random(100);
                        User::where('email', "=", $request->email)->update(["remember_token" => $token_without_hash]);
                        return [$token_without_hash, User::where('email', "=", $request->email)->value("lastname")];
                    } else {
                        return ['Cannot login, check your password or email.'];
                    }
                } else {
                    return ['Cannot login, check your password or email.'];
                }
            } else {
                $_Email_verif = new Email_verif();
                $codey =  $_Email_verif->index($request->email);
                $lastname =  User::where('email', "=", $request->email)->value("lastname");
                $firstname =  User::where('email', "=", $request->email)->value("name");
                $info = [
                    'user_name' => $firstname . $lastname,
                    'code' =>   $codey,
                    'mail' => md5($request->email),
                ];
                Mail::to($request->email)->send(new registerMail($info));
                return ['confirm mail'];
            }
        } else {
            return ['Cannot login, check your password or email.'];
        }
    }
    public function check_session_tokenGlocbal($request)
    {
        $verify_token_correct = User::where('remember_token', "=", $request)->count();
        if ($verify_token_correct > 0) {
            return 'Already connected';
        }
    }
}
