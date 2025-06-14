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
                        {{ $task->title }}
                    </td>
                    <td>
                        {{ $task->deadline }}
                    </td>
                    <td>
                        {{ $task->status_id }}
                    </td>
                    <td>
                        {{ $task->responsible_person }}
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
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
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
