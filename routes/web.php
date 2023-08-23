<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\ClassworkUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TopicController;
use PhpParser\Builder\Class_;

// use App\Models\Topic;
// use Illuminate\Support\Facades\Route;


Route::get('/classroom/create', [ClassroomController::class, 'create'])->middleware('auth');
Route::post('/classroom/add', [ClassroomController::class, 'add'])->name('classroom.add');

Route::get('/', [ClassroomController::class, 'show'])->name('classrooms.show')->middleware('auth');
Route::get('/classroom/view/{id}', [ClassroomController::class, 'view'])->name('classrooms.view');
Route::get('/classroom/edit/{id}', [ClassroomController::class, 'edit'])->name('classrooms.edit');
Route::put('/classroom/update/{id}', [ClassroomController::class, 'update'])->name('classrooms.update');
Route::delete('/classroom/delete/{id}', [ClassroomController::class, 'delete'])->name('classrooms.delete');

Route::get('topic/view', [TopicController::class, 'index'])->name('topic.index');
// Route::get('topic/show',[TopicController::class ,'show'])->name('topic.show');

Route::get('topic/create', [TopicController::class, 'create'])->name('topic.create');
Route::post('topic/add', [TopicController::class, 'add'])->name('topic.add');

Route::get('topic/edit/{id}', [TopicController::class, 'edit'])->name('topic.edit');
Route::put('topic/update/{id}', [TopicController::class, 'update'])->name('topic.update');

Route::delete('/topic/delete/{id}', [TopicController::class, 'delete'])->name('topic.delete');

route::get('login', [LoginController::class, 'login'])->name('login');
route::post('login', [LoginController::class, 'login'])->name('login');
// Route::resource('/tpoic',TopicController::class);


Route::group([
    'middleware' => ['auth'],
], function () {
    Route::prefix('/classroom/trashed/')
        ->as('classroom.')
        ->controller(ClassroomController::class)
        ->group(function () {
            Route::get('/', 'trashed')->name('trashed');
            Route::put('/{id}', 'restore')->name('restore');
            Route::delete('/{id}', 'forceDelete')->name('forceDelete');
        });
});
Route::group([
    'middleware' => ['auth'],
], function () {
    Route::prefix('/topic/trashed/')
        ->as('topic.')
        ->controller(TopicController::class)
        ->group(function () {
            Route::get('/', 'trashed')->name('trashedTopics');
            Route::get('/{id}', 'restoreTopic')->name('restoreTopic');
            Route::delete('/{id}', 'forceDeleteTopic')->name('forceDeleteTopic');
        });
});

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::prefix('classroom')
            ->controller(JoinClassroomController::class)
            ->as('classrooms.')
            ->group(function () {
                Route::get('/{classroom}/join', 'create')->name('join');

                Route::put('/{classroom}/join', 'store')->name('joinStore');
            });
    }
);

Route::resource('classroom.classworks',ClassworkController::class);
Route::get('classrooms/{classroom}/people/',ClassworkUserController::class)->name('classrooms.people');
Route::delete('classrooms/{classroom}/people/',[ClassworkUserController::class,'destroy'])->name('classrooms.people.destroy');

Route::post('comment/',[CommentController::class,'store'])->name('comment.store');

Route::post('submissions/{classwork}',[SubmissionController::class,'store'])->name('submission.store')
;
Route::get('submissions/{submission}/file',[SubmissionController::class,'file'])->name('submission.file');
// Route::get('/classroom/{classroom}/join',[JoinClassroomController::class,'create'])-->name('classrooms.join');
// Route::put('/classroom/{classroom}/join',[JoinClassroomController::class,'store'])->name('classrooms.joinStore');
require __DIR__ . '/auth.php';

