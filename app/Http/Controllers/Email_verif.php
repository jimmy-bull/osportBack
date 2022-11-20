<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\verification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Forgotpass;
use Illuminate\Support\Facades\Hash;

date_default_timezone_set('Europe/Paris');

class Email_verif extends Controller
{
    public function index($email)
    {
        $code = $this->generateUniqueCode();
        $verif = new verification();
        $verif->email = $email;
        $verif->verification_code =  $code;
        $verif->verification_code_end =  $this->addMinutes();
        $verif->save();
        return  $code;
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateUniqueCode()
    {
        do {
            $code = random_int(1000, 9999);
        } while (verification::where("verification_code", "=", $code)->first());

        return $code;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addMinutes()
    {

        $minutes_to_add = 30;

        $time = new \DateTime();
        $time->add(new \DateInterval('PT' . $minutes_to_add . 'M'));
        $stamp = $time->format('Y-m-d H:i:s');
        return  $stamp;
    }
    public function confirmemail(Request $request)
    {
        if (verification::where("verification_code", "=", $request->code)->where('verification_code_end', '>=', date('Y-m-d H:i:s'))->count() == 1) {
            User::where(
                'email',
                "=",
                verification::where("verification_code", "=", $request->code)->where('verification_code_end', '>=', date('Y-m-d H:i:s'))->value("email")
            )->update(['email_verified_at' => new \DateTime()]);

            verification::where("verification_code", "=", $request->code)->delete();
            return 'updated';
        } else {
            return 'this code is expire or it invalid';
        }
    }

    public function changePass($email)
    {
        $code = md5(strval($this->generateUniqueCode()));
        $verif = new verification();
        $verif->email = $email;
        $verif->verification_code =  $code;
        $verif->verification_code_end =  $this->addMinutes();
        $verif->save();


        $info = [
            'requestCode' =>   $code
        ];
        Mail::to($email)->send(new Forgotpass($info));

        return "mail have been sent";
    }

    public function updatepass(Request $request)
    {
        if (verification::where("verification_code", "=", $request->code)->where('verification_code_end', '>=', date('Y-m-d H:i:s'))->count() == 1) {
            User::where(
                'email',
                "=",
                verification::where("verification_code", "=", $request->code)->where('verification_code_end', '>=', date('Y-m-d H:i:s'))->value("email")
            )->update(['password' => Hash::make($request->pass)]);
            return "code updated";
        } else {
            return 'code expire';
        }
    }

    public function testIfrequestExpire(Request $request)
    {
        if (verification::where("verification_code", "=", $request->code)->where('verification_code_end', '>=', date('Y-m-d H:i:s'))->count() == 0) {
            return 'code expire';
        } else {
            return 'good code';
        }
    }
}

