<?php

use App\Enums\GradeEnums;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\Assignment;
use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Room;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

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
        'grades' => Grade::all(),
        'grade_values' => GradeEnums::cases(),
        'lessons' => collect(Lesson::all())->map(function( $lesson ) {
            $lesson['url'] = json_encode($lesson);//hacky work around
            return $lesson;
        }),
    ]);
})->name('dashboard')->middleware('auth');


Route::post('login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('login');
Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

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


Route::post('/create-grade', [GradeController::class, 'createGrade'])->middleware('can:create-grades');
Route::put('/edit-grade/{grade}', [GradeController::class, 'editGrade'])->middleware('can:edit-grades');
Route::delete('/delete-grade/{grade}', [GradeController::class, 'deleteGrade'])->middleware('can:delete-grades');

Route::post('/create-lesson', [LessonController::class, 'createLesson'])->middleware('can:create-lessons');
Route::put('/edit-lesson/{lesson}', [LessonController::class, 'editLesson'])->middleware('can:edit-lessons');
Route::delete('/delete-lesson/{lesson}', [LessonController::class, 'deleteLesson'])->middleware('can:delete-lessons');

Route::post('/create-user', function(Request $request) {
    $incomingFields = $request->validate([
        'user_type' => 'required',
    ]);

    switch($incomingFields['user_type']) {
        case 'student':
            return app(StudentController::class)->callAction('createStudent', [$request]);
            break;
        case 'teacher':
            return app(TeacherController::class)->callAction('createTeacher', [$request]);
            break;
        case 'admin':
            //TODO: I actually did't create anything for admins when I think about it
            break;
    }
})->middleware('can:create-users');
