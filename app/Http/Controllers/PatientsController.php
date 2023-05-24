<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Http\Requests\StorePatientsRequest;
use App\Http\Requests\UpdatePatientsRequest;

use App\Http\Requests\PatientsResource;
use App\Http\Resources\PatientsResource as ResourcesPatientsResource;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Patients::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientsRequest $request)
    {
        return new ResourcesPatientsResource(Patients::create($request -> all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patients::findOrFail($id);

        return response()->json($patient);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patients $patients)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientsRequest $request,$id)
    {
        $patients = Patients::findOrFail($id);
        $patients -> update($request->all());

        $patients->save();

        return response()->json($patients);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patients $patients)
    {
        //
    }
}
