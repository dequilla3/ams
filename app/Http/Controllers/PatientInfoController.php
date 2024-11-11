<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientInfoController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('pages.patient.patient-info');
    }
}
