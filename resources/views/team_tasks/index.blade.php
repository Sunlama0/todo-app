@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-light text-dark d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Tâches de l'équipe</h3>
                <a href="{{ route('team-tasks.create') }}" class="btn btn-primary">Créer une tâche d'équipe</a>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('team-tasks.index') }}" class="mb-3">
                    <div class="form-group">
                        <label for="team_id">Sélectionner une équipe :</label>
                        <select name="team_id" id="team_id" class="form-control" onchange="this.form.submit()">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $team->id == $selectedTeamId ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                @if ($teamTasks->isEmpty())
                    <p class="text-muted">Aucune tâche disponible pour l'équipe sélectionnée.</p>
                @else
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Date d'échéance</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teamTasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($task->status == 'en cours')
                                            <span class="badge badge-secondary">En cours</span>
                                        @elseif ($task->status == 'terminée')
                                            <span class="badge badge-success">Terminée</span>
                                        @elseif ($task->status == 'expirée')
                                            <span class="badge badge-danger">Expirée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            <a href="{{ route('team-tasks.edit', $task->id) }}" class="btn btn-warning btn-sm mr-2 mb-2">Modifier</a>
                                            <form action="{{ route('team-tasks.destroy', $task->id) }}" method="POST" class="mr-2 mb-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                            </form>
                                            @if ($task->status != 'terminée')
                                                <form action="{{ route('team-tasks.update', $task->id) }}" method="POST" class="mr-2 mb-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="title" value="{{ $task->title }}">
                                                    <input type="hidden" name="description" value="{{ $task->description }}">
                                                    <input type="hidden" name="due_date" value="{{ $task->due_date }}">
                                                    <input type="hidden" name="team_id" value="{{ $task->team_id }}">
                                                    <input type="hidden" name="status" value="terminée">
                                                    <button type="submit" class="btn btn-info btn-sm">Marquer comme terminée</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
