<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Tambahkan ini

class Variety extends Model
{
    use HasFactory;
    protected $table = 'tb_varieties';
    protected $fillable = ['name', 'species', 'notes'];

    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'tb_region_variety');
    }
}