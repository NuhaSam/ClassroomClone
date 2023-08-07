<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TopicController;
use App\Models\Topic;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/classroom/create', [ClassroomController::class , 'create']);
Route::post('/classroom/add', [ClassroomController::class , 'add'])->name('classroom.add');

Route::get('/', [ClassroomController::class, 'show'])->name('classrooms.show');
Route::get('/classroom/view/{id}', [ClassroomController::class, 'view'])->name('classrooms.view');
Route::get('/classroom/edit/{id}', [ClassroomController::class, 'edit'])->name('classrooms.edit');
Route::put('/classroom/update/{id}', [ClassroomController::class, 'update'])->name('classrooms.update');
Route::delete('/classroom/delete/{id}', [ClassroomController::class, 'delete'])->name('classrooms.delete');

Route::get('topic/view',[TopicController::class ,'index'])->name('topic.index');
// Route::get('topic/show',[TopicController::class ,'show'])->name('topic.show');

Route::get('topic/create',[TopicController::class ,'create'])->name('topic.create');
Route::post('topic/add',[TopicController::class ,'add'])->name('topic.add');

Route::get('topic/edit/{id}',[TopicController::class ,'edit'])->name('topic.edit');
Route::put('topic/update/{id}',[TopicController::class ,'update'])->name('topic.update');

Route::delete('/topic/delete/{id}', [TopicController::class, 'delete'])->name('topic.delete');

