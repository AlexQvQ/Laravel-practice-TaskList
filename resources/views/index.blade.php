

<h1>Task list</h1>

<div>
    <a href="{{route('tasks.create')}}">Add</a>
</div>

@if(count($tasks))
<p>We are have a work!</p>


@foreach($tasks as $task)
<div>
    <a href="{{ route('tasks.show', $task ) }}">{{ $task->title }}</a>
</div>
@endforeach

@if ($tasks->count())
    <div>    {{ $tasks->links() }}
    </div>
    @endif
@else
<p>Ok, i'm sleep, bye</p>
@endif

