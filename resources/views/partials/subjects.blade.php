<section>
    <h2>All subjects</h2>
    <ul>
        @foreach($subjects as $subject)
            <li style="display: flex; gap: 20px;">
                <p>
                    {{$subject->name}}
                    - Teacher {{$subject->teacher->user->name}}
                </p>

                @can('edit-subjects')
                -
                <form class="block w-full" action="/edit-subject/{{$subject->id}}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <input type="text" name="name"
                        placeholder="subject name"
                        value="{{$subject->name}}"
                        class="simple-input"
                    />

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
            class="simple-input"
        />

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

