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
                <li>
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
                            class="@error('title') is-invalid @enderror"
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
                class="@error('title') is-invalid @enderror"
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
                <li>
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
                            class="@error('title') is-invalid @enderror"
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
                class="@error('title') is-invalid @enderror"
            />

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button>Save room</button>
        </form>
    </section>
    @endcan
</body>
</html>