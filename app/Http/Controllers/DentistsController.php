<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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

       // $this->authorize('create-delete-user');


        $perPage = 10; // liczba rekordów na stronę
        $dentists = Dentists::with('user')->paginate($perPage);

        $response = [
            'data' => $dentists->items(),
            'links' => [
                'first_page_url' => $dentists->url(1),
                'last_page_url' => $dentists->url($dentists->lastPage()),
                'prev_page_url' => $dentists->previousPageUrl(),
                'next_page_url' => $dentists->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $dentists->currentPage(),
                'from' => $dentists->firstItem(),
                'to' => $dentists->lastItem(),
                'per_page' => $dentists->perPage(),
                'total' => $dentists->total(),
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


    public function updateDentist(UpdateDentistsRequest $request)
    {
        $user = Auth::user();
        $dentist = Dentists::where('user_id', $user->id)->firstOrFail();

        $dentist->update($request->all());
        $dentist->save();

        return response()->json($dentist);
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
