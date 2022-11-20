<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidData;
use App\Http\Controllers\LoginRegistering;
use App\Models\User;
use App\Models\AuctionDate;
use Illuminate\Support\Facades\DB;
use App\Models\MainProducts;
use App\Models\User_status_product;
use App\Models\favoris;
use App\Models\category;
use App\Mail\registerMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Email_verif;
use Illuminate\Support\Facades\Hash;

date_default_timezone_set('Europe/Paris');
class UserSpace extends Controller
{
    public function getBid(Request $request)
    {
        $getInfor  = new  LoginRegistering();
        if ($getInfor->check_session_token($request) == 'Already connected') {
            $usermail = User::where('remember_token', "=", $request->token)->value("email");

            $live =  AuctionDate::join("bid_data", "auction_dates.article_id", "=", "bid_data.article_id")
                ->join('main_products', 'auction_dates.article_id', '=', 'main_products.id')
                ->join('media', 'auction_dates.article_id', '=', 'media.article_id')
                // ->leftJoin('main_products', 'bid_data.article_id', "=", 'main_products.id',)
                ->join('categories', 'auction_dates.article_id', '=', 'categories.article_id')
                ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                ->where("bid_data.email", "=", $usermail)->orderBy("bid_data.bidDirectly", 'desc')->get()->groupBy("article_id")->skip(0)->take(25);
            // return $live;



            $won =   User_status_product::join('main_products', 'user_status_products.article_id', '=', 'main_products.id')
                ->join("bid_data", "user_status_products.article_id", "=", "bid_data.article_id")
                ->join('media', 'user_status_products.article_id', '=', 'media.article_id')
                ->join('auction_dates', 'user_status_products.article_id', '=', 'auction_dates.article_id')
                ->join('categories', 'user_status_products.article_id', '=', 'categories.article_id')
                ->where('user_status_products.status', '=', "won")
                ->where("user_status_products.email", "=", $usermail)
                ->orderBy("bid_data.bidDirectly", 'desc')->get()->groupBy("article_id")->skip(0)->take(25);

            $lost =   User_status_product::join('main_products', 'user_status_products.article_id', '=', 'main_products.id')
                ->join("bid_data", "user_status_products.article_id", "=", "bid_data.article_id")
                ->join('media', 'user_status_products.article_id', '=', 'media.article_id')
                ->join('auction_dates', 'user_status_products.article_id', '=', 'auction_dates.article_id')
                ->join('categories', 'user_status_products.article_id', '=', 'categories.article_id')
                ->where('user_status_products.status', '=', "lost")
                ->where("user_status_products.email", "=", $usermail)
                ->orderBy("bid_data.bidDirectly", 'desc')->get()->groupBy("article_id")->skip(0)->take(25);


            return [$live, $won, $lost];

            // return  DB::select("select * from `main_products` inner join `bid_data` on `main_products`.`id` = `bid_data`.`article_id` inner join `estimations` 

        }
    }
    public function updatename(Request $request)
    {  //return $request->token;
        $getInfor  = new  LoginRegistering();
        //  return $getInfor->check_session_token($request);
        if ($getInfor->check_session_token($request) == 'Already connected') {
            // $usermail = User::where('remember_token', "=", $request->token)->value("email");
            User::where('remember_token', "=", $request->token)->update([
                'name' => $request->firstname . " " . $request->lastname,
                "firstname"  => $request->firstname,
                "lastname"  => $request->lastname,
            ]);
            return "name updated";
        } else {
            return "There is problem. Please contact the webmaster. for more infomation.";
        }
    }
    public function getUserInfo(Request $request)
    {
        $verify_token_correct = User::where('remember_token', "=", $request->token)->count();
        if ($verify_token_correct > 0) {
            return User::where('remember_token', "=", $request->token)->get();
        }
    }
    public function updateemail(Request $request)
    {
        $getInfor  = new  LoginRegistering();
        if ($getInfor->login($request)[0] != 'Cannot login, check your password or email.') {
            if (User::where('email', "=", $request->newemail)->count() == 0) {


                $lastname =  User::where('email', "=", $request->email)->value("lastname");
                $firstname =  User::where('email', "=", $request->email)->value("firstname");


                User::where('email', "=", $request->email)->update([
                    'email_verified_at' => null
                ]);


                User::where('email', "=", $request->email)->update([
                    'email' => $request->newemail
                ]);



                MainProducts::where('user_email', "=", $request->email)->update([
                    'user_email' => $request->newemail
                ]);

                BidData::where('email', "=", $request->email)->update([
                    'email' => $request->newemail
                ]);

                favoris::where('user_email', "=", $request->email)->update([
                    'user_email' => $request->newemail
                ]);

                category::where('user_email', "=", $request->email)->update([
                    'user_email' => $request->newemail
                ]);

                User_status_product::where('email', "=", $request->email)->update([
                    'email' => $request->newemail
                ]);

                $_Email_verif = new Email_verif();
                $codey =  $_Email_verif->index($request->newemail);
                $info = [
                    'user_name' => $firstname . $lastname,
                    'code' =>   $codey,
                    'mail' => md5($request->newemail),
                ];
                Mail::to($request->newemail)->send(new registerMail($info));

                return $request->newemail;
            } else {
                return 'This email already exist, please try to enter a different email or login.';
            }
        } else {
            return 'Cannot login, check your password or email.';
        }
    }
    public function updatepass(Request $request)
    {
        if (User::where('remember_token', "=", $request->token)->count() > 0) {

            $hashedPassword =  User::where('remember_token', "=", $request->token)->value("password");

            if (Hash::check($request->password, $hashedPassword)) {
                //return $request->password;
                User::where('remember_token', "=", $request->token)
                    ->update([
                        'password' => Hash::make($request->newpassword),
                    ]);
                return 'password updated';
            } else {
                return "Cannot login, check your current password.";
            }
        } else {
            return "Cannot login, check your current password.";
        }
    }
}
