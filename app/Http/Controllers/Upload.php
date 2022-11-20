<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\MainProducts;
use App\Models\Details;
use App\Models\Media;
use App\Models\category;
use App\Models\estimation;
use App\Http\Controllers\LoginRegistering;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductAdded;
// use App\Models\AuctionDate;

date_default_timezone_set('Europe/Paris');
class Upload extends Controller
{
    public function store(Request $request)
    {
      
        $checkIflogin = new LoginRegistering();
      
        if ($checkIflogin->check_session_tokenGlocbal(json_decode($request['token'])) == 'Already connected') {
          

            $add_products = new  MainProducts;

            $add_products->description = $request['description'];

            if ($request['category'] == "Cars") {
                $add_products->name = json_decode($request['attributes'])->Brand . '-' . json_decode($request['attributes'])->{'Model Type'} . '-' . json_decode($request['attributes'])->{'Year'};
            } else if ($request['category'] == "Jewelery") {
                $add_products->name = json_decode($request['attributes'])->Brand . '-' . json_decode($request['attributes'])->{'Material Fineness'};
            }


            $add_products->price =  json_decode($request['estimation'])->etsimation;
            $add_products->user_email =  User::where('remember_token', "=", json_decode($request['token']))->value("email");
            $add_products->save();

            $catID = DB::table('mshop_catalog')->where('label', '=', ($request['category']))->select('id')->get();
            $add_categories  = new category();
            $add_categories->article_id  = $add_products->id;
            $add_categories->category_id  =  $catID[0]->id;
            $add_categories->category_name  =  $request['category'];
            $add_categories->user_email =  User::where('remember_token', "=", json_decode($request['token']))->value("email");
            $add_categories->save();

            $estimation  = new estimation();
            $estimation->article_id  = $add_products->id;
            $estimation->minimum_price =  json_decode($request['estimation'])->minimumPRice;
            $estimation->user_email =  User::where('remember_token', "=", json_decode($request['token']))->value("email");
            $estimation->save();


            // //CODE FOR FACTORY HACK
            // $auctionDate = new AuctionDate();
            // $auctionDate->article_id  = $add_products->id;
            // $auctionDate->start  = date('Y-m-d H:i:s');
            // $auctionDate->end  = date('2022-06-29 0:0:0');
            // $auctionDate->price = 0;
            // $auctionDate->save();
            // //END OF CODE FOR FACTORY HACK  

            foreach (json_decode($request['attributes']) as $key =>  $value) {
                if (gettype(json_decode($request['attributes'])->$key) == 'array') {
                    foreach (json_decode($request['attributes'])->$key as $key2 => $value2) {
                        $details  = new Details();
                        $details->article_id  = $add_products->id;
                        $details->attr_type  = $key;
                        $details->attr_values  =  $value2;
                        $details->save();
                    }
                } else {
                    $details  = new Details();
                    $details->article_id  = $add_products->id;
                    $details->attr_type  = $key;
                    $details->attr_values  =  json_decode($request['attributes'])->$key;
                    $details->save();
                }
            }

            // return json_decode($request['attributes']);
            foreach ($request->file('image') as  $value) {
                $media  = new Media();
                $media->article_id  = $add_products->id;

                $image =   $value->store('public/main_images');
                //    if ($request->hasFile('image')) {
                //     //  return $request->file('image');
                //   } else {
                //       return 'no';
                //   }
                $media->image_link  =  $image;
                $media->save();
            }
            // 
            $info = [
                "brand" => json_decode($request['attributes'])->Brand,
                "category" => $request['category']
            ];
            Mail::to(User::where('remember_token', "=", json_decode($request['token']))->value("email"))->send(new ProductAdded($info));
            return 'added';
           
        }
    }
    //  }
}
