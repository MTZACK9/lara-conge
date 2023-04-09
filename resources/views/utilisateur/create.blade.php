@extends('layouts.app')
@section('title', 'Ajouter Utilisateur')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/utilisateur.css') }}">
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="c_form" action="{{ route('utilisateur.store') }}" method="POST" class="row g-3 w-75 m-auto">
        @csrf
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom">
        </div>

        <div class="col-md-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" id="prenom">
        </div>

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="Email" name="email" class="form-control" id="email" placeholder="jhon@example.com">
        </div>

        <div class="col-12">
            <label for="pass" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="pass">
        </div>

        <div class="col-12">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" name="telephone" class="form-control" id="phone" placeholder="060101010101">
        </div>

        <div class="col-md-6">
            <label for="datenaiss" class="form-label">Date de naissance</label>
            <input type="date" name="datenaiss" class="form-control" id="datenaiss">
        </div>

        <div class="col-md-6">
            <label for="sexe" class="form-label">Sexe</label>
            <select id="sexe" name="sexe" class="form-select">
                <option selected>Homme</option>
                <option>Femme</option>
            </select>
        </div>


        <div class="col-12 text-end">
            <a class="btn btn-primary" href="{{ route('utilisateur.index') }}">Annuler</a>
            <button type="submit" class="btn btn-primary">Ajouter</button>

        </div>
    </form>
@endsection
