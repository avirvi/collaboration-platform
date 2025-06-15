<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">{{ $project->title }}</h5>
        <p class="card-text">{{ $project->description }}</p>
        
        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">{{__('messages.Open_project')}}</a>
    </div>
</div>