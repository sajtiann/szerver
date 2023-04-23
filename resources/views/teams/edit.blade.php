@extends('layouts.app')
@section('title', 'Edit team')

@section('content')
<div class="container">
    @can('update', $team)
        <h1>Edit team</h1>
        <div class="mb-4">
            <a href="{{ route('teams.show',$team) }}"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>
        </div>

        <form method="POST" action="{{ route('teams.update',$team) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name*</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $team->name)}}">
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
                    <input type="text" class="form-control @error('shortname') is-invalid @enderror" id="shortname" name="shortname" value="{{old('shortname', $team->shortname)}}">
                    @error('shortname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Settings</label>
                <div class="col-sm-10">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" id="remove_cover_image" name="remove_cover_image" @checked(old('remove_cover_image')) >
                            <label for="remove_cover_image" class="form-check-label">Remove cover image</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-3" id="cover_image_section">
                <label for="cover_image" class="col-sm-2 col-form-label">Cover image</label>
                <div class="col-sm-10">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="file" class="form-control-file @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                            <div id="cover_preview" class="col-12">
                                <p>Cover preview:</p>
                                {{-- TODO: Use attached image --}}
                                <img id="cover_preview_image" src="{{$team->image ? ((Str::contains($team->image, 'https')) ?  $team->image : asset('storage/'.$team->image)) : "https://icon-library.com/images/football-icon/football-icon-3.jpg"}}" alt="Cover preview">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
            </div>
        </form>
    @endcan
</div>
@endsection

@section('scripts')
<script>
    const removeCoverInput = document.querySelector('input#remove_cover_image');
    const coverImageSection = document.querySelector('#cover_image_section');
    const coverImageInput = document.querySelector('input#cover_image');
    const coverPreviewContainer = document.querySelector('#cover_preview');
    const coverPreviewImage = document.querySelector('img#cover_preview_image');
    // Render Blade to JS code:
    // TODO: Use attached image
    const defaultCover = `{{ asset('images/default_post_cover.jpg') }}`;

    removeCoverInput.onchange = event => {
        if (removeCoverInput.checked) {
            coverImageSection.classList.add('d-none');
        } else {
            coverImageSection.classList.remove('d-none');
        }
    }

    coverImageInput.onchange = event => {
        const [file] = coverImageInput.files;
        if (file) {
            coverPreviewImage.src = URL.createObjectURL(file);
        } else {
            coverPreviewImage.src = defaultCover;
        }
    }
</script>
@endsection
