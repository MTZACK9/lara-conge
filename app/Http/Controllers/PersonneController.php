<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Carbon\Carbon;
use App\Models\Grade;
use App\Models\Personne;
use App\Models\Service;
use Illuminate\Http\Request;
use Faker\Provider\ar_EG\Person;

class PersonneController extends Controller
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
        return view(
            'conge.personnelle.index',
            [
                "personnes" => Personne::all(),
                "year" => Carbon::now()->year,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('conge.personnelle.create', [
            'grades' => Grade::all(),
            'divisions' => Division::all(),
            'services' => Service::all(),
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
        //dd($request);
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'nomAr' => 'required',
            'prenomAr' => 'required',
        ]);
        Personne::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'nomAr' => $request->nomAr,
            'prenomAr' => $request->prenomAr,
            'anneeD' => Carbon::now()->year,
            'grade_id' => $request->grade,
            'division_id' => $request->division,
            'service_id' => $request->service,

        ]);
        return redirect(route('personne.index'));
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

        return view('conge.personnelle.edit', [
            'personne' => Personne::where('id', $id)->first(),
            'grades' => Grade::all(),
            'divisions' => Division::all(),
            'services' => Service::all(),
        ]);
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
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'nomAr' => 'required',
            'prenomAr' => 'required',
        ]);

        Personne::where('id', $id)->update($request->except([
            '_token', '_method'
        ]));
        return redirect(route('personne.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Personne::where('id', $id)->delete();
        return redirect(route('personne.index'));
    }
}
