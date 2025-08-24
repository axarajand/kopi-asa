<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plantation extends Model
{
    use HasFactory;

    protected $table = 'tb_plantations';

    protected $fillable = [
        'user_id', 'name',
        'province', 'city', 'district', 'village', 'postal_code', 'address_detail',
        'latitude', 'longitude',
        'avg_temperature', 'avg_humidity', 'yearly_precipitation',
        'altitude', 'slope_gradient', 'slope_aspect',
        'soil_ph', 'soil_texture', 'organic_matter', 'drainage',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}