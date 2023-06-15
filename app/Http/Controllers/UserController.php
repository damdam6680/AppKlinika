<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Dentist;

class UserController extends Controller
{
    public function index()
    {
       // $this->authorize('create-delete-user');
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
    public function createDentist(Request $request)
    {


    // Pobierz dane z żądania
        $data = $request->only(['name', 'email', 'password']);

        // Utwórz nowy obiekt użytkownika na podstawie danych
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role = 'dentist';

        // Zapisz użytkownika w bazie danych
        $user->save();

        $patient = Dentist::create([
            'user_id' => $user->id,
            // Dodaj inne pola pacjenta
        ]);

        // Zapisz dentystę w bazie danych


        // Zwróć odpowiedź JSON z potwierdzeniem utworzenia użytkownika
         return response()->json(['message' => 'User was created'], 201);


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
        $user = Auth::user();
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
    public function destroy($id)
    {
        $this->authorize('create-delete-user');

        $user = User::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            // Użytkownik jest już usunięty (soft delete), więc wykonaj permanentne usunięcie
            $user->forceDelete();
        } else {
            // Wykonaj soft delete
            $user->delete();
        }

        return response()->json(['message' => 'User was deleted']);
    }

    public function getUserInfo()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        return response()->json(['user' => $user]);
    }
}
