@extends('layouts.app')
@section('title', 'Modifier Utilisateur')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/utilisateur.css') }}">
@endsection
@section('content')
    <form id="c_form" action="{{ route('utilisateur.update', $user->id) }}" method="POST" class="row g-3 w-75 m-auto">
        @csrf
        @method('PATCH')
        <div class="col-md-6" style="display: none">
            <input type="text" name="id" class="form-control" value="{{ $user->id }}">
        </div>

        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom" value="{{ $user->nom }}">
        </div>

        <div class="col-md-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" id="prenom" value="{{ $user->prenom }}">
        </div>

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="Email" name="email" class="form-control" id="email" value="{{ $user->email }}">
        </div>

        {{-- <div class="col-12">
            <label for="pass" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="pass" value="{{ $user->password }}">
        </div> --}}

        <div class="col-12">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" name="telephone" class="form-control" id="phone" value="{{ $user->telephone }}">
        </div>

        <div class="col-md-6">
            <label for="datenaiss" class="form-label">Date de naissance</label>
            <input type="date" name="datenaiss" class="form-control" id="datenaiss" value="{{ $user->dateNaiss }}">
        </div>

        <div class="col-md-6">
            <label for="sexe" class="form-label">Sexe</label>
            <select id="sexe" name="sexe" class="form-select">
                @if ($user->sexe == 'Homme')
                    <option selected>Homme</option>
                    <option>Femme</option>
                @else
                    <option>Homme</option>
                    <option selected>Femme</option>
                @endif

            </select>
        </div>


        <div class="col-12 text-end">
            <a class="btn btn-primary" href="{{ route('utilisateur.index') }}">Annuler</a>
            <button type="submit" class="btn btn-primary">Modifier</button>

        </div>
    </form>
@endsection
