<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function editStudent(Student $student, Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'password',
            'email' => array('required', 'email:rfc,strict,dns,spoof,filter,filter_unicode'),
            'class' => array('required', 'integer'),
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['surname'] = strip_tags($incomingFields['surname']);

        $user_fields = array(
            'name' => $incomingFields['name'],
            'surname' => $incomingFields['surname'],
            'email' => $incomingFields['email'],
        );

        if (isset($incomingFields['password'])) {
            //TODO: Validate min 8 length
            $user_fields['password'] = $incomingFields['password'];
        }

        $student->user->update($user_fields);

        $student_fields = array(
            'class_id' => $incomingFields['class'],
        );
        $student->update($student_fields);

        return redirect('dashboard');
    }

    public function deleteStudent(Student $student) {
        $student->user->delete();
        $student->delete();
        return redirect('dashboard');
    }

    public function createStudent(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => array('required', 'email:rfc,strict,dns,spoof,filter,filter_unicode', 'unique:users'),
            'password' => array('required', 'min:8'),
            'class' => array('required', 'integer'),
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['surname'] = strip_tags($incomingFields['surname']);

        Student::create(array(
            'user_id' => User::create(array(
                'name' => $incomingFields['name'],
                'surname' => $incomingFields['surname'],
                'email' => $incomingFields['email'],
                'password' => $incomingFields['password'],
            ))->assignRole('Student')->id,
            'class_id' => $incomingFields['class'],
        ));
        
        return redirect('dashboard');
    }
}
