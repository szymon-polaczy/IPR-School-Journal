<?php

namespace Database\Seeders;

use App\Enums\GradeEnums;
use App\Models\Assignment;
use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Lesson;
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
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);

        $admin = User::create(array(
            'name' => 'thomas',
            'surname' => 'frey',
            'email' => 'frey_work@tutanota.com',
            'password' => Hash::make('password')
        ));

        $admin->assignRole('Admin');

        $room = Room::create(array(
                'name' => 'gym',
        ));

        $teacher = Teacher::create(array(
            'user_id' => User::create(array(
                'name' => 'tim',
                'surname' => 'teacher',
                'email' => 'teacher@email.com',
                'password' => Hash::make('password'),
            ))->assignRole('Teacher')->id,
            'default_room_id' => $room->id,
        ));

        $class = ClassModel::create(array(
                'name' => '3TI',
        ));

        $subject = Subject::create(array(
            'name' => 'gymnastics',
            'teacher_id' => $teacher->id,
            'class_id' => $class->id,
        ));

        $student = Student::create(array(
            'user_id' => User::create(array(
                'name' => 'jimmy',
                'surname' => 'student',
                'email' => 'student@email.com',
                'password' => Hash::make('password'),
            ))->assignRole('Student')->id,
            'class_id' => $class->id,
        ));

        $assignment = Assignment::create(array(
            'name' => 'hand stand',
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'class_id' => $class->id,
        ));

        $grade = Grade::create(array(
            'value' => GradeEnums::Five_Minus,
            'student_id' => $student->user->id,
            'assignment_id' => $assignment->id,
        ));

        $lesson = Lesson::create(array(
            'title' => $subject->name . ' ' . $class->name,
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'class_id' => $class->id,
            'room_id' => $room->id,
            'start' => date('Y-m-d') . ' 8:00:00',
            'end' => date('Y-m-d') . ' 8:45:00',
        ));
    }
}
