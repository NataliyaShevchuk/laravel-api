@extends('layouts.app')

@section('content')
<main class="container-fluid">
    <div class="container-fluid text-start">
        <button class="btn btn-warning m-3" class="text-decoration-none text-white">
            <a href="{{route('dashboard')}}">
                Back to Dashboard
            </a>
        </button>
    </div>
    @dump($project)
    <div class="row mx-5">
                <div class="col-6 my-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $project['cover_img']) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$project->name}}</h5>
                            <p class="card-text">{{$project->description}}</p>
                            <p class="card-text">{{ $project->type ? $project->type->name : '' }}</p>
                            <a href="{{$project->github_link}}" class="btn btn-primary">Github Link</a>
                            <button class="btn btn-info"> <a href="{{route('admin.projects.edit', $project->id)}}" class="text-decoration-none">Modifica</a></button>
                            {{-- <button class="btn btn-danger"> <a href="{{route('projects.destroy')}}" class="text-decoration-none"><i class="fas fa-trash"></i></a></button> --}}
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" id="form-delete">
                                @csrf()
                                @method('delete')

                                <button class="btn btn-danger my-3">
                                    <i class="fas fa-trash w-3">Elimina</i>
                                </button>
                            </form>
                            </div>

                            <script>
                                  // recuperiamo l'elemnto html del form
                                const form = document.getElementById("form-delete");
                                  // aggiungiamo un event listener sul submit
                                form.addEventListener("submit", function(e) {
                                      // blocchiamo il comportamento di default
                                    e.preventDefault();
                                      // chiediamo all'utente di confermare
                                    const conferma = confirm("Sei sicuro di voler cancellare questo prodotto? Proprio sicuro sicuro?");
                                      // Se conferma, inviamo il form
                                    if (conferma === true) {
                                        form.submit();
                                    }
                                })

                            </script>


                        </div>
                    </div>
                </div>
    </div>
</main>
@endsection