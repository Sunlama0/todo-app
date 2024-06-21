@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Tâches') }}</div>

                <div class="card-body">
                    <a href="{{ url('/tasks/create') }}" class="btn btn-primary mb-3">Ajouter une tâche</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Date d'échéance</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personalTasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</td>
                                <td>
                                    @if (\Carbon\Carbon::now()->isAfter($task->due_date))
                                        <span class="badge badge-danger">Expirée</span>
                                    @elseif ($task->is_completed)
                                        <span class="badge badge-success">Terminée</span>
                                    @else
                                        <span class="badge badge-secondary">En cours</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url('/tasks/'.$task->id.'/edit') }}" class="btn btn-warning mr-2 flex-grow-1">Modifier</a>
                                        <form action="{{ url('/tasks/'.$task->id) }}" method="POST" class="mr-2 flex-grow-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">Supprimer</button>
                                        </form>
                                        <form action="{{ url('/tasks/'.$task->id) }}" method="POST" class="flex-grow-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="title" value="{{ $task->title }}">
                                            <input type="hidden" name="description" value="{{ $task->description }}">
                                            <input type="hidden" name="due_date" value="{{ $task->due_date }}">
                                            <input type="hidden" name="is_completed" value="{{ $task->is_completed ? 0 : 1 }}">
                                            <button type="submit" class="btn btn-info w-100">
                                                {{ $task->is_completed ? 'Marquer comme en cours' : 'Marquer comme terminée' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
