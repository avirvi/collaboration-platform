<x-layout>
    <x-slot name="title">
        Create New Task
    </x-slot>
    <h1 class="mb-4">Create New Task</h1>
    <form method="POST" action="{{ route('projects.tasks.store', $project) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="date" name="deadline" value="{{ old('deadline') }}" class="form-control @error('deadline') is-invalid @enderror">
            @error('deadline')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Completion Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="">Select Status</option>
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" @if(old('status') == $status->id) selected @endif>{{ $status->status }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Assign To</label>
            <select name="responsible_person" class="form-select @error('responsible_person') is-invalid @enderror">
                <option value="">Select Participant</option>
                @foreach($participants as $participant)
                <option value="{{ $participant->id }}" @if(old('responsible_person') == $participant->id) selected @endif>{{ $participant->username }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</x-layout>
