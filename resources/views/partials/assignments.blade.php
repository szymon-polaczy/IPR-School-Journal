   <section>
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
                            class="simple-input"
                        />

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
                class="simple-input"
            />

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
