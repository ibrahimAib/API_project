<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Tag;

class RelationshipController extends Controller
{

    public function userLessons($id)
    {
        $user = User::findOrfail($id)->lessons;

        return $user;
    }
    public function lessonTags($id)
    {
        $lesson = Lesson::findOrfail($id)->tags;
        $fields = array();
        $filtered = array();
        foreach ($lesson as $tag) {
            $fields['Title'] = $tag->name;
            $filtered[] = $fields;
        }
        return response()->json($filtered);
    }
    public function tagLessons($id)
    {
        $tag = Tag::findOrfail($id)->lessons;
        $fields = array();
        $filtered = array();
        foreach ($tag as $lesson) {
            $fields['Title'] = $lesson->title;
            $fields['Content'] = $lesson->body;
            $filtered[] = $fields;
        }
        return response()->json([
            'data' => $filtered
        ], 200);
    }
}
