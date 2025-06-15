<x-layout>
    <x-slot name="title">
        {{__('messages.Add_participant')}}
    </x-slot>
    <form method="POST" action="{{ route('projects.participation.store', $project) }}">
        @csrf
        <label class="form-label">{{__('auth.Username')}}</label>
        <input type="text" name="username" value="{{ old('username') }}"
            class="form-control @error('username') is-invalid @enderror">
        @error('username')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <select name="role" class="form-select">
            <option value="participant">{{__('messages.Participant')}}</option>
            <option value="moderator">{{__('messages.Moderator')}}</option>
        </select>
        <button type="submit" class="btn btn-primary" style="margin-top: 1em">{{__('messages.Add_participant')}}</button>
    </form>
</x-layout>
