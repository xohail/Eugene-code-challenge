<?php
namespace App\Http\Controllers;

use App\Models\Clinics;
use App\Models\Doctor;
use App\Models\Test;
use App\Models\TestName;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::with(['referringDoctor', 'testName', 'referringDoctorClinic'])->orderBy('updated_at', 'desc')->paginate(100);

        return view('tests.index', compact('tests'));
    }

    public function create()
    {
        $doctors = Doctor::with('clinics')->get();
        $tests = TestName::all();

        return view('tests.create', compact('doctors', 'tests'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'test_name_id' => 'required|exists:test_names,id',
            'description' => '',
            'referring_doctor_id' => [
                function ($attribute, $value, $fail) {
                    // Split the value into doctor_id and clinic_id
                    [$doctorId, $clinicId] = explode('_', $value);

                    // Validate if both doctor_id and clinic_id exist in their respective tables
                    if (!Doctor::find($doctorId) || !Clinics::find($clinicId)) {
                        $fail('The selected referring doctor is invalid.');
                    }
                },
            ],
        ]);
        $referringDoctorId = $validatedData['referring_doctor_id'];
        [$doctorId, $clinicId] = explode('_', $referringDoctorId);
        $validatedData['referring_doctor_id'] = $doctorId;
        $validatedData['referring_doctor_clinic_id'] = $clinicId;

        Test::create($validatedData);

        return redirect()->route('tests.index')->with('success', 'Test created successfully.');
    }
}
