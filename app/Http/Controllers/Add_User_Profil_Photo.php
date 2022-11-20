<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users_Profile_Photo;
use App\Models\User;

class Add_User_Profil_Photo extends Controller
{
    //
    public function add_user_image(Request $request)
    {
        $checkfirs =  User::where('remember_token', "=", $request->token)->count();
        // return $checkfirs ;
        if ($checkfirs > 0) {
            $check = Users_Profile_Photo::where('email', "=", User::where('remember_token', "=", $request->token)->value("email"))->count();
            //return $check;
            if ($check == 0) {
                $addPhoto = new Users_Profile_Photo();
                $addPhoto->email =  User::where('remember_token', "=", $request->token)->value("email");
                $image = $request->file('image')->store('public/profils_photos');
                $addPhoto->image  =  $image;
                $addPhoto->save();
                return json_encode('added');
            } else {
                $image = $request->file('image')->store('public/profils_photos');
                Users_Profile_Photo::where('email', "=", User::where('remember_token', "=", $request->token)->value("email"))
                    ->update(["image" => $image]);
                return  json_encode('added');
            }
        }

        return 'not added connection problem';
    }
    public function getProfilPhoto(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            return Users_Profile_Photo::where('email', "=", User::where('remember_token', "=", $request->token)->value("email"))->value("image");
        }
        return 'not connected';
    }
    public function getUserName(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            return User::where('remember_token', "=", $request->token)->select(['name', "lastname", "city", 'email'])->get();
        } else {
            return 'not connected';
        }
    }

    public function getProfilPhoto_mail(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            return Users_Profile_Photo::where('email', "=", $request->email)->value("image");
        }
        return 'not connected';
    }


    public function getUserName_mail(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            return User::where('email', "=", User::where('remember_token', "=", $request->token)->value("email"))->select(['name', "lastname", "city"])->get();
        } else {
            return 'not connected';
        }
    }

    public function getUserName_mail_visted_profil(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            return User::where('email', "=", $request->email)->select(['name', "lastname", "city"])->get();
        } else {
            return 'not connected';
        }
    }
}
