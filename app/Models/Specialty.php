<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'specialty'; // because the metadata was not getting clear no matter what

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
