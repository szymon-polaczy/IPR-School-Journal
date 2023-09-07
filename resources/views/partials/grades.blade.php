<section>
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
                                <option value="{{$student->user->id}}" @if($grade->student->user->id == $student->user->id) selected @endif >
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
                    <option value="{{$student->user->id}}">
                        {{$student->user->name}}
                    </option>
                @endforeach
            </select>

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
