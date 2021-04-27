<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function clienteDashboard()
    {
        return Inertia::render('Cliente/Dashboard');
    }

    public function peluqueriaDashboard()
    {
        return Inertia::render('Peluqueria/Dashboard');
    }

    public function adminDashboard()
    {
        return Inertia::render('Admin/Dashboard');
    }
}
