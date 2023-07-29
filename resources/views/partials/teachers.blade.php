<section>
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
