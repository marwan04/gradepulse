<?php

namespace App\Http\Controllers;

class InstructorDashboardController extends Controller
{
    public function index()
    {
        return view('instructor.dashboard');
    }
}
