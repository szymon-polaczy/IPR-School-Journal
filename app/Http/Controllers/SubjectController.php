<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function editSubject(Subject $subject, Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'teacher_id' => array('required', 'integer'),
        ]);

        $subject->update($incomingFields);

        return redirect('dashboard');
    }

    public function deleteSubject(Subject $subject) {
        $subject->delete();
        return redirect('dashboard');
    }

    public function createSubject(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required|unique:subject',
            'teacher_id' => array('required', 'integer'),
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        Subject::create($incomingFields);

        return redirect('dashboard');
    }
}
