<section>
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
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="student name"
                            value="{{$student->user->name}}"
                            class="simple-input"
                        />

                        <input type="text" name="surname"
                            placeholder="student surname"
                            value="{{$student->user->surname}}"
                            class="simple-input"
                        />

                        <input type="email" name="email"
                            placeholder="student email"
                            value="{{$student->user->email}}"
                            class="simple-input"
                        />

                        <input type="password" name="password"
                            placeholder="only insert password for update"
                            class="simple-input"
                        />

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
                                    @csrf
                                    @method('PUT')

                                    <input type="text" name="name"
                                        placeholder="student name"
                                        value="{{$student->user->name}}"
                                        class="simple-input"
                                    />

                                    <input type="text" name="surname"
                                        placeholder="student surname"
                                        value="{{$student->user->surname}}"
                                        class="simple-input"
                                    />

                                    <input type="email" name="email"
                                        placeholder="student email"
                                        value="{{$student->user->email}}"
                                        class="simple-input"
                                    />

                                    <input type="password" name="password"
                                        placeholder="only insert password for update"
                                        class="simple-input"
                                    />

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
