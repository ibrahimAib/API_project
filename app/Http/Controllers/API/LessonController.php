<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lesson as LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesson = LessonResource::collection(Lesson::all());
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = new LessonResource(Lesson::create($request->all()));
        return $lesson->response()->setStatusCode(200, 'Lesson Created Seccefully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $lesson = new LessonResource(Lesson::findOrfail($id));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $lesson = new LessonResource(Lesson::findOrFail($id));
        $lesson->update($request->all());
        return $lesson->response()->setStatusCode(200, 'Lesson Updated Succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $id)
    {
        Lesson::findOrfail($id)->delete();
        return 204;
    }
}
