<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function editClass(ClassModel $class, Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required|unique:class|max:255',
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        $class->update($incomingFields);
        return redirect('dashboard');
    }

    public function deleteClass(ClassModel $class) {
        $class->delete();
        return redirect('dashboard');
    }

    public function createClass(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required|unique:class|max:255',
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);

        ClassModel::create($incomingFields);
        
        return redirect('dashboard');
    }
}
