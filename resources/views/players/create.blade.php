@extends('layouts.app')
@section('title', 'Add Player')

@section('content')
<div class="container">
    <h1>Add Player</h1>
    <div class="mb-4">
        <a href="/teams"><i class="fas fa-long-arrow-alt-left"></i> Back to teams</a>
    </div>

    @if (Session::has('player_created'))
        <div class="alert alert-primary">
            <span>The following player is added: </span><span>Name: {{session('name')}}, Jersey number: {{session('number')}}, Birth of Date: {{session('birthdate')}}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('players.store') }}">
        @csrf

        <div class="form-group row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="number" class="col-sm-2 col-form-label">Jersey number*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{old('number')}}">
                @error('number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="birthdate" class="col-sm-2 col-form-label">Birth of Date*</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" value="{{old('birthdate')}}">
                @error('birthdate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
        </div>

    </form>
</div>
@endsection
