<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Clinics;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Support\Carbon;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['specialty', 'clinics'])
            ->withCount('tests')
            ->orderBy('updated_at', 'desc')
            ->paginate(100);

        return view('doctors.index', compact('doctors'));
    }

    public function store(StoreDoctorRequest $request)
    {
        $validatedData = $request->validated();

        $doctor = Doctor::create(['name' => $validatedData['name']]);
        $clinic = Clinics::create(['name' => $validatedData['clinic_name'], 'house' => $validatedData['clinic_house'], 'street' => $validatedData['clinic_street'], 'suburb' => $validatedData['clinic_suburb'], 'postcode' => $validatedData['clinic_postcode'], 'state' => $validatedData['clinic_state'], 'geocode' => $validatedData['clinic_geocode']]);

        $doctor->clinics()->attach($clinic->id, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $doctor->specialty()->attach($validatedData['specialty'], ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    public function show(Doctor $doctor)
    {
        $doctor->load('clinics', 'specialty', 'tests');
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $specialties = Specialty::all();
        $clinics = Clinics::all();

        $doctor->load('specialty', 'clinics');

        return view('doctors.edit', compact('doctor', 'specialties', 'clinics'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());
        $doctor->specialty()->sync($request->input('specialties', []));
        $doctor->clinics()->sync($request->input('clinics', []));

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }
}
