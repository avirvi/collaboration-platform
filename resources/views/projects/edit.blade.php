<x-layout>
    <x-slot name="title">
        Edit Project
    </x-slot>
    <h1 class="mb-4">Edit Project</h1>
    <form method="POST" action="{{ route('projects.update', $project) }}">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title"
            value="@if (old('title') !== null) {{ old('title') }} @else {{ $project->title }} @endif" class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">@if (old('description') !== null){{ old('description') }}@else{{ $project->description }}@endif</textarea>
            @error('description')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Edit Listing</button>
    </form>
</x-layout>
