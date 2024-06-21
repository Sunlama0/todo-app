@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la tâche</h1>
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('team-tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="due_date">Date d'échéance</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Statut</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="en cours" {{ $task->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="terminée" {{ $task->status == 'terminée' ? 'selected' : '' }}>Terminée</option>
                        <option value="expirée" {{ $task->status == 'expirée' ? 'selected' : '' }}>Expirée</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="team_id">Équipe</label>
                    <select name="team_id" id="team_id" class="form-control" required>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" {{ $task->team_id == $team->id ? 'selected' : '' }}>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection
