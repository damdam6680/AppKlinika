<?php

namespace App\Http\Controllers;

use App\Models\Dentists;
use App\Http\Requests\StoreDentistsRequest;
use App\Http\Requests\UpdateDentistsRequest;
use App\Http\Controllers\ResourcesPatientsResource;
class DentistsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  Dentists::paginate(10);
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
    public function store($id)
    {
      //  return new ResourcesPatientsResource(Dentists::create($request -> all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dentists = Dentists::findOrFail($id);

        return response()->json($dentists);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dentists $dentists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDentistsRequest $request, $id)
    {
        $dentists = Dentists::findOrFail($id);
        $dentists -> update($request->all());

        $dentists->save();

        return response()->json($dentists);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dentists = Dentists::findOrFail($id);
        $dentists->delete();
        return response()->json($dentists);
    }
}
