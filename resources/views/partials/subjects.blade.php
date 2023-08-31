<section>
    <h2 class="mb-8">All subjects</h2>
    <ul class="flex flex-col gap-2">
        @foreach($subjects as $subject)
            <li style="display: flex; gap: 20px;">
                <p class="w-full">
                    {{$subject->name}}
                    - Teacher {{$subject->teacher->user->name}}
                </p>

                @can('edit-subjects')
                <button class="open-edit-subject std-btn"
                    data-subject="{{
                        json_encode(
                            array(
                                'id' => $subject['id'],
                                'name' => $subject['name'],
                                'teacher_id' => $subject['teacher_id']
                            )
                        )
                    }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" class="w-4 h-4 fill-white">
                        <path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/>
                    </svg>
                </button>
                @endcan

                @can('delete-subjects')
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

@can('edit-subjects')
    <section id="edit-subject-popup"
             class="fixed top-1/2 left-1/2 transform bg-white p-8 pt-16 rounded-lg
                    -translate-x-1/2 -translate-y-1/2 shadow-2xl shadow-grey-900
                    flex align-middle justify-center flex-col gap-4 max-w-sm
                    opacity-0 pointer-events-none"
             >

             <button
                id="btn-edit-subject-popup-close"
                     class="absolute top-4 right-4"
                     type="button"
                     >
                     <svg xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 384 512"
                          class="w-6 h-6"
                          >
                          <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                     </svg>
             </button>

                 <form class="block w-full" action="/edit-subject" method="POST" id="edit-subject">
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
    </section>
@endcan

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

