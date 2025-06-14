<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">{{ $project->title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">Project manager(s):</h6>
        <p class="card-text">{{ $project->description }}</p>
        
        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">Open Project</a>
    </div>
</div>