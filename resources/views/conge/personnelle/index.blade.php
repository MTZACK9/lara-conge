@extends('layouts.app')
@section('title', 'personne')
@section('content')

    <a href="{{ route('personne.create') }}" class="text-dark d-flex justify-content-end p-3" alt="Ajouter"
        title="Ajouter Personne"><i class="fa-solid fa-user-plus"></i></a>
    <div class="table-responsive p-3">
        <table class="table pt-3 pb-3">
            <thead style="background-color: #6699cc">
                <tr class="text-white">
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">الإسم</th>
                    <th scope="col">النسب</th>
                    <th scope="col">{{ $year - 3 }}</th>
                    <th scope="col">{{ $year - 2 }}</th>
                    <th scope="col">{{ $year - 1 }}</th>
                    <th scope="col">{{ $year }}</th>
                    <th scope="col">periode</th>
                    <th scope="col">Reprise total</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Division</th>
                    <th scope="col">Service</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personnes as $personne)
                    <tr>
                        <th scope="row">{{ $personne->id }}</th>
                        <td>{{ $personne->nom }}</td>
                        <td>{{ $personne->prenom }}</td>
                        <td>{{ $personne->prenomAr }}</td>
                        <td>{{ $personne->nomAr }}</td>

                        @php
                            $reste1 = 0;
                            $reste2 = 0;
                            $reste3 = 0;
                            $reste4 = 0;
                            //year one
                            $check = DB::table('personnes')
                                ->where('id', '=', $personne->id)
                                ->where('anneeD', '<=', $year - 3)
                                ->first();
                            
                            if (is_null($check)) {
                                echo '<td>-</td>';
                            } else {
                                $countConge = DB::table('congers')
                                    ->where('personne_id', '=', $personne->id)
                                    ->where('annee', '=', $year - 3)
                                    ->count(); //for counting conges
                            
                                $CongePer = DB::table('congers')
                                    ->where('personne_id', '=', $personne->id)
                                    ->where('annee', '=', $year - 3)
                                    ->get(); //get all conges from one per this year
                            
                                if ($countConge > 0) {
                                    $p = 0;
                                    $i = 0;
                                    while ($i < $countConge) {
                                        if ($CongePer[$i]->annee == $year - 3) {
                                            $p += $CongePer[$i]->periode;
                                        }
                            
                                        $i++;
                                    }
                            
                                    echo '<td>' . (22 - $p) . '</td>';
                                    $reste1 = 22 - $p;
                                } else {
                                    echo '<td>22</td>';
                                    $reste1 = 22;
                                }
                            }
                            
                            //year two
                            $check2 = DB::table('personnes')
                                ->where('id', '=', $personne->id)
                                ->where('anneeD', '<=', $year - 2)
                                ->first();
                            if (is_null($check2)) {
                                echo '<td>-</td>';
                            } else {
                                $countConge = DB::table('congers')
                                    ->where('personne_id', '=', $personne->id)
                                    ->where('annee', '=', $year - 2)
                                    ->count(); //for counting conges
                            
                                $CongePer = DB::table('congers')
                                    ->where('personne_id', '=', $personne->id)
                                    ->where('annee', '=', $year - 2)
                                    ->get(); //get all conges from one per this year
                            
                                if ($countConge > 0) {
                                    $p = 0;
                                    $i = 0;
                                    while ($i < $countConge) {
                                        if ($CongePer[$i]->annee == $year - 2) {
                                            $p += $CongePer[$i]->periode;
                                        }
                            
                                        $i++;
                                    }
                            
                                    echo '<td>' . (22 - $p) . '</td>';
                                    $reste2 = 22 - $p;
                                } else {
                                    echo '<td>22</td>';
                                    $reste2 = 22;
                                }
                            }
                            
                            //year three
                            $check3 = DB::table('personnes')
                                ->where('id', '=', $personne->id)
                                ->where('anneeD', '<=', $year - 1)
                                ->first();
                            if (is_null($check3)) {
                                echo '<td>-</td>';
                            } else {
                                $countConge = DB::table('congers')
                                    ->where('personne_id', '=', $personne->id)
                                    ->where('annee', '=', $year - 1)
                                    ->count(); //for counting conges
                            
                                $CongePer = DB::table('congers')
                                    ->where('personne_id', '=', $personne->id)
                                    ->where('annee', '=', $year - 1)
                                    ->get(); //get all conges from one per this year
                            
                                if ($countConge > 0) {
                                    $p = 0;
                                    $i = 0;
                                    while ($i < $countConge) {
                                        if ($CongePer[$i]->annee == $year - 1) {
                                            $p += $CongePer[$i]->periode;
                                        }
                            
                                        $i++;
                                    }
                            
                                    echo '<td>' . (22 - $p) . '</td>';
                                    $reste3 = 22 - $p;
                                } else {
                                    echo '<td>22</td>';
                                    $reste3 = 22;
                                }
                            }
                            
                            //year four
                            $check4 = DB::table('personnes')
                                ->where('id', '=', $personne->id)
                                ->where('anneeD', '<=', $year)
                                ->first();
                            if (is_null($check4)) {
                                echo '<td>-</td>';
                            } else {
                                $countConge = DB::table('congers')
                                    ->where('personne_id', '=', $personne->id)
                                    ->where('annee', '=', $year)
                                    ->count(); //for counting conges
                            
                                $CongePer = DB::table('congers')
                                    ->where('personne_id', '=', $personne->id)
                                    ->where('annee', '=', $year)
                                    ->get(); //get all conges from one per this year
                            
                                if ($countConge > 0) {
                                    $p = 0;
                                    $i = 0;
                                    while ($i < $countConge) {
                                        if ($CongePer[$i]->annee == $year) {
                                            $p += $CongePer[$i]->periode;
                                        }
                            
                                        $i++;
                                    }
                                    echo '<td>' . (22 - $p) . '</td>';
                                    $reste4 = 22 - $p;
                                } else {
                                    echo '<td>22</td>';
                                    $reste4 = 22;
                                }
                            }
                        @endphp

                        {{-- periodes --}}
                        @php
                            //for this year
                            $countConge = DB::table('congers')
                                ->where('personne_id', '=', $personne->id)
                                ->where('annee', '>=', $year - 3)
                                ->count(); //for counting conges
                            
                            $CongePer = DB::table('congers')
                                ->where('personne_id', '=', $personne->id)
                                ->where('annee', '>=', $year - 3)
                                ->get(); //get all conges from one per this year
                            
                            if ($countConge > 0) {
                                $p = 0;
                                $i = 0;
                                while ($i < $countConge) {
                                    if ($CongePer[$i]->annee >= $year - 3) {
                                        $p += $CongePer[$i]->periode;
                                    }
                            
                                    $i++;
                                }
                                echo '<td>' . $p . '</td>';
                            } else {
                                echo '<td>0</td>';
                            }
                        @endphp


                        <td>{{ $reste1 + $reste2 + $reste3 + $reste4 }}</td>
                        <td>{{ $personne->grade->grade }}</td>
                        <td>{{ $personne->division->division }}</td>
                        <td>{{ $personne->service->service }}</td>



                        <td>
                            <ul class="nav navbar-nav ms-auto w-100 justify-content-end align-items-center">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark" href="#"
                                        id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false"> <i class="fa-solid fa-bars"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                                        <li><a href="{{ route('personne.edit', $personne->id) }}" id="edit"
                                                class="text-dark dropdown-item"><i
                                                    class="fa-regular fa-pen-to-square"></i>&nbsp;Modifier</a></li>

                                        <li><a href="#" class="text-dark  delete dropdown-item"
                                                data-id="{{ $personne->id }}" data-bs-toggle="modal"
                                                data-bs-target="#Suppression"><i class="fa-solid fa-user-minus"></i>&nbsp;
                                                Supprimer
                                            </a>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('conger.create', $personne->id) }}"><i
                                                    class="fa-solid fa-person-walking-luggage"></i>&nbsp;Conge</a></li>
                                    </ul>
                                </li>
                            </ul>
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
                    {{ route('personne.destroy', 'id') }}" method="POST">
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
