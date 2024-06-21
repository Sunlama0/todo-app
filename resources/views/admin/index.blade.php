@extends('layouts.app')

@section('content')
<div class="container admin-page">
    <h1 class="mb-4">Administration</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Créer une équipe</div>
                <div class="card-body">
                    <form action="{{ route('admin.createTeam') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom de l'équipe</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Ajouter un utilisateur à une équipe</div>
                <div class="card-body">
                    <form action="{{ route('admin.addUserToTeam', ['teamId' => 1]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="team">Équipe</label>
                            <select class="form-control" id="team" name="team_id">
                                @foreach ($teams as $team)
                        
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user">Utilisateur</label>
                            <select class="form-control" id="user" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h2>Liste des équipes</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nom de l'équipe</th>
                <th>Membres</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $team)
            <tr>
                <td>{{ $team->name }}</td>
                <td>
                    @foreach ($team->users as $user)
                        {{ $user->name }},
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection