<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QualityPrediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PredictionHistoryController extends Controller
{
    public function index()
    {
        $histories = QualityPrediction::with(['plantation.user', 'variety', 'predictor'])->latest()->get();
        return view('admin.prediction.history', compact('histories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plantation_id' => 'required|exists:tb_plantations,id',
            'variety_id' => 'required|exists:tb_varieties,id',
            'processing_method' => 'required|string',
            'moisture' => 'required|numeric',
            'color' => 'required|string',
            'predicted_ph_range' => 'required|string',
            'predicted_ph_desc' => 'required|string',
            'predicted_quality_score' => 'required|numeric',
            'predicted_quality_desc' => 'required|string',
        ]);

        $validated['predicted_by_user_id'] = Auth::id();

        QualityPrediction::create($validated);

        return redirect()->route('admin.analysis.prediction')
                         ->with('success', 'Hasil prediksi berhasil disimpan ke riwayat.');
    }
}