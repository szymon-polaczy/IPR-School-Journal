<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TeacherController;
use App\Models\ClassModel;
use App\Models\Room;
use App\Models\Teacher;
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
})->name('homepage');


Route::get('/dashboard', function () {
    return view('dashboard', [
        'classes' => ClassModel::all(),
        'rooms' => Room::all(),
        'teachers' => Teacher::all(),
    ]);
})->name('dashboard')->middleware('auth');


Route::post('login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('login');


Route::post('/create-class', [ClassController::class, 'createClass'])->middleware('can:create-classes');
Route::put('/edit-class/{class}', [ClassController::class, 'editClass'])->middleware('can:edit-classes');
Route::delete('/delete-class/{class}', [ClassController::class, 'deleteClass'])->middleware('can:delete-classes');


Route::post('/create-room', [RoomController::class, 'createRoom'])->middleware('can:create-rooms');
Route::put('/edit-room/{room}', [RoomController::class, 'editRoom'])->middleware('can:edit-rooms');
Route::delete('/delete-room/{room}', [RoomController::class, 'deleteRoom'])->middleware('can:delete-rooms');


Route::post('/create-teacher', [TeacherController::class, 'createTeacher'])->middleware('can:create-teachers');
Route::put('/edit-teacher/{teacher}', [TeacherController::class, 'editTeacher'])->middleware('can:edit-teachers');
Route::delete('/delete-teacher/{teacher}', [TeacherController::class, 'deleteTeacher'])->middleware('can:delete-teachers');
