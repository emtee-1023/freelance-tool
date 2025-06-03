<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class DashboardService
{
    public function getAnalytics($range = 'month')
    {
        // Use Carbon to calculate date range
        $start = match ($range) {
            'today' => Carbon::now()->startOfDay(),
            'year' => Carbon::now()->startOfYear(),
            default => Carbon::now()->startOfMonth(),
        };

        $cacheKey = "dashboard_analytics_$range";

        return Cache::remember($cacheKey, 60, function () use ($start) {
            return [
                'total_tasks' => Task::where('created_at', '>=', $start)->count(),
                'completed_tasks' => Task::where('status', 'completed')->where('created_at', '>=', $start)->count(),
                'pending_tasks' => Task::whereIn('status', ['pending assignment', 'in progress'])->where('created_at', '>=', $start)->count(),
                'total_earnings' => Task::where('status', 'completed')->where('created_at', '>=', $start)->sum('amount'),
            ];
        });
    }
}
