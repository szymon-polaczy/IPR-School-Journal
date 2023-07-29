@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('partials.menu')

<div class="py-16 px-4 md:px-16">

    <h1 class="text-2xl text-gray-900 text-center">
        Dashboard
    </h1>

    <section style="margin-top: 50px;">
        <h2>All Classes</h2>
        <ul>
            @foreach($classes as $class)
                <li style="display: flex; gap: 20px;">
                    <a href="">
                        See {{$class->name}}
                    </a>

                    @can('edit-classes')
                    -
                    <form class="block w-full" action="/edit-class/{{$class->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="class name"
                            value="{{$class->name}}"
                            class="@error('name') is-invalid @enderror simple-input"
                        />

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button class="std-btn">Update</button>
                    </form>
                    @endcan

                    @can('delete-classes')
                    -
                    <form class="block w-full" action="/delete-class/{{$class->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="std-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-classes')
    <section style="margin-top: 50px;">
        <h2>Create a New Class</h2>
        <form class="block w-full" action="/create-class" method="POST">
            @csrf

            <input type="text" name="name"
                placeholder="class name"
                class="@error('name') is-invalid @enderror simple-input"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button class="std-btn">Save class</button>
        </form>
    </section>
    @endcan

    <section style="margin-top: 150px;">
        <h2>All Rooms</h2>
        <ul>
            @foreach($rooms as $room)
                <li style="display: flex; gap: 20px;">
                    <a href="">
                        See {{$room->name}}
                    </a>

                    @can('edit-rooms')
                    -
                    <form class="block w-full" action="/edit-room/{{$room->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="room name"
                            value="{{$room->name}}"
                            class="@error('name') is-invalid @enderror simple-input"
                        />

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button class="std-btn">Update</button>
                    </form>
                    @endcan

                    @can('delete-rooms')
                    -
                    <form class="block w-full" action="/delete-room/{{$room->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="std-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-rooms')
    <section style="margin-top: 50px;">
        <h2>Create a New Room</h2>
        <form class="block w-full" action="/create-room" method="POST">
            @csrf

            <input type="text" name="name"
                placeholder="room name"
                class="@error('name') is-invalid @enderror simple-input"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button class="std-btn">Save room</button>
        </form>
    </section>
    @endcan

    <section style="margin-top: 150px;">
        <h2>All Teachers</h2>
        <ul>
            @foreach($teachers as $teacher)
                <li style="display: flex; gap: 20px;">
                    <p>
                        {{$teacher->user->name}} {{$teacher->user->surname}}
                        -
                        Room {{$teacher->default_room->name}}
                    </p>

                    @can('edit-teachers')
                    -
                    <form class="block w-full" action="/edit-teacher/{{$teacher->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="teacher name"
                            value="{{$teacher->user->name}}"
                            class="@error('name') is-invalid @enderror simple-input"
                        />

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="text" name="surname"
                            placeholder="teacher surname"
                            value="{{$teacher->user->surname}}"
                            class="@error('name') is-invalid @enderror simple-input"
                        />

                        @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="email" name="email"
                            placeholder="teacher email"
                            value="{{$teacher->user->email}}"
                            class="@error('email') is-invalid @enderror simple-input"
                        />

                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="password" name="password"
                            placeholder="only insert password for update"
                            class="@error('password') is-invalid @enderror simple-input"
                        />

                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select class="simple-input" name="default_room">
                            @foreach($rooms as $room)
                                <option value="{{$room->id}}" @if($teacher->default_room->id == $room->id) selected @endif >
                                    {{$room->name}}
                                </option>
                            @endforeach
                        </select>

                        <button class="std-btn">Update</button>
                    </form>
                    @endcan

                    @can('delete-teachers')
                    -
                    <form class="block w-full" action="/delete-teacher/{{$teacher->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="std-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    <section style="margin-top: 150px;">
        <h2>All Students</h2>
        <ul>
            @foreach($students as $student)
                <li style="display: flex; gap: 20px;">
                    <p>
                        {{$student->user->name}} {{$student->user->surname}}
                        -
                        Class {{$student->class->name}}
                    </p>

                    @can('edit-students')
                    -
                    <form class="block w-full" action="/edit-student/{{$student->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="student name"
                            value="{{$student->user->name}}"
                            class="@error('name') is-invalid @enderror simple-input"
                        />

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="text" name="surname"
                            placeholder="student surname"
                            value="{{$student->user->surname}}"
                            class="@error('name') is-invalid @enderror simple-input"
                        />

                        @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="email" name="email"
                            placeholder="student email"
                            value="{{$student->user->email}}"
                            class="@error('email') is-invalid @enderror simple-input"
                        />

                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="password" name="password"
                            placeholder="only insert password for update"
                            class="@error('password') is-invalid @enderror simple-input"
                        />

                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select class="simple-input" name="class">
                            @foreach($classes as $class)
                                <option value="{{$class->id}}" @if($student->class->id == $class->id) selected @endif >
                                    {{$class->name}}
                                </option>
                            @endforeach
                        </select>

                        <button class="std-btn">Update</button>
                    </form>
                    @endcan

                    @can('delete-students')
                    -
                    <form class="block w-full" action="/delete-student/{{$student->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="std-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    <section style="margin-top: 50px;">
        <h2>All Students By Class</h2>
        <ul>
            @foreach($classes as $class)
                @if($class->students->count())
                <li>
                    <p>Class {{$class->name}}</p>

                    <ul>
                        @foreach($class->students as $student)
                            <li style="display: flex; gap: 20px;">
                                <p>
                                    {{$student->user->name}} {{$student->user->surname}}
                                </p>

                                @can('edit-students')
                                -
                                <form class="block w-full" action="/edit-student/{{$student->id}}" method="POST">
                                    <!--TODO: Error - when updating and error comes through all forms show it-->
                                    @csrf
                                    @method('PUT')

                                    <input type="text" name="name"
                                        placeholder="student name"
                                        value="{{$student->user->name}}"
                                        class="@error('name') is-invalid @enderror simple-input"
                                    />

                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <input type="text" name="surname"
                                        placeholder="student surname"
                                        value="{{$student->user->surname}}"
                                        class="@error('name') is-invalid @enderror simple-input"
                                    />

                                    @error('surname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <input type="email" name="email"
                                        placeholder="student email"
                                        value="{{$student->user->email}}"
                                        class="@error('email') is-invalid @enderror simple-input"
                                    />

                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <input type="password" name="password"
                                        placeholder="only insert password for update"
                                        class="@error('password') is-invalid @enderror simple-input"
                                    />

                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <select class="simple-input" name="class">
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}" @if($student->class->id == $class->id) selected @endif >
                                                {{$class->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button class="std-btn">Update</button>
                                </form>
                                @endcan

                                @can('delete-students')
                                -
                                <form class="block w-full" action="/delete-student/{{$student->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                   <button class="std-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                        </svg>
                                    </button>
                                </form>
                                @endcan
                            </li>
                        @endforeach
                    </ul>
                </li>
                @endif
            @endforeach
        </ul>
    </section>

    <section style="margin-top: 150px;">
        <h2>All subjects</h2>
        <ul>
            @foreach($subjects as $subject)
                <li style="display: flex; gap: 20px;">
                    <p>
                        {{$subject->name}}
                        -
                        Teacher {{$subject->teacher->user->name}}
                    </p>

                    @can('edit-subjects')
                    -
                    <form class="block w-full" action="/edit-subject/{{$subject->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="subject name"
                            value="{{$subject->name}}"
                            class="@error('name') is-invalid @enderror simple-input"
                        />

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select class="simple-input" name="teacher_id">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" @if($subject->teacher->id == $teacher->id) selected @endif >
                                    {{$teacher->user->name}}
                                </option>
                            @endforeach
                        </select>

                        <button class="std-btn">Update</button>
                    </form>
                    @endcan

                    @can('delete-subjects')
                    -
                    <form class="block w-full" action="/delete-subject/{{$subject->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="std-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-subjects')
    <section style="margin-top: 50px;">
        <h2>Create a New Subject</h2>
        <form class="block w-full" action="/create-subject" method="POST">
            @csrf

            <input type="text" name="name"
                placeholder="subject name"
                class="@error('name') is-invalid @enderror simple-input"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <select class="simple-input" name="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">
                        {{$teacher->user->name}}
                    </option>
                @endforeach
            </select>

            <button class="std-btn">Save subject</button>
        </form>
    </section>
    @endcan



    <section style="margin-top: 150px;">
        <h2>All assignments</h2>
        <ul>
            @foreach($assignments as $assignment)
                <li style="display: flex; gap: 20px;">
                    <p>
                        {{$assignment->name}}
                        -
                        Teacher {{$assignment->teacher->user->name}}
                        -
                        Subject {{$assignment->subject->name}}
                        -
                        Class {{$assignment->class->name}}
                    </p>

                    @can('edit-assignments')
                    -
                    <form class="block w-full" action="/edit-assignment/{{$assignment->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="assignment name"
                            value="{{$assignment->name}}"
                            class="@error('name') is-invalid @enderror simple-input"
                        />

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select class="simple-input" name="teacher_id">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" @if($assignment->teacher->id == $teacher->id) selected @endif >
                                    {{$teacher->user->name}}
                                </option>
                            @endforeach
                        </select>

                        <select class="simple-input" name="subject_id">
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}" @if($assignment->subject->id == $subject->id) selected @endif >
                                    {{$subject->name}}
                                </option>
                            @endforeach
                        </select>

                        <select class="simple-input" name="class_id">
                            @foreach($classes as $class)
                                <option value="{{$class->id}}" @if($assignment->class->id == $class->id) selected @endif >
                                    {{$class->name}}
                                </option>
                            @endforeach
                        </select>

                        <button class="std-btn">Update</button>
                    </form>
                    @endcan

                    @can('delete-assignments')
                    -
                    <form class="block w-full" action="/delete-assignment/{{$assignment->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                       <button class="std-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-assignments')
    <section style="margin-top: 50px;">
        <h2>Create a New Assignment</h2>
        <form class="block w-full" action="/create-assignment" method="POST">
            @csrf

            <input type="text" name="name"
                placeholder="assignment name"
                class="@error('name') is-invalid @enderror simple-input"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <select class="simple-input" name="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">
                        {{$teacher->user->name}}
                    </option>
                @endforeach
            </select>

            <select class="simple-input" name="subject_id">
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">
                        {{$subject->name}}
                    </option>
                @endforeach
            </select>

            <select class="simple-input" name="class_id">
                @foreach($classes as $class)
                    <option value="{{$class->id}}">
                        {{$class->name}}
                    </option>
                @endforeach
            </select>

            <button class="std-btn">Save assignment</button>
        </form>
    </section>
    @endcan



    <section style="margin-top: 150px;">
        <h2>All grades</h2>
        <ul>
            @foreach($grades as $grade)
                <li style="display: flex; gap: 20px;">
                    <p>
                        {{$grade->assignment->name}} - {{$grade->student->user->name}} - {{$grade->value}}
                    </p>

                    @can('edit-grades')
                    -
                    <form class="block w-full" action="/edit-grade/{{$grade->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <select class="simple-input" name="assignment_id">
                            @foreach($assignments as $assignment)
                                <option value="{{$assignment->id}}" @if($grade->assignment->id == $assignment->id) selected @endif >
                                    {{$assignment->name}}
                                </option>
                            @endforeach
                        </select>

                        <select class="simple-input" name="student_id">
                            @foreach($students as $student)
                                <option value="{{$student->id}}" @if($grade->student->id == $student->id) selected @endif >
                                    {{$student->user->name}}
                                </option>
                            @endforeach
                        </select>

                        <select class="simple-input" name="value">
                            @foreach($grade_values as $value)
                                <option value="{{$value}}" @if($grade->value == $value->value) selected @endif >
                                    {{$value}}
                                </option>
                            @endforeach
                        </select>

                        <button class="std-btn">Update</button>
                    </form>
                    @endcan

                    @can('delete-grades')
                    -
                    <form class="block w-full" action="/delete-grade/{{$grade->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                         <button class="std-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-grades')
    <section style="margin-top: 50px;">
        <h2>Create a New Grade</h2>
        <form class="block w-full" action="/create-grade" method="POST">
            @csrf

            <select class="simple-input" name="assignment_id">
                @foreach($assignments as $assignment)
                    <option value="{{$assignment->id}}">
                        {{$assignment->name}}
                    </option>
                @endforeach
            </select>

            <select class="simple-input" name="student_id">
                @foreach($students as $student)
                    <option value="{{$student->id}}">
                        {{$student->user->name}}
                    </option>
                @endforeach
            </select>
            <!--TODO: Select don't have the invalid attribute-->
            <select class="simple-input" name="value">
                @foreach($grade_values as $value)
                    <option value="{{$value}}">
                        {{$value}}
                    </option>
                @endforeach
            </select>

            <button class="std-btn">Save grades</button>
        </form>
    </section>
    @endcan
</div>
@endsection
