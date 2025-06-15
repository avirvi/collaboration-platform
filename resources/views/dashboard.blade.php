<x-layout>
    <x-slot name="title">
        User Dashboard
    </x-slot>
    <h1 class="mb-4">Hello, {{ auth()->user()->username }}!</h1>
    <table class="table table-bordered caption-top">
        <caption>
            Your tasks
        </caption>
        <tr>
            <th>
                Task
            </th>
            <th>
                Due
            </th>
            <th>
                Status
            </th>
            <th>
                Project
            </th>
        </tr>
        <!-- display the user's tasks if there are any, otherwise a corresponding message -->
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
                        {{ $task->taskStatus->status }}
                    </td>
                    <td>
                        {{ $task->project->title }}
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

    <br>
    <h6 class="text-muted">Your projects</h6>
    @if ($projects->count())
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-6 col-lg-4">
                    <x-project-card :project='$project' />
                </div>
            @endforeach
        </div>
    @else
        <p>
            You don't have any projects.
        </p>
    @endif

</x-layout>
