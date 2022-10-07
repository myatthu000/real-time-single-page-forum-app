<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return QuestionResource::collection(Question::query()->latest()->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        auth()->user()->question()->create($request->all());
        Question::query()->create($request->all());
        return \response('Created',Response::HTTP_CREATED);

//        Question::query()->create($request->only([
//            'title','slug', 'body','category_id','user_id'
//        ]));


//        $question = new Question();
//        $question->title = $request->title;
//        $question->slug = Str::of($question->title)->slug('-');
//        $question->body = $request->body;
//        $question->category_id = $request->category_id;
//        $question->user_id = $request->user_id;
//        $question->saveOrFail();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return QuestionResource
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return  response(null, Response::HTTP_NO_CONTENT);
    }
}
