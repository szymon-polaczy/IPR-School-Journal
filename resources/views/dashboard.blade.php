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
                });
                calendar.render();
            });
    </script>
@endpush

@endsection
