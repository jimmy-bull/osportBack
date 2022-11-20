<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BidData;
use Illuminate\Support\Str;
use Cknow\Money\Money;
use App\Models\AuctionDate;
use App\Models\BidAugmentation;
use App\Mail\Outbid;
use App\Http\Controllers\Calculation;

class BidController extends Controller
{
    public function check_session_token($token)
    {
        $verify_token_correct = User::where('remember_token', "=", $token)->count();
        if ($verify_token_correct > 0) {
            return 'Already connected';
        }
    }
    public function bid(Request $request)
    {
        if ($this->check_session_token($request->token) == 'Already connected') {
            $user_email = User::where('remember_token', "=", $request->token)->value("email");
            $check_if_bidtableFill = BidData::count();
            $biderId = Str::random(6);
            $bidTable = new BidData;
            date_default_timezone_set('Europe/Paris');
            $realDistance = (1000 * strtotime(AuctionDate::where('article_id', '=', $request->article_id)->value('end'))) - (int)(microtime(true) * 1000);
            $realdays = floor($realDistance / (1000 * 60 * 60 * 24));
            $realHours = floor(($realDistance % (1000 * 60 * 60 * 24))  / (1000 * 60 * 60));
            $realMinutes = floor(($realDistance % (1000 * 60 * 60)) / (1000 * 60));
            $realSeconds = floor(($realDistance % (1000 * 60)) / 1000);

            $finalMinutes = floor($realdays * 1440) + floor(($realHours) * 60) + floor($realSeconds) + $realMinutes;
            $calculation = new Calculation();
            // $finalMinutes = floor($realdays * 1440) + floor(($realHours - 1) * 60) + floor($realSeconds * 0.0166667) + $realMinutes;
            if ($check_if_bidtableFill > 0) {
                $maxBid =  BidData::where('article_id', "=", $request->article_id)->max('bidDirectly');
                // return  BidData::where('bidDirectly', "=",   $maxBid)->value('email');
                $data = [
                    'bid' =>  $maxBid,
                    // "new bid" => $request->bidEntring
                ];
                if ($finalMinutes > 3) {
                    if (
                        floor($request->bidEntring) >=  floor($calculation->calculateNextMinimumBid(BidData::where('article_id', "=", $request->article_id)->max('bidDirectly')))
                    ) {
                        $bidTable->article_id = $request->article_id;
                        $bidTable->bider_id = 'Bidder ' . $biderId;
                        $bidTable->email = $user_email;
                        $bidTable->bidDirectly =  $request->bidEntring;
                        $bidTable->autobid =  0;
                        $bidTable->save();
                       // Mail::to(BidData::where('bidDirectly', "=",   $maxBid)->value('email'))->send(new Outbid($data));
                        return 'Bid added';
                    } else {
                        return 'The next minimum bid is € ' . floor($calculation->calculateNextMinimumBid(BidData::where('article_id', "=", $request->article_id)->max('bidDirectly')));
                    }
                } else if ($finalMinutes <= 3) {
                    if (
                        floor($request->bidEntring + BidAugmentation::where('category', '=',  $request->category)->value('augmentation')) >=
                        floor($calculation->calculateNextMinimumBid(BidData::where('article_id', "=", $request->article_id)->max('bidDirectly')))
                    ) {
                        $bidTable->article_id = $request->article_id;
                        $bidTable->bider_id = 'Bidder ' . $biderId;
                        $bidTable->email = $user_email;
                        $bidTable->bidDirectly =  $request->bidEntring;
                        $bidTable->autobid =  0;
                        $bidTable->save();
                      //  Mail::to(BidData::where('bidDirectly', "=",   $maxBid)->value('email'))->send(new Outbid($data));
                        return 'Bid added';
                    } else {
                        return 'The next minimum bid is € ' . number_format(
                            floor(
                                $calculation->calculateNextMinimumBid(BidData::where('article_id', "=", $request->article_id)->max('bidDirectly'))   + BidAugmentation::where('category', '=',  $request->category)->value('augmentation')
                            )
                        );
                    }
                } else if ($realdays < 0) {
                    echo 'Could not add a bid cause time is over';
                }
            } else {
                $bidTable->article_id = $request->article_id;
                $bidTable->bider_id = 'Bidder ' . $biderId;
                $bidTable->email = $user_email;
                $bidTable->bidDirectly =  $request->bidEntring;
                $bidTable->autobid =  0;
                $bidTable->save();
                return 'Bid added';
            }
        } else {
            return 'you have to be connected before bidding';
        }
    }
    public function getBid(Request $request)
    {
        $calculation = new Calculation();
        return [
            'currentBid' =>  number_format(floor(BidData::where('article_id', "=", $request->id)->max('bidDirectly'))),

            'nextMinimumBid' => number_format($calculation->calculateNextMinimumBid((BidData::where('article_id', "=", $request->id)->max('bidDirectly')))),

            // 'nextMinimumBid' =>  number_format(floor((5 / 100) * BidData::where('article_id', "=", $request->id)->max('bidDirectly')
            //         + (BidData::where('article_id', "=", $request->id)->max('bidDirectly'))
            // )),

            "biderrDatta" =>  BidData::where('article_id', "=", $request->id)
                ->orderBy('bidDirectly', 'desc')
                ->get()
        ];
    }
}
