<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinics;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\countOf;

class ClinicController extends Controller
{
    public function index()
    {
        $potentialDuplicates = Clinics::selectRaw('GROUP_CONCAT(id) AS duplicate_ids, name, house, COUNT(*) AS duplicates_count')
            ->whereNotNull('name')
            ->whereNotNull('house')
            ->groupBy('name', 'house')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        return view('clinics.potential_duplicates', compact('potentialDuplicates'));
    }

    public function clinics_merge()
    {
        $duplicateIds = request('duplicate_ids');
        $ids = explode(',', $duplicateIds);
        $replacement = $ids[0];
        array_shift($ids);

        DB::table('clinics_doctor')
            ->whereIn('clinics_id', $ids)
            ->update(['clinics_id' => $replacement]);

        Clinics::whereIn('id', $ids)->delete();

        return $this->index();
    }
}
