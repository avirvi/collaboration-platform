<x-layout>
    <x-slot name="title">
        {{__('messages.New_project')}}
    </x-slot>
    <h1 class="mb-4">{{__('messages.New_project')}}</h1>
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{__('messages.Title')}}</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('messages.Description')}}</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{__('messages.New_project')}}</button>
    </form>
</x-layout>
