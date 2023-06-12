<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Appointments;
use App\Http\Requests\StoreAppointmentsRequest;
use App\Http\Requests\UpdateAppointmentsRequest;
use App\Models\Dentists;
use App\Models\Patients;
use App\Models\Treatments;
use Illuminate\Support\Facades\Auth;
class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$this->authorize('create-delete-user');


        $perPage = 10; // liczba rekordów na stronę
        $appointments = Appointments::where('dentist_id', $patient->id)->paginate($perPage);

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
        $dentist = Dentists::where('user_id', $user->id)->firstOrFail();
        $appointments = Appointments::with('patient:id,first_name,last_name', 'treatment:id,treatment_name')
        ->where('dentist_id', $dentist->id)
        ->get();

    return response()->json($appointments);
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
        $user = Auth::user();
        $patient = Patients::where('user_id', $user->id)->firstOrFail();

        $visitDate = Carbon::createFromFormat('Y-m-d', $request->input('visit_date'))->format('Y-m-d');
        $visitTime = Carbon::createFromFormat('H:i', $request->input('visit_time'))->format('H:i:s');
        $visitEndTime = Carbon::createFromFormat('H:i', $request->input('visit_end'))->format('H:i:s');

        if (!$this->isVisitTimeBeforeEnd($visitTime, $visitEndTime)) {
            return response()->json(['error' => 'Visit time cannot be later than visit end time.'], 422);
        }

        // Sprawdzenie, czy podane czasy nie zachodzą na siebie
        if ($this->isTimeCollision($visitDate, $visitTime, $visitEndTime)) {
            return response()->json(['error' => 'Collision detected. Please choose a different time.'], 422);
        }

        // Tworzenie nowego zapisu
        $appointment = new Appointments($request->all());
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
    public function update(UpdateAppointmentsRequest $request, $id)
    {
        $patients = Appointments::findOrFail($id);
        $patients->update($request->all());
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

        $appointments = Appointments::where('visit_date', $visitDateTime->format('Y-m-d'))
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
       /**
     * Check if visit_time is before visit_end.
     *
     * @param  string  $visitTime
     * @param  string  $visitEndTime
     * @return bool
     */
    private function isVisitTimeBeforeEnd($visitTime, $visitEndTime)
    {
        return $visitTime < $visitEndTime;
    }


}
