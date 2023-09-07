<section>
    <h2>Everything at once only displaying for now</h2>

    @foreach($classes as $class)
        <button class="main-tab-btn-inside mr-3" data-tab="class-{{$class->id}}">
            {{$class->name}}
        </button>
    @endforeach

    @foreach($classes as $class)
        <section id="tab-class-{{$class->id}}" class="tab-inside">
            @foreach($class->subjects as $subject)
                <article class="mt-6">
                    <h3><b>{{$subject->name}}</b></h3>

                    <table class="mt-6">
                        <tbody>
                            @foreach($class->students as $student)
                                <tr>
                                    <td>{{ $student->user->name }}</td>

                                    @foreach($student->grades as $grade)
                                        <td>
                                            <span>{{ $grade->value }}</span>
                                            <div>{{ $grade->assignment->name }}</div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </article>
            @endforeach
        </section>
    @endforeach
</section>
