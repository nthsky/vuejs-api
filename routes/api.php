<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/todos',function (){
    return \App\Todo::all();
});

Route::middleware('api')->get('/todo/{id}',function ($id){
    return \App\Todo::find($id);
});

Route::post('/todo/create',function (Request $request) {
    $data = ['title' => $request->get('title'),'completed'=>0];
    $todo = App\Todo::create($data);
    return $todo;
})->middleware('api');

Route::delete('/todo/{id}/delete',function ($id) {
    $todo = \App\Todo::find($id);
    $todo->delete();
    return response()->json(['deleted']);
})->middleware('api');

Route::patch('/todo/{id}/completed',function ($id){
    $todo = \App\Todo::find($id);
    $todo->completed = !$todo->completed;
    $todo->save();
    return $todo;
})->middleware('api');
