<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {
    }

    public function index()
    {
        $stats = $this->dashboardService->getStatistics();

        $chartData = $this->dashboardService->getChartData();

        return view('dashboard.index', compact(
            'stats',
            'chartData'
        ));
    }
}