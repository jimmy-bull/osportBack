<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Models\AuctionDate;
use App\Models\MainProducts;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmProduct;
use App\Mail\declineProduct;

class UploadAdmin extends Controller
{
    public function setProductDate(Request $request)
    {
        $AuctionDate = new AuctionDate();
        $AuctionDate->start = date_format(date_create($request->start), "Y-m-d H:i:s");
        $AuctionDate->end = date_format(date_create($request->end), "Y-m-d H:i:s");
        $AuctionDate->article_id =  $request->article_id;
        $AuctionDate->price =  0;
        $AuctionDate->save();

        MainProducts::where('id',  $request->article_id)->update(['status' => 1]);


        $info = [
            "name" => MainProducts::where('id',  $request->article_id)->value('name')
        ];
        Mail::to(MainProducts::where('id',  $request->article_id)->value('user_email'))->send(new ConfirmProduct($info));

        return back()->withInput();
    }
    public function declineProduct(Request $request)
    {

        $info = [
            "name" => MainProducts::where('id',  $request->article_id)->value('name'),
            "message" => $request->message
        ];

        Mail::to(MainProducts::where('id',  $request->article_id)->value('user_email'))->send(new declineProduct($info));

        return back()->withInput();
    }
}
