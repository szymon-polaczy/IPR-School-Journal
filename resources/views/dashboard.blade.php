@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @include('partials.menu')

    <div class="py-16 px-4 md:px-16">
        <!--TODO: Mobile version has to be added-->
        <main class="grid grid-cols-12 gap-4">
            <nav class="col-start-1 col-end-2">
                <button class="main-tab-btn block" data-tab="classes">
                    Classes
                </button>
                <button class="main-tab-btn block" data-tab="rooms">
                    Rooms
                </button>
                <button class="main-tab-btn block" data-tab="teachers">
                    Teachers
                </button>
                <button class="main-tab-btn block" data-tab="students">
                    Students
                </button>
                <button class="main-tab-btn block" data-tab="subjects">
                    Subjects
                </button>
                <button class="main-tab-btn block" data-tab="assignments">
                    Assignments
                </button>
                <button class="main-tab-btn block" data-tab="grades">
                    Grades
                </button>
                <button class="main-tab-btn block" data-tab="class-subject-grade">
                    Everything
                </button>
            </nav>
            <section class="col-start-3 col-end-13">
                <section id="tab-classes" class="tab">
                    @include('partials.classes')
                </section>
                <section id="tab-rooms" class="tab">
                    @include('partials.rooms')
                </section>
                <section id="tab-teachers" class="tab">
                    @include('partials.teachers')
                </section>
                <section id="tab-students" class="tab">
                    @include('partials.students')
                </section>
                <section id="tab-subjects" class="tab">
                    @include('partials.subjects')
                </section>
                <section id="tab-assignments" class="tab">
                    @include('partials.assignments')
                </section>
                <section id="tab-grades" class="tab">
                    @include('partials.grades')
                </section>
                <section id="tab-class-subject-grade" class="tab">
                    @include('partials.class-subject-grade')
                </section>
            </section>
        </main>
    </div>

    <section>
        <form class="block w-full" action="/create-lesson" method="POST">
            @csrf

            <select class="simple-input" name="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">
                    {{$teacher->user->name}}
                    </option>
                @endforeach
            </select>

            @error('teacher_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <select class="simple-input" name="subject_id">
            @foreach($subjects as $subject)
                <option value="{{$subject->id}}">
                {{$subject->name}}
                </option>
            @endforeach
        </select>

        @error('subject_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <select class="simple-input" name="class_id">
        @foreach($classes as $class)
            <option value="{{$class->id}}">
            {{$class->name}}
            </option>
        @endforeach
    </select>

    @error('class_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<select class="simple-input" name="room_id">
    @foreach($rooms as $room)
        <option value="{{$room->id}}">
        {{$room->name}}
        </option>
    @endforeach
</select>

@error('room_id')
<div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select class="simple-input" name="weekday">
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                            <option value="7">Sunday</option>
                        </select>

                        @error('weekday')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="end_repeat_time">End repeat time:</label>
                    <input
                            type="date"
                            id="end_repeat_time"
                            name="end_repeat_time"
                            />

                    @error('end_repeat_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="start_time">Start hours:</label>
                <input type="time" id="start_time" name="start_time"
                                                   min="09:00" max="18:00" required/>

                @error('start_time')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror/>

            <label for="end_time">End hours:</label>
            <input type="time" id="end_time" name="end_time"
                                             min="09:00" max="18:00" required />

            @error('end_time')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button class="std-btn">Update</button>
        </form>
    </section>

    <div id="calendar"></div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '7:00:00',
                    slotMaxTime: '18:00:00',
                    events: @json($lessons),
                    eventDidMount: function(data) {
                        const lesson = data.el.getAttribute('href');
                        data.el.removeAttribute('href');
                        data.el.setAttribute('data-lesson', lesson);
                    }
                });
                calendar.render();
            });
        </script>
    @endpush

@endsection
