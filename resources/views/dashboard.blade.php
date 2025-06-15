<x-layout>
    <x-slot name="title">
        {{__('messages.Dashboard')}}
    </x-slot>
    <h1 class="mb-4">Hello, {{ auth()->user()->username }}!</h1>
    <table class="table table-bordered caption-top">
        <caption>
            {{__('messages.Your_tasks')}}
        </caption>
        <tr>
            <th>
                {{__('messages.Task')}}
            </th>
            <th>
                {{__('messages.Due')}}
            </th>
            <th>
                {{__('messages.Status')}}
            </th>
            <th>
                {{__('messages.Project')}}
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
                    {{__('messages.No_tasks')}}
                </td>
            </tr>
        @endif
    </table>

    <br>
    <h6 class="text-muted">{{__('messages.Your_projects')}}</h6>
    @if ($projects->count())
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-6 col-lg-4">
                    <x-project-card :project="$project" />
                </div>
            @endforeach
        </div>
    @else
        <p>
            {{__('messages.No_projects')}}
        </p>
    @endif

</x-layout>
