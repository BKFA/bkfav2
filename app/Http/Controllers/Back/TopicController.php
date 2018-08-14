<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\TopicRequest,
    Models\Topic
};

class TopicController extends Controller
{
    /**
     * Display a listing of the topics.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topics = Topic::oldest('id')->get();

        return view('back.topics.index', compact ('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created topic in storage.
     *
     * @param   \App\Http\Requests\TopicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        $request->merge([
            'slug_topic' => changeTitle($request->name_topic),
        ]);
        Topic::create($request->all());

        return redirect(route('topics.index'))->with('message', __('test'.$request->name_topic));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified topic in storage.
     *
     * @param  \App\Http\Requests\TopicRequest  $request
     * @param  App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, Topic $topic)
    {
        $request->merge([
            'slug_topic' => changeTitle($request->name_topic),
        ]);
        $topic->update($request->all());

        return redirect(route('topics.index'))->with('message', __('The topic has been successfully updated'));
    }

    /**
     * Remove the specified topic from storage.
     *
     * @param  App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete ();
        
        return redirect(route('topics.index'))->with('message', __('The topic has been successfully delete'));
    }

}
