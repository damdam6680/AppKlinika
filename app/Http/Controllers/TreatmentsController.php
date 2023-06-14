<?php

namespace App\Http\Controllers;

use App\Models\Treatments;
use App\Http\Requests\StoreTreatmentsRequest;
use App\Http\Requests\UpdateTreatmentsRequest;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $validatedData = $request->validated();

        // Tworzenie nowego leczenia na podstawie przekazanych danych
        $treatment = new Treatments($request->all());
        $treatment->treatment_name = $validatedData['treatment_name'];
        $treatment->description = $validatedData['description'];
        $treatment->waiting_time = $validatedData['waiting_time'];
        $treatment->price = $validatedData['price'];
        // Dodatkowe przypisanie innych pól, jeśli istnieją

        // Zapisanie leczenia
        $treatment->save();

        return response()->json($treatment);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $treatment = Treatments::findOrFail($id);

        return response()->json($treatment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatments $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTreatmentsRequest $request, $id)
    {
        $treatment = Treatments::findOrFail($id);
        $treatment->update($request->all());

        $treatment->save();

        return response()->json($treatment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatments $treatment)
    {
        //
    }
}
