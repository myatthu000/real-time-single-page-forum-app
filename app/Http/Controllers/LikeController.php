<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Listeners\LikeEventListener;
use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // what this jwt do?

        $this->middleware('jwt');
    }

    public function likeIt(Reply $reply)
    {
        $reply->like()->create([
           'user_id' => auth()->id(),
            // 'user_id' => '1'

        ]);

        broadcast(new LikeEvent($reply->id,1))->toOthers();

    }

    public function unlikeIt(Reply $reply)
    {
       $reply->like()->where('user_id',auth()->id())->first()->delete();
        // $reply->like()->where('user_id',"1")->first()->delete();
        broadcast(new LikeEvent($reply->id,0))->toOthers();

    }
}
