@extends('admin.layout.master')

@section('title', 'Login')

@section('main') 

    <h1>Login</h1>
    <hr>
    <form class="row g-3 mt-3" action="{{ route('login') }}" method="POST">
        @csrf

        <div class="row mt-3">
            <div class="col-1">
                <label for="email" class="mt-1">Email</label>
            </div>
            <div class="col-6">
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-1">
                <label for="password" class="mt-1">Lozinka</label>
            </div>
            <div class="col-6">
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <hr>
        <div class="col-auto">
            <a href="/users" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Povratak"><i class="bi bi-arrow-return-left"></i></a>
            <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Spremi"><i class="bi bi-floppy"></i>Login</button>
        </div>
    </form>

@endsection