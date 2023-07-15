<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\Assignment;
use App\Models\ClassModel;
use App\Models\Room;
use App\Models\Student;
use App\Models\Subject;
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
        'students' => Student::all(),
        'subjects' => Subject::all(),
        'assignments' => Assignment::all(),
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


Route::post('/create-student', [StudentController::class, 'createStudent'])->middleware('can:create-students');
Route::put('/edit-student/{student}', [StudentController::class, 'editStudent'])->middleware('can:edit-students');
Route::delete('/delete-student/{student}', [StudentController::class, 'deleteStudent'])->middleware('can:delete-students');


Route::post('/create-subject', [SubjectController::class, 'createSubject'])->middleware('can:create-subjects');
Route::put('/edit-subject/{subject}', [SubjectController::class, 'editSubject'])->middleware('can:edit-subjects');
Route::delete('/delete-subject/{subject}', [SubjectController::class, 'deleteSubject'])->middleware('can:delete-subjects');


Route::post('/create-assignment', [AssignmentController::class, 'createAssignment'])->middleware('can:create-assignments');
Route::put('/edit-assignment/{assignment}', [AssignmentController::class, 'editAssignment'])->middleware('can:edit-assignments');
Route::delete('/delete-assignment/{assignment}', [AssignmentController::class, 'deleteAssignment'])->middleware('can:delete-assignments');
