<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plantation;
use App\Models\QualityPrediction;
use App\Models\User;
use App\Models\Variety;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFarmers = User::where('role', 'farmer')->count();
        $totalPlantations = Plantation::count();
        $totalVarieties = Variety::count();
        $totalPredictions = QualityPrediction::count();

        $recentHistories = QualityPrediction::with(['plantation.user', 'variety'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalFarmers',
            'totalPlantations',
            'totalVarieties',
            'totalPredictions',
            'recentHistories'
        ));
    }
}