<x-layout>
    <x-slot name="title">
        {{__('messages.Create_task')}}
    </x-slot>
    <h1 class="mb-4">{{__('messages.Create_task')}}</h1>
    <form method="POST" action="{{ route('projects.tasks.store', $project) }}">
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
            <label class="form-label">{{__('messages.Due')}}</label>
            <input type="date" name="deadline" value="{{ old('deadline') }}" class="form-control @error('deadline') is-invalid @enderror">
            @error('deadline')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('messages.Status')}}</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="">{{__('messages.Select_status')}}</option>
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" @if(old('status') == $status->id) selected @endif>{{ $status->status }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('messages.Responsible_person')}}</label>
            <select name="responsible_person" class="form-select @error('responsible_person') is-invalid @enderror">
                <option value="">{{__('messages.Select_participant')}}</option>
                @foreach($participants as $participant)
                <option value="{{ $participant->id }}" @if(old('responsible_person') == $participant->id) selected @endif>{{ $participant->username }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">{{__('messages.Create_task')}}</button>
    </form>
</x-layout>
