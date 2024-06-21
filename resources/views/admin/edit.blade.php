@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier une équipe') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.teams.update', $team) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nom de l'équipe</label>
                            <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="users">Membres</label>
                            <select name="users[]" class="form-control" multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ in_array($user->id, $team->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
