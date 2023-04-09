@extends('layouts.app')
@section('title', 'Utilisateurs')
@section('content')
    <a href="{{ route('utilisateur.create') }}" class="text-dark d-flex justify-content-end p-3" alt="Ajouter"
        title="Ajouter Personne"><i class="fa-solid fa-user-plus"></i></i></a>
    <div class="table-responsive p-3">
        <table class="table pt-3 pb-3">
            <thead style="background-color: #6699cc">
                <tr class="text-white">
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mot de Passe</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Date Naissance</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->email }}</td>
                        <td>*******</td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->sexe }}</td>
                        <td>{{ $user->dateNaiss }}</td>
                        <td>{{ $user->telephone }}</td>
                        <td class="d-flex justify-content-around">
                            <a href="{{ route('utilisateur.edit', $user->id) }}" id="edit" class="text-dark"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                            <a href="#" class="text-dark delete" data-id="{{ $user->id }}" data-bs-toggle="modal"
                                data-bs-target="#Suppression"><i class="fa-solid fa-user-minus"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="Suppression" tabindex="-1" aria-labelledby="Supprimer" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Supprimer">Confirmer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="
                    {{ route('utilisateur.destroy', 'id') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            Vous Voulez Vraiment Supprimer ? <br>
                            <input hidden id="id" name="id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.delete', function() {
            let id = $(this).attr('data-id');
            $('#id').val(id);
        });
    </script>
@endpush
