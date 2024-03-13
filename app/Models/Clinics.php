<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinics extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'clinics'; // because the metadata was not getting clear no matter what

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function specialties(): HasMany
    {
        return $this->hasMany(Specialty::class);
    }
}
