<?php

use App\Http\Controllers\API\RelationshipController;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Tag;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\returnSelf;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1'], function () {

    // Lessons Routes...........................................

    Route::apiResource('lessons', 'App\\Http\\Controllers\\API\LessonController');
    Route::apiResource('users', 'App\\Http\\Controllers\\API\UserController');
    Route::apiResource('tags', 'App\\Http\\Controllers\\API\TagController');

    Route::get('users/{id}/lessons', 'App\\Http\\Controllers\\API\RelationshipController@userLessons');
    Route::get('lessons/{id}/tags', 'App\\Http\\Controllers\\API\RelationshipController@lessonTags');
    Route::get('tags/{id}/lessons', 'App\\Http\\Controllers\\API\RelationshipController@tagLessons');

    Route::any('lesson', function () {
        $massage = "Please make sure to update your cond to use the newer version of our API.
        You shuld use lessons instead of lessons";
        return response()->json([
            'data' => $massage,
            'link' => url('documentation/api'),
        ], 404);
    });
});

Route::domain('{account}.mypp.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        // 
    });
});

Route::get('lessons/{lesson:slug}', function ($lesson) {
    return $lesson;
});

Route::fallback(function () {
    echo 'something get wrong';
});
