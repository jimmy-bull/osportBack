<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AuctionMails;
use Illuminate\Support\Facades\Mail;
use App\Models\AuctionDate;
use App\Models\BidData;
use App\Models\estimation;
use App\Models\MainProducts;
use App\Models\Media;
use Illuminate\Support\Facades\DB;
use App\Mail\Looser;

class mailsSender extends Controller
{
    public function sendMAiltowinner(Request $request)
    {
        date_default_timezone_set('Europe/Paris');
        $realDistance = (1000 * strtotime(AuctionDate::where('article_id', '=', $request->article_id)->value('end'))) - (int)(microtime(true) * 1000);
        $realdays = floor($realDistance / (1000 * 60 * 60 * 24));
        $realHours = floor(($realDistance % (1000 * 60 * 60 * 24))  / (1000 * 60 * 60));
        $realMinutes = floor(($realDistance % (1000 * 60 * 60)) / (1000 * 60));
        $realSeconds = floor(($realDistance % (1000 * 60)) / 1000);

        $finalMinutes = floor($realdays * 1440) + floor(($realHours) * 60) + floor($realSeconds) + $realMinutes;

        if ($finalMinutes <= 0) {
            $maxprice =  BidData::where('article_id', "=", $request->article_id)->max('bidDirectly');
            if ($maxprice >= estimation::where('article_id', "=", $request->article_id)->value('minimum_price')) {
                $user_name =  DB::table('users')->where('email', "=", BidData::where('bidDirectly', "=",  $maxprice)->value('email'))->select('name')->get();
                $artcile_name = MainProducts::where('id', "=",  $request->article_id)->value('name');
                $media = Media::where('article_id', "=",  $request->article_id)->value('image_link');
                $seller_name_email = DB::table('users')->where('email', "=", MainProducts::where('id', "=",  $request->article_id)->value('user_email'))->select(['name', "email", 'telephone'])->get();

                $user_email_loosers  =  BidData::where('article_id', '=', $request->article_id)
                    ->whereNotIn('email',  [BidData::where('bidDirectly', "=",  $maxprice)->value('email')])
                    ->select('email')->groupBy('email')->get();
                //Send mail to Loosers
                $dataLooser = [];
                foreach ($user_email_loosers as $key => $value) {
                    foreach (DB::table('users')->where('email', "=", $value->email)->select('name')->get() as $key2 => $name) {
                        $dataLooser["user_name"] = $name->name;
                        $dataLooser["article_name"] = $artcile_name;
                        $dataLooser["article_image"] = str_replace("public", "storage", $media);
                        $dataLooser["winning_price"] = number_format($maxprice);
                        Mail::to($value->email)->send(new Looser($dataLooser));
                    }
                }
                $data = [
                    'user_name' => $user_name[0]->name,
                    'article_name' => $artcile_name,
                    'article_image' => str_replace("public", "storage", $media),
                    'seller_name' =>  $seller_name_email[0]->name,
                    'seller_email' =>  $seller_name_email[0]->email,
                    'seller_number' => $seller_name_email[0]->telephone,
                    'winning_price' =>  number_format($maxprice)
                ];
                //Send mail to winner
                Mail::to(BidData::where('bidDirectly', "=",  $maxprice)->value('email'))->send(new AuctionMails($data));
                echo 'mail sent';
            } else {
                return "bid not reach the reserve price";
            }
        } else return 'Sorry but auction is still alive. please contact admin for more information !' . $finalMinutes;
    }
}
// sold - not sold
