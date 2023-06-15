<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$this->authorize('create-delete-user');
        $perPage = 10; // liczba rekordów na stronę
        $appointments = Appointment::with('patient:id,first_name,last_name', 'treatment:id,treatment_name','dentist:id,last_name')
        ->paginate($perPage);

        $response = [
            'data' => $appointments->items(),
            'links' => [
                'first_page_url' => $appointments->url(1),
                'last_page_url' => $appointments->url($appointments->lastPage()),
                'prev_page_url' => $appointments->previousPageUrl(),
                'next_page_url' => $appointments->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $appointments->currentPage(),
                'from' => $appointments->firstItem(),
                'to' => $appointments->lastItem(),
                'per_page' => $appointments->perPage(),
                'total' => $appointments->total(),
            ],
        ];
        return response()->json($response);
    }
    public function calendar()
    {
        $user = Auth::user();
        $dentist = Dentist::where('user_id', $user->id)->firstOrFail();
        $appointments = Appointment::with('patient:id,first_name,last_name', 'treatment:id,treatment_name')
        ->where('dentist_id', $dentist->id)
        ->get();

    return response()->json($appointments);
    }
    public function AppotemtsForDoctor(){
            $user = Auth::user();
            $dentist = Dentist::where('user_id', $user->id)->firstOrFail();

            $perPage = 10; // liczba rekordów na stronę
            $appointments = Appointment::with('patient:id,first_name,last_name', 'treatment:id,treatment_name')
                ->where('dentist_id', $dentist->id)
                ->paginate($perPage);

            $response = [
                'data' => $appointments->items(),
                'links' => [
                    'first_page_url' => $appointments->url(1),
                    'last_page_url' => $appointments->url($appointments->lastPage()),
                    'prev_page_url' => $appointments->previousPageUrl(),
                    'next_page_url' => $appointments->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $appointments->currentPage(),
                    'from' => $appointments->firstItem(),
                    'to' => $appointments->lastItem(),
                    'per_page' => $appointments->perPage(),
                    'total' => $appointments->total(),
                ],
            ];

            return response()->json($response);

    }

    public function AppotemtsForPacient(){
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->firstOrFail();

        $appointments = Appointment::with('treatment:id,treatment_name')
            ->where('patient_id', $patient->id)
            ->limit(3)
            ->get();

        return $appointments;

    }

    public function AppotemtsForPacientList(){
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->firstOrFail();

        $perPage = 10; // liczba rekordów na stronę
        $appointments = Appointment::with('patient:id,first_name,last_name', 'treatment:id,treatment_name', 'dentist:id,first_name,last_name')
            ->where('patient_id', $patient->id)
            ->paginate($perPage);

        $response = [
            'data' => $appointments->items(),
            'links' => [
                'first_page_url' => $appointments->url(1),
                'last_page_url' => $appointments->url($appointments->lastPage()),
                'prev_page_url' => $appointments->previousPageUrl(),
                'next_page_url' => $appointments->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $appointments->currentPage(),
                'from' => $appointments->firstItem(),
                'to' => $appointments->lastItem(),
                'per_page' => $appointments->perPage(),
                'total' => $appointments->total(),
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
    public function store(StoreAppointmentRequest $request)
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->firstOrFail();

        $visitDate = Carbon::createFromFormat('Y-m-d', $request->input('visit_date'))->format('Y-m-d');
        $visitTime = Carbon::createFromFormat('H:i', $request->input('visit_time'))->format('H:i:s');
        $visitEndTime = Carbon::createFromFormat('H:i', $request->input('visit_end'))->format('H:i:s');


        // Sprawdzenie, czy podane czasy nie zachodzą na siebie
        if ($this->isTimeCollision($visitDate, $visitTime, $visitEndTime)) {
            return response()->json(['message' => 'Collision detected. Please choose a different time.'], 422);
        }

        // Tworzenie nowego zapisu
        $appointment = new Appointment($request->all());
        $appointment->visit_date = $visitDate;
        $appointment->visit_time = $visitTime;
        $appointment->visit_end = $visitEndTime;
        $appointment->patient_id = $patient->id;

        $appointment->save();

        return response()->json($appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Appointment::findOrFail($id);
        return response()->json($patient);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpdateAppointmentRequest $request, $id)
    {
        $user = Appointment::findOrFail($id);

        // Zaktualizuj dane użytkownika
        $user->isAccepted = $request->input('isAccepted');

        $user->save();

        // Zwróć odpowiedź JSON z zaktualizowanymi danymi użytkownika
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

    // Aktualizuj wartość pola isAccepted na podstawie żądania
        $appointment->isAccepted = $request->input('isAccepted');

        $appointment->save();

    // Zwróć odpowiedź JSON z zaktualizowanymi danymi wizyty
        return response()->json($appointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointments)
    {
        //
    }

    /**
     * Check if the visit time and end time collide with existing appointments.
     *
     * @param  string  $visitDate
     * @param  string  $visitTime
     * @param  string  $visitEndTime
     * @return bool
     */
    private function isTimeCollision($visitDate, $visitTime, $visitEndTime)
    {
        $visitDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $visitDate . ' ' . $visitTime);
        $visitEndDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $visitDate . ' ' . $visitEndTime);

        $appointments = Appointment::where('visit_date', $visitDateTime->format('Y-m-d'))
            ->where(function ($query) use ($visitDateTime, $visitEndDateTime) {
                $query->where(function ($subQuery) use ($visitDateTime, $visitEndDateTime) {
                    $subQuery->where('visit_time', '>=', $visitDateTime)
                        ->where('visit_time', '<', $visitEndDateTime);
                })->orWhere(function ($subQuery) use ($visitDateTime, $visitEndDateTime) {
                    $subQuery->where('visit_time', '<=', $visitDateTime)
                        ->where('visit_end', '>', $visitDateTime);
                });
            })->exists();

        return $appointments;
    }


}
