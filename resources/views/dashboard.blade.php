<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
<body style="margin: 120px;5">
    Dashboard

    <section style="margin-top: 50px;">
        <h2>All Clases</h2>
        <ul>
            @foreach($classes as $class)
                <li style="display: flex; gap: 20px;">
                    <a href="">
                        See {{$class->name}}
                    </a>

                    @can('edit-classes')
                    -
                    <form action="/edit-class/{{$class->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="class name"
                            value="{{$class->name}}"
                            class="@error('name') is-invalid @enderror"
                        />

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button>Update</button>
                    </form>
                    @endcan

                    @can('delete-classes')
                    -
                    <form action="/delete-class/{{$class->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-classes')
    <section style="margin-top: 50px;">
        <h2>Create a New Class</h2>
        <form action="/create-class" method="POST">
            @csrf
            
            <input type="text" name="name" 
                placeholder="class name"
                class="@error('name') is-invalid @enderror"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button>Save class</button>
        </form>
    </section>
    @endcan

    <section style="margin-top: 50px;">
        <h2>All Rooms</h2>
        <ul>
            @foreach($rooms as $room)
                <li style="display: flex; gap: 20px;">
                    <a href="">
                        See {{$room->name}}
                    </a>

                    @can('edit-rooms')
                    -
                    <form action="/edit-room/{{$room->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="room name"
                            value="{{$room->name}}"
                            class="@error('name') is-invalid @enderror"
                        />

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button>Update</button>
                    </form>
                    @endcan

                    @can('delete-rooms')
                    -
                    <form action="/delete-room/{{$room->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-rooms')
    <section style="margin-top: 50px;">
        <h2>Create a New Room</h2>
        <form action="/create-room" method="POST">
            @csrf
            
            <input type="text" name="name" 
                placeholder="room name"
                class="@error('name') is-invalid @enderror"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button>Save room</button>
        </form>
    </section>
    @endcan

    <section style="margin-top: 50px;">
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
                    <form action="/edit-teacher/{{$teacher->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')
            
                        <input type="text" name="name" 
                            placeholder="teacher name"
                            value="{{$teacher->user->name}}"
                            class="@error('name') is-invalid @enderror"
                        />
            
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <input type="text" name="surname" 
                            placeholder="teacher surname"
                            value="{{$teacher->user->surname}}"
                            class="@error('name') is-invalid @enderror"
                        />
            
                        @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <input type="email" name="email" 
                            placeholder="teacher email"
                            value="{{$teacher->user->email}}"
                            class="@error('email') is-invalid @enderror"
                        />
            
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <input type="password" name="password" 
                            placeholder="only insert password for update"
                            class="@error('password') is-invalid @enderror"
                        />
            
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            
                        <select name="default_room">
                            @foreach($rooms as $room)
                                <option value="{{$room->id}}" @if($teacher->default_room->id == $room->id) selected @endif >
                                    {{$room->name}}
                                </option>
                            @endforeach
                        </select>

                        <button>Update</button>
                    </form>
                    @endcan

                    @can('delete-teachers')
                    -
                    <form action="/delete-teacher/{{$teacher->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-teachers')
    <section style="margin-top: 50px;">
        <h2>Create a New Teacher</h2>
        <form action="/create-teacher" method="POST">
            @csrf
            
            <input type="text" name="name" 
                placeholder="teacher name"
                class="@error('name') is-invalid @enderror"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="text" name="surname" 
                placeholder="teacher surname"
                class="@error('name') is-invalid @enderror"
            />

            @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="email" name="email" 
                placeholder="teacher email"
                class="@error('email') is-invalid @enderror"
            />

            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="password" name="password" 
                placeholder="temporary password"
                class="@error('password') is-invalid @enderror"
            />

            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <select name="default_room">
                @foreach($rooms as $room)
                    <option value="{{$room->id}}">
                        {{$room->name}}
                    </option>
                @endforeach
            </select>

            <button>Save teacher</button>
        </form>
    </section>
    @endcan

    <section style="margin-top: 50px;">
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
                    <form action="/edit-student/{{$student->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')
            
                        <input type="text" name="name" 
                            placeholder="student name"
                            value="{{$student->user->name}}"
                            class="@error('name') is-invalid @enderror"
                        />
            
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <input type="text" name="surname" 
                            placeholder="student surname"
                            value="{{$student->user->surname}}"
                            class="@error('name') is-invalid @enderror"
                        />
            
                        @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <input type="email" name="email" 
                            placeholder="student email"
                            value="{{$student->user->email}}"
                            class="@error('email') is-invalid @enderror"
                        />
            
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <input type="password" name="password" 
                            placeholder="only insert password for update"
                            class="@error('password') is-invalid @enderror"
                        />
            
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            
                        <select name="class">
                            @foreach($classes as $class)
                                <option value="{{$class->id}}" @if($student->class->id == $room->id) selected @endif >
                                    {{$class->name}}
                                </option>
                            @endforeach
                        </select>

                        <button>Update</button>
                    </form>
                    @endcan

                    @can('delete-students')
                    -
                    <form action="/delete-student/{{$student->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-students')
    <section style="margin-top: 50px;">
        <h2>Create a New Student</h2>
        <form action="/create-student" method="POST">
            @csrf
            
            <input type="text" name="name" 
                placeholder="student name"
                class="@error('name') is-invalid @enderror"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="text" name="surname" 
                placeholder="student surname"
                class="@error('name') is-invalid @enderror"
            />

            @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="email" name="email" 
                placeholder="student email"
                class="@error('email') is-invalid @enderror"
            />

            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="password" name="password" 
                placeholder="temporary password"
                class="@error('password') is-invalid @enderror"
            />

            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <select name="class">
                @foreach($classes as $class)
                    <option value="{{$class->id}}">
                        {{$class->name}}
                    </option>
                @endforeach
            </select>

            <button>Save student</button>
        </form>
    </section>
    @endcan

    <section style="margin-top: 50px;">
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
                    <form action="/edit-subject/{{$subject->id}}" method="POST">
                        <!--TODO: Error - when updating and error comes through all forms show it-->
                        @csrf
                        @method('PUT')
            
                        <input type="text" name="name" 
                            placeholder="subject name"
                            value="{{$subject->name}}"
                            class="@error('name') is-invalid @enderror"
                        />
            
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            
                        <select name="teacher_id">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" @if($subject->teacher->id == $teacher->id) selected @endif >
                                    {{$teacher->user->name}}
                                </option>
                            @endforeach
                        </select>

                        <button>Update</button>
                    </form>
                    @endcan

                    @can('delete-subjects')
                    -
                    <form action="/delete-subject/{{$subject->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-subjects')
    <section style="margin-top: 50px;">
        <h2>Create a New Subject</h2>
        <form action="/create-subject" method="POST">
            @csrf
            
            <input type="text" name="name" 
                placeholder="subject name"
                class="@error('name') is-invalid @enderror"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <select name="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">
                        {{$teacher->user->name}}
                    </option>
                @endforeach
            </select>

            <button>Save subject</button>
        </form>
    </section>
    @endcan
</body>
</html>