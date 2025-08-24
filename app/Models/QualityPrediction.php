<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualityPrediction extends Model
{
    use HasFactory;
    protected $table = 'tb_quality_predictions';
    protected $fillable = [
        'plantation_id', 'variety_id', 'predicted_by_user_id',
        'processing_method', 'moisture', 'color',
        'predicted_ph_range', 'predicted_ph_desc',
        'predicted_quality_score', 'predicted_quality_desc',
    ];

    public function plantation(): BelongsTo
    {
        return $this->belongsTo(Plantation::class);
    }

    public function variety(): BelongsTo
    {
        return $this->belongsTo(Variety::class);
    }

    public function predictor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'predicted_by_user_id');
    }
}