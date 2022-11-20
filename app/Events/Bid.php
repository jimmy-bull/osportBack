<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Http\Request;
use App\Models\BidData;
use App\Models\User;
use App\Models\BidAugmentation;
use App\Http\Controllers\Calculation;

class Bid implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $currentBid;
    public $nextMinimumBid;
    public $biderrDatta;

    //public $message;

    public function check_session_token($token)
    {
        $verify_token_correct = User::where('remember_token', "=", $token)->count();
        if ($verify_token_correct > 0) {
            return 'Already connected';
        }
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    // public function __construct($id, $category) //$id, $token
    // {  //var_dump(openssl_get_cert_locations()); 

    //     $get_augmentation = 0;
    //     $calculation = new Calculation();
    //     if ($category > 0) {
    //         $get_augmentation =  BidAugmentation::where('category', '=', $category)->value('augmentation');
    //     }

    //     $this->currentBid = number_format(BidData::where('article_id', "=", $id)->max('bidDirectly'));

    //     $this->nextMinimumBid =
    //         number_format(floor($calculation->calculateNextMinimumBid(BidData::where('article_id', "=", $id)->max('bidDirectly'))  + $get_augmentation));

    //     $this->biderrDatta = BidData::where('article_id', "=", $id)->orderBy('bidDirectly', 'desc')->get();
    // }

    public function __construct($id) //$id, $token
    {  //var_dump(openssl_get_cert_locations()); 

        // $get_augmentation = 0;
        // $calculation = new Calculation();
        // if ($category > 0) {
        //     $get_augmentation =  BidAugmentation::where('category', '=', $category)->value('augmentation');
        // }

        $this->currentBid = "jimmy";

        $this->nextMinimumBid = "Bull";

        $this->biderrDatta = "est le best";
    }

    // public function broadcastAs()
    // {
    //     return 'bidsystem';
    // }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('bid-system-channel');
    }
}
