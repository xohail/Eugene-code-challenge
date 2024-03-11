<?php

namespace App\Http\Controllers;

use App\Models\Clinics;
use App\Models\Doctor;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
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
        //        dd($doctors);

        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(StoreDoctorRequest $request)
    {
        $validatedData = $request->validated();
        $doctor = Doctor::create(['name' => $validatedData['name']]);
        $clinic = Clinics::create(['name' => $validatedData['clinic_name'], 'address' => $validatedData['clinic_address']]);
        $specialty = Specialty::create(['name' => $validatedData['specialty']]);

        $doctor->clinics()->attach($clinic->id, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $doctor->specialty()->attach($specialty->id, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        $doctor->load('clinics', 'specialty');
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
