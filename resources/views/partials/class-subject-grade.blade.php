<section>
    <h2>Everything at once only displaying for now</h2>

    @foreach($classes as $class)
        <button class="main-tab-btn-inside mr-3" data-tab="class-{{$class->id}}">
            {{$class->name}}
        </button>
    @endforeach

    @foreach($classes as $class)
        <section id="tab-class-{{$class->id}}" class="tab-inside">
            @foreach($subjects as $subject)
                <article class="mt-6">
                    <h3>{{$subject->name}}</h3>

                    @if(is_countable($students) && count($students) > 1)
                    <table class="mt-28">
                    @else
                    <table class="mt-6">
                    @endif
                        <thead>
                            <tr>
                                <th>Assignment</th>

                                @if(is_countable($students) && count($students) > 1)
                                    @foreach($students as $student)
                                        <th class="user-table-names">
                                            {{$student->user->name}}&nbsp;{{$student->user->surname}}
                                        </th>
                                    @endforeach
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($assignments as $assignment)
                                @if ($assignment->subject->id == $subject->id && $assignment->class->id === $class->id)
                                    <tr>
                                        <td>{{$assignment->name}}</td>

                                        @foreach($students as $student)
                                            @if ($student->grade)
                                                @if($student->grade->assignment->id === $assignment->id)
                                                    <td>
                                                        {{$student->grade->value}}
                                                    </td>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </article>
            @endforeach
        </section>
    @endforeach
</section>
