<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
        $visitDate = $request->input('visit_date');
        $visitTime = $request->input('visit_time');
        $visitEndTime = $request->input('visit_end');

        // Sprawdzenie, czy podane czasy nie zachodzą na siebie
        if ($this->isTimeCollision($visitDate, $visitTime, $visitEndTime)) {
            return response()->json(['error' => 'Collision detected. Please choose a different time.'], 422);
        }

        // Tworzenie nowego zapisu
        $appointment = new Appointments($request->all());
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

    /**
 * Check if the visit time and end time collide with existing appointments.
 *
 * @param  string  $visitTime
 * @param  string  $visitEndTime
 * @return bool
 */
private function isTimeCollision($visitDate, $visitTime, $visitEndTime)
{
    $visitDateTime = Carbon::createFromFormat('d/m/Y H:i', $visitDate . ' ' . $visitTime);
    $visitEndDateTime = Carbon::createFromFormat('d/m/Y H:i', $visitDate . ' ' . $visitEndTime);

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
}
