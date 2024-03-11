<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestName extends Model
{
    use HasFactory;
    protected $table = 'test_names'; // because the metadata was not getting clear no matter what

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
