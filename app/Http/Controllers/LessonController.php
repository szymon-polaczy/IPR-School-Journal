<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function editLesson(Lesson $lesson, Request $request) {
        $incomingFields = $request->validate([
            'subject_id' => array('required', 'integer'),
            'teacher_id' => array('required', 'integer'),
            'room_id' => array('required', 'integer'),
            'start' => array('required'),
            'end' => array('required'),
        ]);

        $lesson->update($incomingFields);

        return redirect('dashboard');
    }

    public function deleteLesson(Lesson $lesson) {
        $lesson->delete();
        return redirect('dashboard');
    }

    public function createLesson(Request $request) {
        $incomingFields = $request->validate([
            'subject_id' => array('required', 'integer'),
            'teacher_id' => array('required', 'integer'),
            'class_id' => array('required', 'integer'),
            'room_id' => array('required', 'integer'),
            'end_repeat_time' => array('required'),//TODO: add global option in settings for this
            'weekday' => array('required', 'integer'),
            'start_time' => array('required'),
            'end_time' => array('required'),
        ]);

        $subject = DB::table('subject')->where('id', $incomingFields['subject_id'])->first();
        $class = DB::table('class')->where('id', $incomingFields['class_id'])->first();

        $incomingFields['title'] = sprintf('(%s) %s', $class->name, $subject->name);

        $currentDate = Carbon::now();
        $start_time_arr = preg_split("/:/", $incomingFields['start_time']);
        $end_time_arr = preg_split("/:/", $incomingFields['end_time']);

        $currentDate->setTime($start_time_arr[0], $start_time_arr[1], 0);

        while ($currentDate->isBefore($incomingFields['end_repeat_time'])) {
            if ($currentDate->dayOfWeekIso == $incomingFields['weekday']) {
                $endDate = $currentDate->copy();
                $endDate->setTime($end_time_arr[0], $end_time_arr[1], 0);

                $incomingFields['start'] = $currentDate->toDateTimeString();
                $incomingFields['end'] = $endDate->toDateTimeString();

                Lesson::create($incomingFields);
            }

            $currentDate->addDay();
        }

        return redirect('dashboard');
    }
}
