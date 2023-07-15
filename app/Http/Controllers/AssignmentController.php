<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function editAssignment(Assignment $assignment, Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'teacher_id' => array('required', 'integer'),
            'subject_id' => array('required', 'integer'),
            'class_id' => array('required', 'integer'),
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        $assignment->update($incomingFields);
        
        return redirect('dashboard');
    }

    public function deleteAssignment(Assignment $assignment) {
        $assignment->delete();
        return redirect('dashboard');
    }

    public function createAssignment(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'teacher_id' => array('required', 'integer'),
            'subject_id' => array('required', 'integer'),
            'class_id' => array('required', 'integer'),
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        Assignment::create($incomingFields);
        
        return redirect('dashboard');
    }
}
