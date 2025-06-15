<x-layout>
    <x-slot name="title">
        Edit Task
    </x-slot>
    <h1 class="mb-4">Edit Task</h1>
    <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title"
                value="{{ old('title', $task->title) }}"
                class="form-control @error('title') is-invalid @enderror">
            @error('title')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="date" name="deadline"
                value="{{ old('deadline', \Carbon\Carbon::parse($task->deadline)->format('Y-m-d')) }}"
                class="form-control @error('deadline') is-invalid @enderror">
            @error('deadline')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Completion Status</label>
            <select name="status_id" class="form-select @error('status_id') is-invalid @enderror">
                <option value="">Select Status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" @if (old('status_id') === $task->status_id || $task->status_id === $status->id) selected @endif>
                        {{ $status->status }}</option>
                @endforeach
            </select>
            @error('status_id')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Assign To</label>
            <select name="responsible_person" class="form-select @error('responsible_person') is-invalid @enderror">
                <option value="">Select Participant</option>
                @foreach ($participants as $participant)
                    <option value="{{ $participant->id }}" @if (old('responsible_person') === $task->responsible_person || $task->responsible_person === $participant->id) selected @endif>
                        {{ $participant->username }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Edit Task</button>
    </form>
</x-layout>
