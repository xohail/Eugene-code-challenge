<?php

namespace App\Http\Controllers\Duplicates;

use App\Http\Controllers\Controller;
use App\Models\Clinics;
use App\Services\DuplicateMergeService;
use Illuminate\Http\Request;

class ClinicsMergeController extends Controller
{
    protected DuplicateMergeService $mergeService;

    public function __construct(DuplicateMergeService $mergeService)
    {
        $this->mergeService = $mergeService;
    }

    public function index()
    {
        $potentialDuplicates = Clinics::selectRaw('GROUP_CONCAT(id) AS duplicate_ids, name, house, COUNT(*) AS duplicates_count')
            ->whereNotNull('name')
            ->whereNotNull('house')
            ->groupBy('name', 'house')
            ->havingRaw('COUNT(*) > 1')
            ->get()
        ;

        return view('clinics.duplicates.potential_duplicates', compact('potentialDuplicates'));
    }

    public function clinicsMerge(Request $request)
    {
        $duplicateIds = explode(',', $request->input('duplicate_ids'));
        $replacementId = array_shift($duplicateIds);
        $this->mergeService->mergeClinics($duplicateIds, $replacementId);

        return redirect('/duplicates/clinics');
    }
}
