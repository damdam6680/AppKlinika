<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Http\Requests\StorePatientsRequest;
use App\Http\Requests\UpdatePatientsRequest;
use App\Models\User;

use App\Http\Requests\PatientsResource;
use App\Http\Resources\PatientsResource as ResourcesPatientsResource;
use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $this->authorize('create-delete-user');
        $perPage = 10; // liczba rekordów na stronę
        $patients = Patients::with('user')->paginate($perPage);

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
    public function store(StorePatientsRequest $request)
    {

        return new ResourcesPatientsResource(Patients::create($request -> all()));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        $user = Auth::user();

        $patient = Patients::with('user')->findOrFail($user->id);

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
    public function update(UpdatePatientsRequest $request)
    {
        $user = Auth::user();
        $patients = Patients::with('user')->findOrFail($user->id);
        $patients -> update($request->all());

        $patients->save();

        return response()->json($patients);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->authorize('create-delete-user');
        $patients = Patients::findOrFail($id);
        $patients->delete();
        return response()->json($patients);

    }
}



