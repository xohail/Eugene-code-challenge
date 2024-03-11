<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'tests'; // because the metadata was not getting clear no matter what

    public function referringDoctor()
    {
        return $this->belongsTo(Doctor::class, 'referring_doctor_id');
    }

    public function testName()
    {
        return $this->belongsTo(TestName::class, 'test_name_id');
    }

    public function referringDoctorClinic()
    {
        return $this->belongsTo(Clinics::class, 'referring_doctor_clinic_id');
    }
}
