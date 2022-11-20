<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Details;
use App\Models\estimation;
use App\Models\MainProducts;
use App\Models\Media;
use App\Models\BidData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LoginRegistering;
use App\Models\User;
use App\Models\User_status_product;


date_default_timezone_set('Europe/Paris');

class SellSpaceManagement extends Controller
{
    // 
    public function getPRoductformanagement(Request $request)
    {
        // email; status 0  = pending, 1 = accepted, -1 = need ajustement,  -2 = declined can't upload a again

        // get name, get category, get image first, get name, get id, get highest bid, 

        $getInfor  = new  LoginRegistering();
        if ($getInfor->check_session_token($request) == 'Already connected') {
            if ($request->status  == 1 && $request->state == "live") {  // FOR PRODUCT THAT I'VE BEEN ACCEPTED / type:live, sold, not sold, will start soon
                $user_mail =  User::where('remember_token', "=", $request->token)->value("email");
                $bofore =  MainProducts::where('status', "=", $request->status)
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->where('main_products.user_email', "=",   $user_mail)
                    ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                    ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->orderBy("bid_data.bidDirectly", 'desc')
                    ->get()->groupBy("id");

                $table = [];
                foreach ($bofore as $key => $value) {
                    array_push($table, $bofore[$key][0]);
                }
                return $table;
            } else if ($request->status  == 1 && $request->state == "sold") {  // FOR PRODUCT THAT I'VE BEEN ACCEPTED / type:live, sold, not sold, will start soon
                $user_mail =  User::where('remember_token', "=", $request->token)->value("email");
                $bofore = MainProducts::where('main_products.status', "=", $request->status)
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('article_solds', 'main_products.id', '=', 'article_solds.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->where('main_products.user_email', "=",   $user_mail)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly",
                    )->orderBy("bid_data.bidDirectly", 'desc')
                    ->get()->groupBy("id");
                $table = [];
                foreach ($bofore as $key => $value) {
                    array_push($table, $bofore[$key][0]);
                }
                return $table;
            } else if ($request->status  == 1 && $request->state == "not-sold") {  // FOR PRODUCT THAT I'VE BEEN ACCEPTED / type:live, sold, not sold, will start soon
                $user_mail =  User::where('remember_token', "=", $request->token)->value("email");
                $bofore  =  MainProducts::where('main_products.status', "=", $request->status)
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('article_losts', 'main_products.id', '=', 'article_losts.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->where('main_products.user_email', "=",   $user_mail)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly",
                    )->orderBy("bid_data.bidDirectly", 'desc')
                    ->get()->groupBy("id");
                $table = [];
                foreach ($bofore as $key => $value) {
                    array_push($table, $bofore[$key][0]);
                }
                return $table;
            } else if ($request->status  == 1 && $request->state == "comming") {  // FOR PRODUCT THAT I'VE BEEN ACCEPTED / type:live, sold, not sold, will start soon
                $user_mail =  User::where('remember_token', "=", $request->token)->value("email");
                $bofore =   DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                    ->where('main_products.user_email', "=",   $user_mail)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->orderBy("bid_data.bidDirectly", 'desc')
                    ->get()->groupBy("id");

                $table = [];
                foreach ($bofore as $key => $value) {
                    array_push($table, $bofore[$key][0]);
                }
                return $table;
            } else {
                return 'There is a, Please contact the webmaster.';
            }
        } else {
            return 'There is a, Please contact the webmaster.';
        }
    }

    public function productajustement(Request $request)
    {
        $getInfor  = new  LoginRegistering();
        if ($getInfor->check_session_token($request) == 'Already connected' && $request->status == -1) {
            $user_mail =  User::where('remember_token', "=", $request->token)->value("email");
            $bofore  =   MainProducts::where('status', "=", $request->status)
                ->join('media', 'main_products.id', '=', 'media.article_id')
                // ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                ->join('categories', 'main_products.id', '=', 'categories.article_id')
                ->where('main_products.user_email', "=",   $user_mail)
                ->select(
                    'main_products.id',
                    'main_products.name',
                    'media.image_link',
                    'categories.category_name',
                    'categories.category_id',
                    // "bid_data.bidDirectly"
                )
                ->get()->groupBy("id");

            $table = [];
            foreach ($bofore as $key => $value) {
                array_push($table, $bofore[$key][0]);
            }
            return $table;
        } else {
            return 'There is a problem, Please contact the webmaster.';
        }
    }

    public function productdeclined(Request $request)
    {
        $getInfor  = new  LoginRegistering();
        if ($getInfor->check_session_token($request) == 'Already connected' && $request->status == -2) {
            $user_mail =  User::where('remember_token', "=", $request->token)->value("email");
            $bofore =   MainProducts::where('status', "=", $request->status)
                ->join('media', 'main_products.id', '=', 'media.article_id')
                // ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                ->join('categories', 'main_products.id', '=', 'categories.article_id')
                ->where('main_products.user_email', "=",   $user_mail)
                ->select(
                    'main_products.id',
                    'main_products.name',
                    'media.image_link',
                    'categories.category_name',
                    'categories.category_id',
                    // "bid_data.bidDirectly"
                )
                ->get()->groupBy("id");

            $table = [];
            foreach ($bofore as $key => $value) {
                array_push($table, $bofore[$key][0]);
            }
            return $table;
        } else {
            return 'There is a problem, Please contact the webmaster.';
        }
    }

    public function productpending(Request $request)
    {
        $getInfor  = new  LoginRegistering();
        if ($getInfor->check_session_token($request) == 'Already connected' && intval($request->status) == 0) {
            $user_mail =  User::where('remember_token', "=", $request->token)->value("email");
            $bofore =   MainProducts::where('status', "=", $request->status)
                ->join('media', 'main_products.id', '=', 'media.article_id')
                // ->join('media', 'main_products.id', '=', 'media.article_id')
                // ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                ->join('categories', 'main_products.id', '=', 'categories.article_id')
                ->where('main_products.user_email', "=",   $user_mail)
                ->select(
                    'main_products.id',
                    'main_products.name',
                    'media.image_link',
                    'categories.category_name',
                    'categories.category_id',
                    // "bid_data.bidDirectly"
                )
                ->get()->groupBy("id");
            $table = [];
            foreach ($bofore as $key => $value) {
                array_push($table, $bofore[$key][0]);
            }
            return $table;
        } else {
            return 'There is a problem, Please contact the webmaster.';
        }
    }
}
