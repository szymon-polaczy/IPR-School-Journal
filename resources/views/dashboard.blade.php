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
<body>
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

            <button>Save room</button>
        </form>
    </section>
    @endcan
</body>
</html>