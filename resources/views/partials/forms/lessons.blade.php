<section id="lesson-popup"
    class="fixed top-1/2 left-1/2 transform bg-white p-8 rounded-lg
           -translate-x-1/2 -translate-y-1/2 shadow-2xl shadow-grey-900
           flex align-middle justify-center flex-col gap-4 max-w-sm
           opacity-0 pointer-events-none"
>


    <button id="btn-lesson-popup-close" class="absolute top-4 right-4"
        type="button"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
            class="w-6 h-6"
        >
            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
        </svg>
    </button>


    <form class="absolute top-4 left-4" id="delete-lesson-btn" method="POST">
        @csrf
        @method('DELETE')
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" class="w-6 h-6">
                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
            </svg>
        </button>
    </form>

<form class="block w-full" action="/edit-lesson" method="POST">
    @csrf

    <select class="simple-input" name="teacher_id">
        @foreach($teachers as $teacher)
            <option value="{{$teacher->id}}">
            {{$teacher->user->name}}
            </option>
        @endforeach
    </select>

    @error('teacher_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<select class="simple-input" name="subject_id">
    @foreach($subjects as $subject)
        <option value="{{$subject->id}}">
        {{$subject->name}}
        </option>
    @endforeach
</select>

@error('subject_id')
<div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <select class="simple-input" name="room_id">
        @foreach($rooms as $room)
            <option value="{{$room->id}}">
            {{$room->name}}
            </option>
        @endforeach
    </select>

    @error('room_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div>
                    <label for="start_time">Start:</label>
                    <input type="datetime-local" id="start" name="start" required/>

                    @error('start')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
</div>
<div>
                <label for="end">End:</label>
                <input type="datetime-local" id="end" name="end" required />

                @error('end')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
</div>

            <button class="std-btn">Update</button>
</form>

</section>
