<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\User;

use App\Http\Requests\PatientResource;
use App\Http\Resources\PatientResource as ResourcesPatientResource;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //s $this->authorize('create-delete-user');
        $perPage = 10; // liczba rekordów na stronę
        $patients = Patient::with('user')->paginate($perPage);

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
    public function store(StorePatientRequest $request)
    {

        return new ResourcesPatientResource(Patient::create($request -> all()));
    }

    /**
     * Display the specified resource.
     */
    public function showMe()
    {

        $user = Auth::user();

        $patient = Patient::with('user')->findOrFail($user->id);

        return response()->json($patient);
    }
    public function show($id)
    {

        $patients = Patient::findOrFail($id);

        return response()->json($patients);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patients)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, $id)
    {
        $dentists = Patient::findOrFail($id);
        $dentists -> update($request->all());

        $dentists->save();

        return response()->json($dentists);
    }

    public function updateMe(UpdatePatientRequest $request)
    {
        $user = Auth::user();
        $patients = Patient::with('user')->findOrFail($user->id);
        $patients -> update($request->all());

        $patients->save();

        return response()->json($patients);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('create-delete-user');

        $user = Patient::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            // Użytkownik jest już usunięty (soft delete), więc wykonaj permanentne usunięcie
            $user->forceDelete();
        } else {
            // Wykonaj soft delete
            $user->delete();
        }

        return response()->json(['message' => 'Patient was deleted']);
    }
}

