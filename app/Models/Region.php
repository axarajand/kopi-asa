<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Region extends Model
{
    use HasFactory;
    protected $table = 'tb_regions';
    protected $fillable = ['name', 'province', 'description'];

    public function varieties(): BelongsToMany
    {
        return $this->belongsToMany(Variety::class, 'tb_region_variety');
    }
}