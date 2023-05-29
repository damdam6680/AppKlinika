<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('create-delete-user');
        return  User::paginate(5);
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
        $patients = User::findOrFail($id);
        $patients->delete();
        return response()->json($patients);

    }
}
