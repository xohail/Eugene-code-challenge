<?php

namespace App\Services;

use App\Models\Clinics;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DuplicateMergeService
{
    public function mergeClinics(array $duplicateIds, $replacementId)
    {
        // Merge logic for clinics
        DB::table('clinics_doctor')->whereIn('clinics_id', $duplicateIds)->update(['clinics_id' => $replacementId]);
        Clinics::whereIn('id', $duplicateIds)->delete();
    }

    public function mergeDoctors(array $duplicateIds, $replacementId)
    {
        // Merge logic for doctors
        DB::table('clinics_doctor')->whereIn('doctor_id', $duplicateIds)->update(['doctor_id' => $replacementId]);
        Doctor::whereIn('id', $duplicateIds)->delete();
    }
}
