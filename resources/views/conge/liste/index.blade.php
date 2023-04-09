@extends('layouts.app')
@section('title', 'personne')
@section('content')

    @isset($message)
        <div class="alert alert-danger text-danger alert-dismissible" role="alert">
            {{ $message }}
            <button class="btn-close" aria-label="close" data-bs-dismiss="alert"></button>
        </div>
    @endisset



    <div class="table-responsive p-3">
        <table class="table pt-3 pb-3">
            <thead style="background-color: #6699cc">
                <tr class="text-white">
                    <th scope="col">#</th>
                    <th scope="col">النسب</th>
                    <th scope="col">الإسم</th>
                    <th scope="col">Date debut</th>
                    <th scope="col">Date fin</th>
                    <th scope="col">Lieu Residence</th>
                    <th scope="col">Lieu conge</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Année</th>
                    <th scope="col">Période</th>
                    <th scope="col">Valeur</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($congers as $conger)
                    <tr>
                        <th scope="row">{{ $conger->id }}</th>
                        <td>{{ $conger->personne->nomAr }}</td>
                        <td>{{ $conger->personne->prenomAr }}</td>
                        <td>{{ $conger->dateDebut }}</td>
                        <td>{{ $conger->dateFin }}</td>
                        <td>{{ $conger->lieuResidence }}</td>
                        <td>{{ $conger->lieuConge }}</td>
                        <td>{{ $conger->tele }}</td>
                        <td>{{ $conger->annee }}</td>
                        <td>{{ $conger->periode }}</td>
                        <td>{{ $conger->valeur }}</td>
                        <td>
                            <a class="text-dark" href="{{ route('pdfGen', $conger->id) }}"><i
                                    class="fa-regular fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

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
