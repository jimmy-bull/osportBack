<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Rtestio;

class Rtest extends Controller
{
    public function testEvent()
    {
        $event = new Rtestio("moi je suis");
        event($event);
        return ["success" => true];
    }
}
