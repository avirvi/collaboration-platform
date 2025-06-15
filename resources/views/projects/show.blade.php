<x-layout>
    <x-slot name="title">
        {{ $project->title }}
    </x-slot>
    <h1>{{ $project->title }}</h1>
    <p>{{ $project->description }}</p>

    @can('delete', $project)
        <form action="{{ route('projects.destroy', $project) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this project?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style="margin-top: 1em">Delete Project</button>
        </form>
    @endcan

    @can('update', $project)
        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary" style="margin-top: 0.5em; margin-bottom: 1em">Edit Project</a>
    @endcan

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
                        <div class="d-flex">
                            @can('delete', $task)
                                <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="padding-top: 0"><img
                                            src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.iconsdb.com%2Ficons%2Fdownload%2Fred%2Ftrash-2-512.png&f=1&nofb=1&ipt=b3bdb08d51c4d76c80ac646ca5750f9c365663d60f48eab7fa2ffc5db06d72d0"
                                            width="18px" height="18px"></button>
                                </form>
                            @endcan
                            @can('update', $task)
                                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="btn"
                                    style="padding-top: 0"><img
                                        src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ficon-library.com%2Fimages%2Ficon-pen%2Ficon-pen-6.jpg&f=1&nofb=1&ipt=44e8e662f0c95bf960658b2f9c8970e13b16b7acbd12f544da21fded866118bc"
                                        width="18px" height="18px"></a>
                            @endcan

                            {{ $task->title }}
                        </div>
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

    @can('create', [App\Models\Participation::class, $project])
        <a href="{{ route('projects.participation.create', $project) }}" class="btn btn-primary">Add Participant</a>
    @endcan

    <table class="table table-bordered caption-top">
        <caption>
            Project Participants
        </caption>
        <tr>
            <th>
                Username
            </th>
            <th>
                Role
            </th>
        </tr>
        @foreach ($participation as $participant)
            <tr>
                <td>
                    {{ $participant->user->username }}
                </td>
                <td>
                    <div class="d-flex">
                        {{ $participant->user_project_role }}
                        @can('delete', $participant)
                            <form action="{{ route('projects.participation.destroy', [$project, $participant]) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this participant?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="padding-top: 0"><img
                                        src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.iconsdb.com%2Ficons%2Fdownload%2Fred%2Ftrash-2-512.png&f=1&nofb=1&ipt=b3bdb08d51c4d76c80ac646ca5750f9c365663d60f48eab7fa2ffc5db06d72d0"
                                        width="18px" height="18px"></button>
                            </form>
                        @endcan
                        @can('update', $participant)
                            <a href="{{ route('projects.participation.edit', [$project, $participant]) }}" class="btn"
                                style="padding-top: 0"><img
                                    src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ficon-library.com%2Fimages%2Ficon-pen%2Ficon-pen-6.jpg&f=1&nofb=1&ipt=44e8e662f0c95bf960658b2f9c8970e13b16b7acbd12f544da21fded866118bc"
                                    width="18px" height="18px"></a>
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</x-layout>
