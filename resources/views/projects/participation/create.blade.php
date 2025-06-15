<x-layout>
    <x-slot name="title">
        Add Participant
    </x-slot>
    <form method="POST" action="{{ route('projects.participation.store', $project) }}">
        @csrf
        <input type="text" name="username" value="{{ old('username') }}"
            class="form-control @error('username') is-invalid @enderror">
        @error('username')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <select name="role" class="form-select">
            <option value="participant">Participant</option>
            <option value="moderator">Moderator</option>
        </select>
        <button type="submit" class="btn btn-primary" style="margin-top: 1em">Add</button>
    </form>
</x-layout>
