<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Calculation extends Controller
{
    public function baseNextbidInterval()
    {
        return  [
            "0-1000" => 100,
            "1000-5000" => 250,
            "5000-10000" => 500,
            "10000-10000000000000000000000000000000000000000" => 1000,
        ];
        /**
         * 1-500 = 50 500-1 000=100 1 000-5 000=250 5 000-10 000=500 more than 10 000 = 1000
         */
    }
    public function calculateNextMinimumBid($currentBid)
    {  //$currentBid = 12000;
        foreach ($this->baseNextbidInterval() as $key => $value) {
            if ($currentBid >= intval(explode("-",  $key)[0]) &&  $currentBid <= intval(explode("-",  $key)[1])) {
           return intval($this->baseNextbidInterval()[$key]) + $currentBid;
                exit();
            }
        }
    }
}
