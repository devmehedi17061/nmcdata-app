<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class HomeController extends Controller
{
    /**
     * Display the frontend homepage
     */
    public function index()
    {
        $employees = Employee::where('status', 'active')->take(8)->get();
        return view('welcome', compact('employees'));
    }

    /**
     * Display the about page
     */
    public function about()
    {
        $employees = Employee::where('status', 'active')->get();
        return view('frontend.about', compact('employees'));
    }
}
