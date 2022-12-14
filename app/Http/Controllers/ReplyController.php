<?php

namespace App\Http\Controllers;

use App\Events\DeleteReplyEvent as EventsDeleteReplyEvent;
use App\Http\Resources\ReplyResource;
use App\Models\Question;
use App\Models\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        // what this jwt do?

        $this->middleware('jwt', ['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param Question $question
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Question $question,Request $request)
    {
        $request["user_id"] = auth()->id();
        $reply = $question->replies()->create($request->all());
        $user = $question->user;
        // if($reply->user_id !== $question->user_id){

            $user->notify(new NewReplyNotification($reply));
        // }
        return response(['reply'=>new ReplyResource($reply)],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @param \App\Models\Reply $reply
     * @return ReplyResource
     */
    public function show(Reply $reply)
    {
        return new ReplyResource($reply);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Question $question
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Question $question,Request $request, Reply $reply)
    {
        $reply->update($request->all());
        return response('reply update',Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Question $question,Reply $reply)
    {
        $reply->delete();
        broadcast(new EventsDeleteReplyEvent($reply->id))->toOthers();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
