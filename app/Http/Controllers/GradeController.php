<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function editGrade(Grade $grade, Request $request) {
        $incomingFields = $request->validate([
            'value' => 'required',
            'student_id' => array('required', 'integer'),
            'assignment_id' => array('required', 'integer'),
        ]);

        $grade->update($incomingFields);
        
        return redirect('dashboard');
    }

    public function deleteGrade(Grade $grade) {
        $grade->delete();
        return redirect('dashboard');
    }

    public function createGrade(Request $request) {
        $incomingFields = $request->validate([
            'value' => 'required',
            'student_id' => array('required', 'integer'),
            'assignment_id' => array('required', 'integer'),
        ]);

        Grade::create($incomingFields);
        
        return redirect('dashboard');
    }
}
