@extends('layouts.app')

@section('content')
<main class="m-5">
    {{-- validazione dati --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        I dati inseriti non sono validi:

        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="row">
        <div class="col-12 mt-5 justify-content-center">

        {{-- INIZIO FORM --}}
            <form action=" {{route('admin.projects.store') }} " class="row g-3" method="POST" enctype="multipart/form-data">
                @csrf

        {{-- INPUT NOME --}}
                <div class="col-md-6">
                    <label for="text" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @elseif(old('name')) is-valid @enderror" id="" name="name" value="{{ $errors->has('name') ? '' : old('name') }}">

                    {{-- Messaggio  --}}
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @elseif(old('name'))
                    <div class="valid-feedback">
                        Nice work dude!
                    </div>
                    @enderror

                </div>

        {{-- INPUT IMMAGINE --}}
                <div class="col-md-6">
                    <label for="" class="form-label">Cover Image</label>
                    <input type="file"  class="form-control @error('cover_img') is-invalid @elseif('cover_img') is-valid @enderror" name="cover_img" >
                    {{-- Messaggio  --}}
                    @error('cover_img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @elseif(old('cover_img'))
                    <div class="valid-feedback">
                        Nice work dude!
                    </div>
                    @enderror
                </div>

        {{-- INPUT GITHUB LINK --}}
                <div class="col-12">
                    <label for="" class="form-label">Github Link</label>
                    <input type="url" class="form-control @error('github_link') is-invalid @elseif(old('github_link')) is-valid @enderror" name="github_link" value="{{ $errors->has('github_link') ? '' : old('github_link') }}" id="" placeholder="github_link" name="github_link" value="{{ $errors->has('github_link') ? '' : old('github_link') }}">

                    {{-- Messaggio  --}}
                    @error('github_link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @elseif(old('github_link'))
                    <div class="valid-feedback">
                        Nice work dude!
                    </div>
                    @enderror
                </div>
                
                {{-- Type name --}}
                <label class="form-label">Type: </label>
                <select name="type_id" class="form-select mb-4">
                    @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>


        {{-- INPUT DESCRIZIONE --}}
                <div class="col-12">
                    <label for="" class="form-label">Description</label>
                    <textarea type="text" cols="30" rows="5" class="form-control  @error('description') is-invalid @enderror" placeholder="Description" name="description">{{ old('description') }}</textarea>

                    {{-- Messaggio  --}}
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @elseif(old('description'))
                    <div class="valid-feedback">
                        Nice work dude!
                    </div>
                    @enderror

                </div>
        {{-- PULSANTI: SUBMIT E BACK TO DASHBOARD --}}
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <button class="btn btn-warning m-3">
                        <a href="{{route('dashboard')}}" class="text-decoration-none text-white">
                            Back to Dashboard
                        </a>
                    </button>
                </div>


            </form>
        </div>
    </div>
    </div>
    </div>

</main>
@endsection
