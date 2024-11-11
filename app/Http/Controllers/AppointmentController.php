<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    private function loadAppointments($dateFrom, $dateTo, $search): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return DB::table('appointments as app')
            ->join('users as usr', 'usr.id', '=', 'app.created_by_id')
            ->when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
                return $query->whereBetween('appointment_date', [$dateFrom, $dateTo]);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('client_name', 'like', '%' . $search . '%');
            })
            ->select('app.*', 'usr.name as created_by')
            ->paginate(5);
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $dateFrom = Carbon::now()->toDateString();
        $dateTo = Carbon::now()->toDateString();
        $search = "";

        $appointments = $this->loadAppointments($dateFrom, $dateTo, $search);

        return view('pages.appointment.appointment', compact('appointments', 'dateFrom', 'dateTo', 'search'));
    }

    public function filteredAppointments(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $dateFrom = $request->input('dateFrom', null);
        $dateTo = $request->input('dateTo', null);
        $search = $request->input('search', null);

        $appointments = $this->loadAppointments($dateFrom, $dateTo, $search);

        return view('pages.appointment.appointment', compact('appointments', 'dateFrom', 'dateTo', 'search'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'client_name' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);

        // Create a new appointment using the validated data
        Appointment::create([
            'client_name' => $validatedData['client_name'],
            'appointment_date' => $validatedData['appointment_date'],
            'appointment_time' => $validatedData['appointment_time'],
            'created_by_id' => Auth::id(), // Assuming the authenticated user is creating the appointment
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('appointments')->with('success', 'Appointment created successfully!');
    }


}
