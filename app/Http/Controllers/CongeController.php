<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Conger;
use App\Models\Pdf;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class CongeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('conge.liste.index', [
            'congers' => Pdf::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('conge.liste.create', [
            'personne' => Personne::findorFail($id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valeur = 1;
        $year = Carbon::now()->year;
        $year2 = $year - 1;
        $year3 = $year - 2;
        $year4 = $year - 3;

        $request->validate([
            'dateDebut' => 'required',
            'dateFin' => 'required',
            'lieuResidence' => 'required',
            'lieuConge' => 'required',
            'tele' => 'required',
            'periode' => 'required',
        ]);

        if (
            DB::table('personnes')
            ->where('id', $request->id)
            ->exists()
        ) {
            //the first year after job
            $check = DB::table('personnes')
                ->where('id', '=', $request->id)
                ->where('anneeD', '<=', $year4)
                ->first();

            if (!is_null($check)) {
                $period = DB::table('congers')
                    ->where('personne_id', $request->id)
                    ->where('annee', $year4)
                    ->sum('periode');

                $valeurAnnee = DB::table('congers')
                    ->where('annee', $year4)
                    ->max('valeur');

                $reste = 22 - $period;
                //dd($reste);
                //-------------------------------------------------------
                if ($reste == 0) {
                    //------------------------------
                    $period = DB::table('congers')
                        ->where('personne_id', $request->id)
                        ->where('annee', $year3)
                        ->sum('periode');
                    //valeur
                    $valeurAnnee = DB::table('congers')
                        ->where('annee', $year3)
                        ->max('valeur');

                    $reste = 22 - $period;
                    if ($reste == 0) {
                        //code the next year again
                        $period = DB::table('congers')
                            ->where('personne_id', $request->id)
                            ->where('annee', $year2)
                            ->sum('periode');
                        $valeurAnnee = DB::table('congers')
                            ->where('annee', $year2)
                            ->max('valeur');
                        $reste = 22 - $period;
                        if ($reste == 0) {
                            //-------------------
                            $period = DB::table('congers')
                                ->where('personne_id', $request->id)
                                ->where('annee', $year)
                                ->sum('periode');
                            $valeurAnnee = DB::table('congers')
                                ->where('annee', $year)
                                ->max('valeur');
                            $reste = 22 - $period;
                            if ($reste == 0) {
                                //--------------------
                            } elseif ($reste <= 22 && $reste > 0) {
                                if ($request->periode <= $reste) {
                                    if ($valeurAnnee >= 1) {
                                        $valeur += $valeurAnnee;
                                    }
                                    //dd($reste);
                                    Conger::create([
                                        'personne_id' => $request->id,
                                        'dateDebut' => $request->dateDebut,
                                        'dateFin' => $request->dateFin,
                                        'lieuResidence' => $request->lieuResidence,
                                        'lieuConge' => $request->lieuConge,
                                        'tele' => $request->tele,
                                        'annee' => $year,
                                        'periode' => $request->periode,
                                        'valeur' => $valeur,
                                    ]);
                                    Pdf::create([
                                        'personne_id' => $request->id,
                                        'nomAr' => $request->nomAr,
                                        'prenomAr' => $request->prenomAr,
                                        'dateDebut' => $request->dateDebut,
                                        'dateFin' => $request->dateFin,
                                        'grade' => $request->grade,
                                        'lieuResidence' => $request->lieuResidence,
                                        'lieuConge' => $request->lieuConge,
                                        'tele' => $request->tele,
                                        'annee' => $year,
                                        'periode' => $request->periode,
                                        'valeur' => $valeur,
                                        'duree' => $reste - $request->periode,
                                    ]);
                                    //dd($reste - $request->periode);

                                    return redirect(route('conger.index'));
                                } else {
                                    //there is no reste 
                                }
                            }
                        } elseif ($reste <= 22 && $reste > 0) {
                            if ($request->periode <= $reste) {
                                if ($valeurAnnee >= 1) {
                                    $valeur += $valeurAnnee;
                                }
                                //dd($reste);
                                Conger::create([
                                    'personne_id' => $request->id,
                                    'dateDebut' => $request->dateDebut,
                                    'dateFin' => $request->dateFin,
                                    'lieuResidence' => $request->lieuResidence,
                                    'lieuConge' => $request->lieuConge,
                                    'tele' => $request->tele,
                                    'annee' => $year2,
                                    'periode' => $request->periode,
                                    'valeur' => $valeur,
                                ]);
                                Pdf::create([
                                    'personne_id' => $request->id,
                                    'nomAr' => $request->nomAr,
                                    'prenomAr' => $request->prenomAr,
                                    'dateDebut' => $request->dateDebut,
                                    'dateFin' => $request->dateFin,
                                    'grade' => $request->grade,
                                    'lieuResidence' => $request->lieuResidence,
                                    'lieuConge' => $request->lieuConge,
                                    'tele' => $request->tele,
                                    'annee' => $year2,
                                    'periode' => $request->periode,
                                    'valeur' => $valeur,
                                    'duree' => $reste - $request->periode,
                                ]);
                                //dd($reste - $request->periode);

                                return redirect(route('conger.index'));
                            } else {
                                //don't forget to code the rest of this with the next year
                            }
                        }
                        //------------------------
                    } elseif ($reste <= 22 && $reste > 0) {
                        if ($request->periode <= $reste) {
                            if ($valeurAnnee >= 1) {
                                $valeur += $valeurAnnee;
                            }
                            //dd($reste);
                            Conger::create([
                                'personne_id' => $request->id,
                                'dateDebut' => $request->dateDebut,
                                'dateFin' => $request->dateFin,
                                'lieuResidence' => $request->lieuResidence,
                                'lieuConge' => $request->lieuConge,
                                'tele' => $request->tele,
                                'annee' => $year3,
                                'periode' => $request->periode,
                                'valeur' => $valeur,
                            ]);
                            Pdf::create([
                                'personne_id' => $request->id,
                                'nomAr' => $request->nomAr,
                                'prenomAr' => $request->prenomAr,
                                'dateDebut' => $request->dateDebut,
                                'dateFin' => $request->dateFin,
                                'grade' => $request->grade,
                                'lieuResidence' => $request->lieuResidence,
                                'lieuConge' => $request->lieuConge,
                                'tele' => $request->tele,
                                'annee' => $year3,
                                'periode' => $request->periode,
                                'valeur' => $valeur,
                                'duree' => $reste - $request->periode,
                            ]);
                            //dd($reste - $request->periode);

                            return redirect(route('conger.index'));
                        } else {
                            //don't forget to code the rest of this with the next year
                        }
                    }
                    //-------------------------------------------------------
                    //-------------------------------------------------------
                } elseif ($reste <= 22 && $reste > 0) {
                    if ($request->periode <= $reste) {
                        if ($valeurAnnee >= 1) {
                            $valeur += $valeurAnnee;
                        }
                        //dd($reste);
                        Conger::create([
                            'personne_id' => $request->id,
                            'dateDebut' => $request->dateDebut,
                            'dateFin' => $request->dateFin,
                            'lieuResidence' => $request->lieuResidence,
                            'lieuConge' => $request->lieuConge,
                            'tele' => $request->tele,
                            'annee' => $year4,
                            'periode' => $request->periode,
                            'valeur' => $valeur,
                        ]);
                        Pdf::create([
                            'personne_id' => $request->id,
                            'nomAr' => $request->nomAr,
                            'prenomAr' => $request->prenomAr,
                            'dateDebut' => $request->dateDebut,
                            'dateFin' => $request->dateFin,
                            'grade' => $request->grade,
                            'lieuResidence' => $request->lieuResidence,
                            'lieuConge' => $request->lieuConge,
                            'tele' => $request->tele,
                            'annee' => $year4,
                            'periode' => $request->periode,
                            'valeur' => $valeur,
                            'duree' => $reste - $request->periode,
                        ]);
                        //dd($reste - $request->periode);

                        return redirect(route('conger.index'));
                    } else {
                        // return view('conge.liste.index', [
                        //     "message" => "Nombres des Jours de Conge est $reste jour",
                        //     "congers" => Pdf::all()
                        // ]);
                        //code the rest of this year plus next year
                    }
                } else {
                    return redirect(route('conger.create', $request->id));
                }
            } else {
                //code the next year if this year not exists
                $check = DB::table('personnes')
                    ->where('id', '=', $request->id)
                    ->where('anneeD', '<=', $year3)
                    ->first();
                if (!is_null($check)) {
                    $period = DB::table('congers')
                        ->where('personne_id', $request->id)
                        ->where('annee', $year3)
                        ->sum('periode');

                    $valeurAnnee = DB::table('congers')
                        ->where('annee', $year3)
                        ->max('valeur');

                    $reste = 22 - $period;
                    if ($reste == 0) {
                        $period = DB::table('congers')
                            ->where('personne_id', $request->id)
                            ->where('annee', $year2)
                            ->sum('periode');
                        $valeurAnnee = DB::table('congers')
                            ->where('annee', $year2)
                            ->max('valeur');
                        $reste = 22 - $period;
                        if ($reste == 0) {
                            //-------------------
                            $period = DB::table('congers')
                                ->where('personne_id', $request->id)
                                ->where('annee', $year)
                                ->sum('periode');
                            $valeurAnnee = DB::table('congers')
                                ->where('annee', $year)
                                ->max('valeur');
                            $reste = 22 - $period;
                            if ($reste == 0) {
                                //--------------------
                            } elseif ($reste <= 22 && $reste > 0) {
                                if ($request->periode <= $reste) {
                                    if ($valeurAnnee >= 1) {
                                        $valeur += $valeurAnnee;
                                    }
                                    //dd($reste);
                                    Conger::create([
                                        'personne_id' => $request->id,
                                        'dateDebut' => $request->dateDebut,
                                        'dateFin' => $request->dateFin,
                                        'lieuResidence' => $request->lieuResidence,
                                        'lieuConge' => $request->lieuConge,
                                        'tele' => $request->tele,
                                        'annee' => $year,
                                        'periode' => $request->periode,
                                        'valeur' => $valeur,
                                    ]);
                                    Pdf::create([
                                        'personne_id' => $request->id,
                                        'nomAr' => $request->nomAr,
                                        'prenomAr' => $request->prenomAr,
                                        'dateDebut' => $request->dateDebut,
                                        'dateFin' => $request->dateFin,
                                        'grade' => $request->grade,
                                        'lieuResidence' => $request->lieuResidence,
                                        'lieuConge' => $request->lieuConge,
                                        'tele' => $request->tele,
                                        'annee' => $year,
                                        'periode' => $request->periode,
                                        'valeur' => $valeur,
                                        'duree' => $reste - $request->periode,
                                    ]);
                                    //dd($reste - $request->periode);

                                    return redirect(route('conger.index'));
                                } else {
                                    //there is no reste 
                                }
                            }
                        } elseif ($reste <= 22 && $reste > 0) {
                            if ($request->periode <= $reste) {
                                if ($valeurAnnee >= 1) {
                                    $valeur += $valeurAnnee;
                                }
                                //dd($reste);
                                Conger::create([
                                    'personne_id' => $request->id,
                                    'dateDebut' => $request->dateDebut,
                                    'dateFin' => $request->dateFin,
                                    'lieuResidence' => $request->lieuResidence,
                                    'lieuConge' => $request->lieuConge,
                                    'tele' => $request->tele,
                                    'annee' => $year2,
                                    'periode' => $request->periode,
                                    'valeur' => $valeur,
                                ]);
                                Pdf::create([
                                    'personne_id' => $request->id,
                                    'nomAr' => $request->nomAr,
                                    'prenomAr' => $request->prenomAr,
                                    'dateDebut' => $request->dateDebut,
                                    'dateFin' => $request->dateFin,
                                    'grade' => $request->grade,
                                    'lieuResidence' => $request->lieuResidence,
                                    'lieuConge' => $request->lieuConge,
                                    'tele' => $request->tele,
                                    'annee' => $year2,
                                    'periode' => $request->periode,
                                    'valeur' => $valeur,
                                    'duree' => $reste - $request->periode,
                                ]);
                                //dd($reste - $request->periode);

                                return redirect(route('conger.index'));
                            } else {
                                //don't forget to code the rest of this with the next year
                            }
                        }
                    } elseif ($reste <= 22 && $reste > 0) {
                        if ($request->periode <= $reste) {
                            if ($valeurAnnee >= 1) {
                                $valeur += $valeurAnnee;
                            }
                            //dd($reste);
                            Conger::create([
                                'personne_id' => $request->id,
                                'dateDebut' => $request->dateDebut,
                                'dateFin' => $request->dateFin,
                                'lieuResidence' => $request->lieuResidence,
                                'lieuConge' => $request->lieuConge,
                                'tele' => $request->tele,
                                'annee' => $year3,
                                'periode' => $request->periode,
                                'valeur' => $valeur,
                            ]);
                            Pdf::create([
                                'personne_id' => $request->id,
                                'nomAr' => $request->nomAr,
                                'prenomAr' => $request->prenomAr,
                                'dateDebut' => $request->dateDebut,
                                'dateFin' => $request->dateFin,
                                'grade' => $request->grade,
                                'lieuResidence' => $request->lieuResidence,
                                'lieuConge' => $request->lieuConge,
                                'tele' => $request->tele,
                                'annee' => $year3,
                                'periode' => $request->periode,
                                'valeur' => $valeur,
                                'duree' => $reste - $request->periode,
                            ]);
                            //dd($reste - $request->periode);

                            return redirect(route('conger.index'));
                        } else {
                            //code the rest of this year plus next year
                        }
                    } else {
                        return redirect(route('conger.create', $request->id));
                    }
                } else {
                    //code the next year if this year not exists
                    $check = DB::table('personnes')
                        ->where('id', '=', $request->id)
                        ->where('anneeD', '<=', $year2)
                        ->first();

                    if (!is_null($check)) {
                        $period = DB::table('congers')
                            ->where('personne_id', $request->id)
                            ->where('annee', $year2)
                            ->sum('periode');
                        $valeurAnnee = DB::table('congers')
                            ->where('annee', $year2)
                            ->max('valeur');
                        $reste = 22 - $period;
                        if ($reste == 0) {
                            //-----------Last Year
                            $period = DB::table('congers')
                                ->where('personne_id', $request->id)
                                ->where('annee', $year)
                                ->sum('periode');
                            $valeurAnnee = DB::table('congers')
                                ->where('annee', $year)
                                ->max('valeur');
                            $reste = 22 - $period;
                            if ($reste == 0) {
                                //--------------------
                            } elseif ($reste <= 22 && $reste > 0) {
                                if ($request->periode <= $reste) {
                                    if ($valeurAnnee >= 1) {
                                        $valeur += $valeurAnnee;
                                    }
                                    //dd($reste);
                                    Conger::create([
                                        'personne_id' => $request->id,
                                        'dateDebut' => $request->dateDebut,
                                        'dateFin' => $request->dateFin,
                                        'lieuResidence' => $request->lieuResidence,
                                        'lieuConge' => $request->lieuConge,
                                        'tele' => $request->tele,
                                        'annee' => $year,
                                        'periode' => $request->periode,
                                        'valeur' => $valeur,
                                    ]);
                                    Pdf::create([
                                        'personne_id' => $request->id,
                                        'nomAr' => $request->nomAr,
                                        'prenomAr' => $request->prenomAr,
                                        'dateDebut' => $request->dateDebut,
                                        'dateFin' => $request->dateFin,
                                        'grade' => $request->grade,
                                        'lieuResidence' => $request->lieuResidence,
                                        'lieuConge' => $request->lieuConge,
                                        'tele' => $request->tele,
                                        'annee' => $year,
                                        'periode' => $request->periode,
                                        'valeur' => $valeur,
                                        'duree' => $reste - $request->periode,
                                    ]);
                                    //dd($reste - $request->periode);

                                    return redirect(route('conger.index'));
                                } else {
                                    //there is no reste 
                                }
                            }
                        } elseif ($reste <= 22 && $reste > 0) {
                            if ($request->periode <= $reste) {
                                if ($valeurAnnee >= 1) {
                                    $valeur += $valeurAnnee;
                                }
                                //dd($reste);
                                Conger::create([
                                    'personne_id' => $request->id,
                                    'dateDebut' => $request->dateDebut,
                                    'dateFin' => $request->dateFin,
                                    'lieuResidence' => $request->lieuResidence,
                                    'lieuConge' => $request->lieuConge,
                                    'tele' => $request->tele,
                                    'annee' => $year2,
                                    'periode' => $request->periode,
                                    'valeur' => $valeur,
                                ]);
                                Pdf::create([
                                    'personne_id' => $request->id,
                                    'nomAr' => $request->nomAr,
                                    'prenomAr' => $request->prenomAr,
                                    'dateDebut' => $request->dateDebut,
                                    'dateFin' => $request->dateFin,
                                    'grade' => $request->grade,
                                    'lieuResidence' => $request->lieuResidence,
                                    'lieuConge' => $request->lieuConge,
                                    'tele' => $request->tele,
                                    'annee' => $year2,
                                    'periode' => $request->periode,
                                    'valeur' => $valeur,
                                    'duree' => $reste - $request->periode,
                                ]);
                                //dd($reste - $request->periode);

                                return redirect(route('conger.index'));
                            } else {
                                //don't forget to code the rest of this with the next year
                            }
                        } else {
                            return redirect(route('conger.create', $request->id));
                        }
                    } else {
                        $check = DB::table('personnes')
                            ->where('id', '=', $request->id)
                            ->where('anneeD', '=', $year)
                            ->first();
                        if (!is_null($check)) {
                            $period = DB::table('congers')
                                ->where('personne_id', $request->id)
                                ->where('annee', $year)
                                ->sum('periode');
                            $valeurAnnee = DB::table('congers')
                                ->where('annee', $year)
                                ->max('valeur');
                            $reste = 22 - $period;
                            if ($reste == 0) {
                                //--------------------
                                return view('conge.liste.index', [
                                    "message" => "Nombres des Jours de Conge est 0 jours",
                                    "congers" => Pdf::all()
                                ]);
                            } elseif ($reste <= 22 && $reste > 0) {
                                if ($request->periode <= $reste) {
                                    if ($valeurAnnee >= 1) {
                                        $valeur += $valeurAnnee;
                                    }
                                    //dd($reste);
                                    Conger::create([
                                        'personne_id' => $request->id,
                                        'dateDebut' => $request->dateDebut,
                                        'dateFin' => $request->dateFin,
                                        'lieuResidence' => $request->lieuResidence,
                                        'lieuConge' => $request->lieuConge,
                                        'tele' => $request->tele,
                                        'annee' => $year,
                                        'periode' => $request->periode,
                                        'valeur' => $valeur,
                                    ]);
                                    Pdf::create([
                                        'personne_id' => $request->id,
                                        'nomAr' => $request->nomAr,
                                        'prenomAr' => $request->prenomAr,
                                        'dateDebut' => $request->dateDebut,
                                        'dateFin' => $request->dateFin,
                                        'grade' => $request->grade,
                                        'lieuResidence' => $request->lieuResidence,
                                        'lieuConge' => $request->lieuConge,
                                        'tele' => $request->tele,
                                        'annee' => $year,
                                        'periode' => $request->periode,
                                        'valeur' => $valeur,
                                        'duree' => $reste - $request->periode,
                                    ]);
                                    //dd($reste - $request->periode);

                                    return redirect(route('conger.index'));
                                } else {
                                    return view('conge.liste.index', [
                                        "message" => "reste : $reste",
                                        "congers" => Pdf::all()
                                    ]);
                                }
                            } else {
                            }
                        } else {
                            return redirect(route('personne.index'));
                        }
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
