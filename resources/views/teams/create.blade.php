@extends('layouts.app')
@section('title', 'Create Team')

@section('content')
<div class="container">
    <h1>Create Team</h1>
    <div class="mb-4">
        <a href="/teams"><i class="fas fa-long-arrow-alt-left"></i> Back to teams</a>
    </div>

    @if (Session::has('team_created'))
        <div class="alert alert-primary">
            <span>The following team is created: </span><span>Name: {{session('name')}}, Shortname: {{session('shortname')}}</span>
        </div>
    @endif

    {{-- TODO: action, method --}}
    <form method="POST" action="{{ route('teams.store') }}" enctype="multipart/form-data">
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
            <label for="shortname" class="col-sm-2 col-form-label">Shortname*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('shortname') is-invalid @enderror" id="shortname" name="shortname" value="{{old('shortname')}}">
                @error('shortname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="image" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="preview" class="col-12 d-none">
                            <p>Cover preview:</p>
                            <img id="preview_image" src="#" alt="Preview" width="300px">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
    <script>
        const coverImageInput = document.querySelector('input#image');
        const coverPreviewContainer = document.querySelector('#preview');
        const coverPreviewImage = document.querySelector('img#preview_image');
        coverImageInput.onchange = event => {
            const [file] = coverImageInput.files;
            if (file) {
                coverPreviewContainer.classList.remove('d-none');
                coverPreviewImage.src = URL.createObjectURL(file);
            } else {
                coverPreviewContainer.classList.add('d-none');
            }
        }
    </script>
@endsection
