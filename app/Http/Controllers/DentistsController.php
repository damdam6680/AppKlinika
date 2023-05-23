<?php

namespace App\Http\Controllers;

use App\Models\Dentists;
use App\Http\Requests\StoreDentistsRequest;
use App\Http\Requests\UpdateDentistsRequest;

class DentistsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Dentists::all();
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
    public function store(StoreDentistsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dentists $dentists)
    {
        return $dentists;
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
    public function update(UpdateDentistsRequest $request, Dentists $dentists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dentists $dentists)
    {
        //
    }
}
