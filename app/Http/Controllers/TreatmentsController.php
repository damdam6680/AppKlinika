<?php

namespace App\Http\Controllers;

use App\Models\Treatments;
use App\Http\Requests\StoreTreatmentsRequest;
use App\Http\Requests\UpdateTreatmentsRequest;

class TreatmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 10; // liczba rekordów na stronę
        $treatments = Treatments::paginate($perPage);

        $response = [
            'data' => $treatments->items(),
            'links' => [
                'first_page_url' => $treatments->url(1),
                'last_page_url' => $treatments->url($treatments->lastPage()),
                'prev_page_url' => $treatments->previousPageUrl(),
                'next_page_url' => $treatments->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $treatments->currentPage(),
                'from' => $treatments->firstItem(),
                'to' => $treatments->lastItem(),
                'per_page' => $treatments->perPage(),
                'total' => $treatments->total(),
            ],
        ];
        return response()->json($response);
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
    public function store(StoreTreatmentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patients = Treatments::findOrFail($id);

        return response()->json($patients);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatments $treatments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTreatmentsRequest $request, $id)
    {
        $dentists = Treatments::findOrFail($id);
        $dentists -> update($request->all());

        $dentists->save();

        return response()->json($dentists);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatments $treatments)
    {
        //
    }
}
