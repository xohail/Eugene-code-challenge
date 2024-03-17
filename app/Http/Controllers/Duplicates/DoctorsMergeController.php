<?php

namespace App\Http\Controllers\Duplicates;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Services\DuplicateMergeService;
use Illuminate\Http\Request;

class DoctorsMergeController extends Controller
{
    protected DuplicateMergeService $mergeService;

    public function __construct(DuplicateMergeService $mergeService)
    {
        $this->mergeService = $mergeService;
    }

    public function index()
    {
        $potentialDuplicates = Doctor::selectRaw('GROUP_CONCAT(id) AS duplicate_ids, name, COUNT(*) AS duplicates_count')
            ->whereNotNull('name')
            ->groupBy('name')
            ->havingRaw('COUNT(*) > 1')
            ->get()
        ;

        return view('doctors.duplicates.potential_duplicates', compact('potentialDuplicates'));
    }

    public function doctorsMerge(Request $request)
    {
        $duplicateIds = explode(',', $request->input('duplicate_ids'));
        $replacementId = array_shift($duplicateIds);

        $this->mergeService->mergeDoctors($duplicateIds, $replacementId);

        return redirect('/duplicates/doctors');
    }
}
