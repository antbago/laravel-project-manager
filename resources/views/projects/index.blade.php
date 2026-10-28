<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <style>
        :root { color-scheme: light; font-family: system-ui, sans-serif; }
        body { max-width: 780px; margin: 3rem auto; padding: 0 1rem; color: #172033; background: #f6f7fb; }
        h1 { margin-bottom: .25rem; }
        .muted { color: #687083; }
        .panel, .project { background: white; border: 1px solid #dfe3eb; border-radius: 12px; padding: 1rem 1.2rem; margin-top: 1rem; }
        label { display: block; font-weight: 600; margin: .8rem 0 .3rem; }
        input, textarea { box-sizing: border-box; width: 100%; padding: .7rem; border: 1px solid #bfc7d5; border-radius: 7px; font: inherit; }
        button { margin-top: .8rem; padding: .65rem .9rem; border: 0; border-radius: 7px; color: white; background: #2459d3; font: inherit; cursor: pointer; }
        button:disabled { background: #7b8495; cursor: default; }
        .status { background: #e9f8ed; padding: .8rem; border-radius: 7px; }
        .error { color: #b42318; }
        .project-title { display: flex; align-items: baseline; justify-content: space-between; gap: 1rem; }
        .completed { color: #167447; font-weight: 600; }
    </style>
</head>
<body>
    <h1>Project Manager</h1>
    <p class="muted">A minimal Laravel project for tracking work.</p>

    @if (session('status'))
        <p class="status" role="status">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <div class="panel error" role="alert">
            <p>Please correct the following:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="panel">
        <h2>Create a project</h2>
        <form method="POST" action="{{ route('projects.store') }}">
            @csrf
            <label for="name">Project name</label>
            <input id="name" name="name" value="{{ old('name') }}" maxlength="120" required>

            <label for="description">Description (optional)</label>
            <textarea id="description" name="description" rows="3" maxlength="2000">{{ old('description') }}</textarea>

            <button type="submit">Add project</button>
        </form>
    </section>

    <section>
        <h2>Projects ({{ $projects->count() }})</h2>

        @forelse ($projects as $project)
            <article class="project">
                <div class="project-title">
                    <h3>{{ $project->name }}</h3>
                    @if ($project->is_completed)
                        <span class="completed">Completed</span>
                    @else
                        <span class="muted">In progress</span>
                    @endif
                </div>

                @if ($project->description)
                    <p>{{ $project->description }}</p>
                @endif

                @unless ($project->is_completed)
                    <form method="POST" action="{{ route('projects.complete', $project) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Mark as completed</button>
                    </form>
                @endunless
            </article>
        @empty
            <p class="muted">No projects yet. Create one above.</p>
        @endforelse
    </section>
</body>
</html>
