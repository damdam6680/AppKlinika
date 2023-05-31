<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    public function index()
    {
        $this->authorize('create-delete-user');
        $perPage = 10; // liczba rekordów na stronę
        $users = User::paginate($perPage);

        $response = [
            'data' => $users->items(),
            'links' => [
                'first_page_url' => $users->url(1),
                'last_page_url' => $users->url($users->lastPage()),
                'prev_page_url' => $users->previousPageUrl(),
                'next_page_url' => $users->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $users->currentPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
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
    // public function store(StorePatientsRequest $request)
    // {
    //     return new ResourcesPatientsResource(User::create($request -> all()));
    // }
    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('create-delete-user');
        // Znajdź użytkownika po ID
        $user = User::findOrFail($id);

        // Zaktualizuj dane użytkownika
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->role = $request->input('role');
        $user->save();

        // Zwróć odpowiedź JSON z zaktualizowanymi danymi użytkownika
        return response()->json($user);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = User::findOrFail($id);

        return response()->json($patient);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdatePatientsRequest $request,$id)
    // {
    //     $patients = Patients::findOrFail($id);
    //     $patients -> update($request->all());

    //     $patients->save();

    //     return response()->json($patients);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->authorize('create-delete-user');

        $patients = User::findOrFail($id);
        $patients->delete();
        return response()->json($patients);

    }
}
