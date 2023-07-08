<?php

namespace Database\Seeders;

use App\Enums\GradeEnums;
use App\Models\Assignment;
use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Room;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create(array(
            'name' => 'thomas',
            'surname' => 'frey',
            'email' => 'frey_work@tutanota.com',
            'password' => Hash::make('password')
        ));

        $user_teacher = User::create(array(
            'name' => 'tim',
            'surname' => 'teacher',
            'email' => 'teacher@email.com',
            'password' => Hash::make('password'),
        ));

        $room = Room::create(array(
            'name' => 'gym',
        ));

        $teacher = Teacher::create(array(
            'user_id' => $user_teacher->id,
            'default_room_id' => $room->id
        ));

        $subject = Subject::create(array(
            'name' => 'gymnastics',
            'teacher_id' => $teacher->id,
        ));

        $user_student = User::create(array(
            'name' => 'jimmy',
            'surname' => 'student',
            'email' => 'student@email.com',
            'password' => Hash::make('password'),
        ));

        $class = ClassModel::create(array(
            'name' => '3TI',
        ));

        $student = Student::create(array(
            'user_id' => $user_student->id,
            'class_id' => $class->id
        ));

        $assignment = Assignment::create(array(
            'name' => 'hand stand',
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'class_id' => $class->id,
        ));

        $grade = Grade::create(array(
            'value' => GradeEnums::Five_Minus,
            'student_id' => $student->id,
            'assignment_id' => $assignment->id,
        ));
    }
}
