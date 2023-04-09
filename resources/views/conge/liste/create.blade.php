@extends('layouts.app')
@section('title', 'Ajouter Personne')
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
    <form id="c_form" action="{{ route('conger.store') }}" method="POST" class="row g-3 w-75 m-auto" dir="rtl">
        @csrf
        <div>
            <input type="text" hidden name="id" value="{{ $personne->id }}">
        </div>


        <div class="col-md-6">
            <label for="nomAr" class="form-label" dir="rtl">الاسم العائلــي</label>
            <input type="text" name="nomAr" class="form-control" id="nomAr" dir="rtl"
                value="{{ $personne->nomAr }}" readonly>
        </div>

        <div class="col-md-6">
            <label for="prenomAr" class="form-label" dir="rtl">الاسم الشخصي</label>
            <input type="text" name="prenomAr" class="form-control" id="prenomAr" dir="rtl"
                value="{{ $personne->prenomAr }}" readonly>
        </div>
        <div class="col-md-12">
            <label for="lieuResidence" class="form-label" dir="rtl">مكان الإقــــامـــــــة</label>
            <input type="text" name="lieuResidence" class="form-control" id="lieuResidence" dir="rtl">
        </div>

        <div class="col-md-6">
            <label for="grade" class="form-label" dir="rtl"> الــــــــــــــــــــــــدرجة</label>
            <input type="text" name="grade" class="form-control" id="grade" dir="rtl"
                value="{{ $personne->grade->gradeAr }}" readonly>
        </div>

        <div class="col-md-6">
            <label for="dateDebut" class="form-label" dir="rtl"> تــــاريــــخ مــغــــادرة الوكــــالــــة</label>
            <input type="date" name="dateDebut" min="{{ Carbon\Carbon::now()->toDateString() }}"
                max="{{ Carbon\Carbon::now()->year }}-12-31" class="form-control" id="dateDebut" dir="rtl"
                onchange="datea()">
        </div>

        <div class="col-md-6">
            <label for="periode" class="form-label" dir="rtl">مــــــدة الــعــطــلــة</label>
            <input type="number" min="0" max="{{ Carbon\Carbon::now()->year }}-12-31" name="periode"
                class="form-control" id="periode" dir="rtl" onchange="datea()">
        </div>

        <div class="col-md-6">
            <label for="dateFin" class="form-label" dir="rtl">
                تــــاريــــخ إســتــئــنــــاف الــعــمــــل
            </label>
            <input type="date" name="dateFin" class="form-control" id="dateFin" dir="rtl" readonly>
        </div>

        <div class="col-md-12">
            <label for="tele" class="form-label" dir="rtl">الــــــهــــــاتـــــــــــــــف </label>
            <input type="text" name="tele" class="form-control" id="tele" dir="rtl">
        </div>

        <div class="col-md-12">
            <label for="lieuConge" class="form-label" dir="rtl"> الــــمــكــــان الذي ســتــقــضي فــيــه
                الــعــطــلــة </label>
            <input type="text" name="lieuConge" class="form-control" id="lieuConge" dir="rtl">
        </div>


        <div class="col-12" dir="ltr">
            <button type="submit" class="btn btn-primary">Ajouter</button>&nbsp;
            <a class="btn btn-primary" href="{{ route('personne.index') }}">Annuler</a>

        </div>
    </form>
@endsection
@push('scripts')
    <script>
        function datea() {
            let num = document.getElementById('periode');
            let dat = document.getElementById('dateDebut');
            let datefin = document.getElementById('dateFin');

            let datte = new Date(dat.value);
            let result = datte.setDate(datte.getDate() + Number(num.value));
            let res;
            res = datte.getFullYear() + '-';
            if (datte.getMonth() + 1 < 10) {
                res += '0' + (datte.getMonth() + 1) + '-';
            } else {
                res += (datte.getMonth() + 1) + '-';
            }
            if (datte.getDate() < 10) {
                res += '0' + datte.getDate();

            } else {
                res += datte.getDate();
            }
            datefin.value = res;
        }
    </script>
@endpush
