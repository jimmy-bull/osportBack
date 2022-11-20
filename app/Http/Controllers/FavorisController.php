<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\favoris;
use App\Models\User;
use App\Http\Controllers\LoginRegistering;
use Illuminate\Support\Facades\DB;
use App\Models\BidData;

class FavorisController extends Controller
{

    public function checkIfALlReadyLikedFunction($article_id, $token)
    {
        $checkIfALlReadyLiked =  favoris::where('article_id', $article_id)->where(
            'user_email',
            User::where('remember_token', "=", $token)->value("email")
        )->count();
        return  $checkIfALlReadyLiked;
    }
    public function add(Request $request)
    {
        $getInfor  = new  LoginRegistering();
        if ($getInfor->check_session_token($request) == 'Already connected') {

            if ($this->checkIfALlReadyLikedFunction($request->article_id, $request->token) == 0) {
                $favoris = new favoris();
                $favoris->user_email = User::where('remember_token', "=", $request->token)->value("email");
                $favoris->article_id = $request->article_id;
                $favoris->save();

                $keep  = favoris::where('user_email', "=", User::where('remember_token', "=",  $request->token)->value("email"))->pluck("article_id");
                $array = [];
                foreach ($keep  as $key => $value) {
                    array_push($array,  $value);
                }
                return $array;
            } else {
                favoris::where('article_id', $request->article_id)
                    ->where('user_email', "=", User::where('remember_token', "=",  $request->token)->value("email"))->delete();

                $keep  = favoris::where('user_email', "=", User::where('remember_token', "=",  $request->token)->value("email"))->pluck("article_id");
                $array = [];
                foreach ($keep  as $key => $value) {
                    array_push($array,  $value);
                }
                return $array;
            }
        } else {
            return 'not connected';
        }
    }
    public function seeIfLIked(Request $request)
    {
        $getInfor  = new  LoginRegistering();
        if ($getInfor->check_session_token($request) == 'Already connected') {
            $keep  = favoris::where('user_email', "=", User::where('remember_token', "=",  $request->token)->value("email"))->pluck("article_id");
            $array = [];
            foreach ($keep  as $key => $value) {
                array_push($array,  $value);
                // array_push($array,  array($value => 'red'));
            }
            return $array;
        } else {
            return 'not connected';
        }
    }
    public function mostLiked()
    {
        $table = [];
        foreach (favoris::all()->groupBy('article_id') as $key => $value) {
            if (sizeof($value) > 1) {
                array_push($table, $value);
            }
        }
        return $table;
    }
    public function test(Request $request)
    {
        return  DB::table('mshop_index_attribute')->join(
            'mshop_index_catalog',
            'mshop_index_attribute.prodid',
            '=',
            'mshop_index_catalog.prodid'
        )->where('mshop_index_catalog.catid', '=', $request->catID)->select('type')->groupBy('type')->get();
    }

    public function seeIfLIked_GET(Request $request)
    {

        $oo =  BidData::select('article_id')->distinct()->get();
        $idTable = [];
        foreach ($oo as $key => $value) {
            array_push(
                $idTable,
                BidData::where('article_id', "=",  $value->article_id)->max('bidDirectly')
            );
        }
        $getInfor  = new  LoginRegistering();
        if ($getInfor->check_session_token($request) == 'Already connected') {
            $keep  = favoris::where('user_email', "=", User::where('remember_token', "=",  $request->token)->value("email"))->pluck("article_id");
            $array = [];
            foreach ($keep  as $key => $value) {
                array_push($array,  $value);
            }
            return DB::table('main_products')
                ->join('media', 'main_products.id', '=', 'media.article_id')
                ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                ->join('categories', 'main_products.id', '=', 'categories.article_id')
                ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                ->join('estimations', 'main_products.id', '=', 'estimations.article_id')
                // ->join('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                // ->whereIn('bid_data.bidDirectly',  $idTable)
                ->select(
                    'main_products.id',
                    'main_products.name',
                    'media.image_link',
                    'auction_dates.end',
                    'categories.category_name',
                    'categories.category_id',
                    'main_products.description',
                    'main_products.price',
                    'estimations.minimum_price',
                    "bid_data.bidDirectly"
                )->whereIn('main_products.id', $array)->get()->groupBy("id");
        } else {
            return 'not connected';
        }
    }
}
