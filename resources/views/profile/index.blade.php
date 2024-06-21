@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Profile Logo Section -->
        <!-- <div class="col-md-4">
            <div class="card">
                <div class="card-header">Profile Logo</div>
                <div class="card-body text-center">
                    <img src="{{ Auth::user()->logo ? asset('public/storage/' . Auth::user()->logo) : asset('public/storage/profile_logos/logo.png') }}" class="img-fluid mb-3" alt="Profile Logo">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="logo" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload new logo</button>
                    </form>
                </div>
            </div>
        </div> -->
        <!-- Account Details Section -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ Auth::user()->username }}">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ Auth::user()->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ Auth::user()->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="organization_name">Organization name</label>
                            <input type="text" name="organization_name" id="organization_name" class="form-control" value="{{ Auth::user()->organization_name }}">
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ Auth::user()->location }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}">
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" name="birthday" id="birthday" class="form-control" value="{{ Auth::user()->birthday }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
