<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['area_id', 'slug', 'title'];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
