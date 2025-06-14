<x-layout>
    <x-slot name="title">
        Create New Project
    </x-slot>
    <h1 class="mb-4">Create New Project</h1>
    <form method="POST" action="{{ route('projects.store') }}">
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
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Listing</button>
    </form>
</x-layout>
