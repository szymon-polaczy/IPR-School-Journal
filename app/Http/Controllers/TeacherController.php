<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function editTeacher(Teacher $teacher, Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'password',
            'email' => array('required', 'email:rfc,strict,dns,spoof,filter,filter_unicode'),
            'default_room' => array('required', 'integer'),
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

        $teacher->user->update($user_fields);

        $teacher_fields = array(
            'default_room_id' => $incomingFields['default_room'],
        );
        $teacher->update($teacher_fields);

        return redirect('dashboard');
    }

    public function deleteTeacher(Teacher $teacher) {
        $teacher->user->delete();
        $teacher->delete();
        return redirect('dashboard');
    }

    public function createTeacher(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => array('required', 'email:rfc,strict,dns,spoof,filter,filter_unicode', 'unique:users'),
            'password' => array('required', 'min:8'),
            'default_room' => array('required', 'integer'),
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['surname'] = strip_tags($incomingFields['surname']);

        Teacher::create(array(
            'user_id' => User::create(array(
                'name' => $incomingFields['name'],
                'surname' => $incomingFields['surname'],
                'email' => $incomingFields['email'],
                'password' => $incomingFields['password'],
            ))->assignRole('Teacher')->id,
            'default_room_id' => $incomingFields['default_room'],
        ));
        
        return redirect('dashboard');
    }
}
