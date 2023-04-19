@extends('layouts.app')
@section('title', 'Create Event')

@section('content')
<div class="container">
    <h1>Create Event</h1>
    <div class="mb-4">
        <a href="/games"><i class="fas fa-long-arrow-alt-left"></i> Back to games</a>
    </div>

    @if (Session::has('event_created'))
        <div class="alert alert-primary">
            <span>The following event is created: </span><span>minute: {{session('minute')}}, type: {{session('type')}}, player: {{session('player')}}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('events.store') }}">
        @csrf

        <div class="form-group row mb-3">
            <label for="minute" class="col-sm-2 col-form-label">Minute*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('minute') is-invalid @enderror" id="minute" name="minute" value="{{old('minute')}}">
                @error('minute')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="type" class="col-sm-2 col-form-label py-0">Type*</label>
            <div class="col-sm-10">
                @foreach (\App\Models\Event::$types as $type)
                    <div class="form-check">
                        <input class="form-check-input @error('type') is-invalid @enderror" type="radio"
                            name="type" id="{{ $type }}" value="{{ $type }}" @checked(old('type') == $type) >
                        <label class="form-check-label" for="{{ $type }}">
                            <span>{{ $type }}</span>
                        </label>
                        @if ($loop->last)
                            @error('style')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
        </div>
    </form>
</div>
@endsection
