@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @include('partials.menu')

    <div class="py-16 px-4 md:px-16">
        <!--TODO: Mobile version has to be added-->
        <main class="grid grid-cols-12 gap-4">
            <nav class="col-start-1 col-end-2">
                @if ( !auth()->user()->hasRole('Student') )
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
                @endif
                <button class="main-tab-btn block" data-tab="subjects">
                    Subjects
                </button>
                <button class="main-tab-btn block" data-tab="assignments">
                    Assignments
                </button>
                <button class="main-tab-btn block" data-tab="grades">
                    Grades
                </button>
                <button class="main-tab-btn block" data-tab="lessons">
                    Lessons
                </button>
                <button class="main-tab-btn block" data-tab="class-subject-grade">
                    Everything
                </button>
            </nav>
            <section class="col-start-3 col-end-13">
                @if (!empty($errors->all()))
                    <section class="error-wrapper rounded-2xl bg-red-200 mb-8
                        flex flex-col gap-2 text-center p-3 text-red-800"
                    >
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </section>
                @endif

                @if ( !auth()->user()->hasRole('Student') )
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
                @endif
                <section id="tab-subjects" class="tab">
                    @include('partials.subjects')
                </section>
                <section id="tab-assignments" class="tab">
                    @include('partials.assignments')
                </section>
                <section id="tab-grades" class="tab">
                    @include('partials.grades')
                </section>
                <section id="tab-lessons" class="tab">
                    @include('partials.lessons')
                </section>
                <section id="tab-class-subject-grade" class="tab">
                    @include('partials.class-subject-grade')
                </section>
            </section>
        </main>
    </div>
@endsection
