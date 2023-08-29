<section>
    <h2>Everything at once only displaying for now</h2>

    @foreach($classes as $class)
        <button class="main-tab-btn-inside" data-tab="class-{{$class->id}}">
            {{$class->name}}
        </button>
    @endforeach

    @foreach($classes as $class)
        <section id="tab-class-{{$class->id}}" class="tab-inside">
            @foreach($subjects as $subject)
                <article>
                    <h3>{{$subject->name}}</h3>

                    <table class="mt-32">
                        <thead>
                            <tr>
                                <th>Assignment</th>

                                @foreach($students as $student)
                                    <th class="user-table-names">
                                        {{$student->user->name}}&nbsp;{{$student->user->surname}}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($assignments as $assignment)
                                @if ($assignment->subject->id == $subject->id && $assignment->class->id === $class->id)
                                    <tr>
                                        <td>{{$assignment->name}}</td>

                                        @foreach($students as $student)
                                            {{$student->name}}
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
