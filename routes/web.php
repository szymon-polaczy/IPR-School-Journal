<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\RoomController;
use App\Models\ClassModel;
use App\Models\Room;
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
    ]);
})->name('dashboard')->middleware('auth');

Route::post('login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('login');

Route::post('/create-class', [ClassController::class, 'createClass']);
Route::put('/edit-class/{class}', [ClassController::class, 'editClass']);
Route::delete('/delete-class/{class}', [ClassController::class, 'deleteClass']);


Route::post('/create-room', [RoomController::class, 'createRoom']);
Route::put('/edit-room/{room}', [RoomController::class, 'editRoom']);
Route::delete('/delete-room/{room}', [RoomController::class, 'deleteRoom']);
