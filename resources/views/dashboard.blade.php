@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 dashboardt">Dashboard</h1>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm bg-primary text-white rounded-lg">
                <div class="card-body text-center">
                    <i class="fas fa-tasks fa-3x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Nombre de tâches personnelles</h5>
                    <p class="card-text display-4 font-weight-bold">{{ $personalTasksCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm bg-success text-white rounded-lg">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Nombre de tâches d'équipe</h5>
                    <p class="card-text display-4 font-weight-bold">{{ $teamTasksCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm bg-warning text-white rounded-lg">
                <div class="card-body text-center">
                    <i class="fas fa-hourglass-half fa-3x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Tâches personnelles en attente</h5>
                    <p class="card-text display-4 font-weight-bold">{{ $pendingPersonalTasksCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm bg-danger text-white rounded-lg">
                <div class="card-body text-center">
                    <i class="fas fa-hourglass-end fa-3x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Tâches d'équipe en attente</h5>
                    <p class="card-text display-4 font-weight-bold">{{ $pendingTeamTasksCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection