<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $dateFrom = Carbon::now()->toDateString();
        $dateTo = Carbon::now()->toDateString();

        $appointments = DB::table('appointments as app')
            ->join('users as usr', 'usr.id', '=', 'app.created_by_id')
            ->select('app.*', 'usr.name as created_by')
            ->get();

        return view('pages.appointment.appointment', compact('appointments', 'dateFrom', 'dateTo'));
    }

    public function filteredAppointments(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $dateFrom = $request->input('dateFrom', null);
        $dateTo = $request->input('dateTo', null);
        $search = $request->input('search', null);

        $appointments = DB::table('appointments as app')
            ->join('users as usr', 'usr.id', '=', 'app.created_by_id')
            ->when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
                return $query->whereBetween('appointment_date', [$dateFrom, $dateTo]);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('client_name', 'like', '%' . $search . '%');
            })
            ->select('app.*', 'usr.name as created_by')
            ->paginate(5);


        return view('pages.appointment.appointment', compact('appointments', 'dateFrom', 'dateTo', 'search'));
    }
}
