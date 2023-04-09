@extends('layouts.app')
@section('title', 'Modifier Personne')
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
    <form id="c_form" action="{{ route('personne.update', $personne->id) }}" method="POST" class="row g-3 w-75 m-auto">
        @csrf
        @method('PATCH')
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom" value="{{ $personne->nom }}">
        </div>

        <div class="col-md-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" id="prenom" value="{{ $personne->prenom }}">
        </div>

        <div class="col-md-6">
            <label for="nomAr" class="form-label" dir="rtl">الاسم العائلــي</label>
            <input type="text" name="nomAr" class="form-control" id="nomAr" dir="rtl"
                value="{{ $personne->nomAr }}">
        </div>

        <div class="col-md-6">
            <label for="prenomAr" class="form-label" dir="rtl">الاسم الشخصي</label>
            <input type="text" name="prenomAr" class="form-control" id="prenomAr" dir="rtl"
                value="{{ $personne->prenomAr }}">
        </div>



        <div class="col-md-12">
            <label for="grade" class="form-label">Grade</label>
            <select id="grade" name="grade_id" class="form-select">
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label for="division" class="form-label">Division</label>
            <select id="division" name="division_id" class="form-select">
                @foreach ($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->division }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label for="service" class="form-label">Service</label>
            <select id="service" name="service_id" class="form-select">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->service }}</option>
                @endforeach
            </select>
        </div>



        <div class="col-12 text-end">
            <a class="btn btn-primary" href="{{ route('personne.index') }}">Annuler</a>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
@endsection
