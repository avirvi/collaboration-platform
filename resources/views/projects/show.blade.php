<x-layout>
    <x-slot name="title">
        {{ $project->title }}
    </x-slot>
    <h1>{{ $project->title }}</h1>
    <p>{{ $project->description }}</p>

    <table class="table table-bordered caption-top">
        <caption>
            Tasks
        </caption>
        <tr>
            <th>
                Task
            </th>
            <th>
                Deadline
            </th>
            <th>
                Status
            </th>
            <th>
                Assigned To
            </th>
        </tr>
        @if ($tasks->count())
            @foreach ($tasks as $task)
                <tr>
                    <td>
                        @can('delete', $task)
                            <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="margin-top: 1em">Delete</button>
                            </form>
                        @endcan
                        @can('update', $task)
                            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="btn btn-primary">Edit</a>
                        @endcan
                        {{ $task->title }}
                    </td>
                    <td>
                        {{ $task->deadline }}
                    </td>
                    <td>
                        {{ $task->taskStatus->status }}
                    </td>
                    <td>
                        @if ($task->user !== null)
                        {{ $task->user->username }}
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">
                    There are no tasks.
                </td>
            </tr>
        @endif
    </table>

    @can('create', [App\Models\Task::class, $project])
        <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary">Add Task</a>
    @endcan

    @can('update', $project)
        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit</a>
    @endcan

    @can('delete', $project)
        <form action="{{ route('projects.destroy', $project) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this project?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style="margin-top: 1em">Delete</button>
        </form>
    @endcan
</x-layout>
