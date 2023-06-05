<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Http\Requests\StoreAppointmentsRequest;
use App\Http\Requests\UpdateAppointmentsRequest;
class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('create-delete-user');
        $perPage = 10; // liczba rekordów na stronę
        $patients = Appointments::paginate($perPage);

        $response = [
            'data' => $patients->items(),
            'links' => [
                'first_page_url' => $patients->url(1),
                'last_page_url' => $patients->url($patients->lastPage()),
                'prev_page_url' => $patients->previousPageUrl(),
                'next_page_url' => $patients->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $patients->currentPage(),
                'from' => $patients->firstItem(),
                'to' => $patients->lastItem(),
                'per_page' => $patients->perPage(),
                'total' => $patients->total(),
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
    public function store(StoreAppointmentsRequest $request)
    {


        $appointment = Appointments::create($request->all());
        return response()->json($appointment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Appointments::findOrFail($id);

        return response()->json($patient);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointments $appointments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentsRequest $request,$id)
    {
        $patients = Appointments::findOrFail($id);
        $patients -> update($request->all());

        $patients->save();

        return response()->json($patients);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $appointments)
    {
        //
    }
}
