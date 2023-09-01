<section>
    <h2>Lessons</h2>

    @can('create-lessons')
        <form class="block w-full" action="/create-lesson" method="POST">
            @csrf

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

            <select class="simple-input" name="room_id">
                @foreach($rooms as $room)
                    <option value="{{$room->id}}">
                    {{$room->name}}
                    </option>
                @endforeach
            </select>

            <select class="simple-input" name="weekday">
                <option value="1">Monday</option>
                <option value="2">Tuesday</option>
                <option value="3">Wednesday</option>
                <option value="4">Thursday</option>
                <option value="5">Friday</option>
                <option value="6">Saturday</option>
                <option value="7">Sunday</option>
            </select>

            <label for="end_repeat_time">End repeat time:</label>
            <input
                    type="date"
                    id="end_repeat_time"
                    name="end_repeat_time"
                    />

            <label for="start_time">Start hours:</label>
            <input type="time"
                   id="start_time"
                   name="start_time"
                   min="09:00" max="18:00" required
                   />

            <label for="end_time">End hours:</label>
            <input type="time"
                   id="end_time"
                   name="end_time"
                   min="09:00" max="18:00" required
                   />

            <button class="std-btn">Create</button>
        </form>
    @endcan

    <div id="calendar" class="mt-6"></div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '7:00:00',
                    slotMaxTime: '18:00:00',
                    events: @json($lessons),
                    eventDidMount: function(data) {
                        const lesson = data.el.getAttribute('href');
                        data.el.removeAttribute('href');
                        data.el.setAttribute('data-lesson', lesson);
                    }
                });
                calendar.render();
            });
        </script>
    @endpush
</section>
