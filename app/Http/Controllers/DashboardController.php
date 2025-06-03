<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use App\Models\Task;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, DashboardService $dashboardService)
    {
        $range = $request->get('range', 'month'); // e.g. 'today', 'month', 'year'
        $analytics = $dashboardService->getAnalytics($range);
        $tasks = Task::orderBy('updated_at', 'desc')->take(10)->get();

        return view('dashboard', compact('analytics', 'range', 'tasks'));
    }
}
