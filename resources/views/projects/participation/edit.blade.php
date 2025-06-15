<x-layout>
    <x-slot name="title">
        {{__('messages.Edit_participant')}}
    </x-slot>
    <form method="POST" action="{{ route('projects.participation.update', [$project, $participation]) }}">
        @csrf
        @method('PATCH')
        <label class="form-label">{{ $participation->user->username }}</label>
        <select name="role" class="form-select">
            <option value="participant" @if (old('role') === $participation->user_project_role || $participation->user_project_role === "participant") selected @endif>Participant</option>
            <option value="moderator" @if (old('role') === $participation->user_project_role || $participation->user_project_role === "moderator") selected @endif>Moderator</option>
        </select>
        <button type="submit" class="btn btn-primary" style="margin-top: 1em">{{__('messages.Edit_participant')}}</button>
    </form>
</x-layout>
