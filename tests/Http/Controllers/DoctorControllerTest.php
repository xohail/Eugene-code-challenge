<?php

namespace Tests\Http\Controllers;

use App\Models\Clinics;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method_returns_view_with_doctors()
    {
        $response = $this->get(route('doctors.index'));
        $response->assertStatus(200);
        $response->assertViewHas('doctors');
    }

    public function test_create_method_returns_view_with_specialties()
    {
        $response = $this->get(route('doctors.create'));
        $response->assertStatus(200);
        $response->assertViewHas('specialties');
    }

    public function test_store_method_creates_doctor_and_redirects_to_index()
    {
        $specialty = Specialty::factory()->create();

        $data = ['name' => 'Test Doctor', 'specialty' => [$specialty->id], 'clinic_name' => 'Test Clinic', 'clinic_house' => '123', 'clinic_street' => 'Test Street', 'clinic_suburb' => 'Test Suburb', 'clinic_postcode' => '12345', 'clinic_state' => 'Test State', 'clinic_geocode' => 'Test Geocode'];

        $response = $this->post(route('doctors.store'), $data);
        $response->assertRedirect(route('doctors.index'));
        $this->assertDatabaseHas('doctors', ['name' => 'Test Doctor']);
    }

    public function test_show_method_returns_view_with_doctor()
    {
        $doctor = Doctor::factory()->create();
        $response = $this->get(route('doctors.show', $doctor));
        $response->assertStatus(200);
        $response->assertViewHas('doctor', $doctor);
    }

    public function test_edit_method_returns_view_with_doctor_and_specialties_and_clinics()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->get(route('doctors.edit', $doctor));
        $response->assertStatus(200);
        $response->assertViewHas('doctor', $doctor);
        $response->assertViewHas('specialties');
        $response->assertViewHas('clinics');
    }

    public function test_update_method_updates_doctor_and_redirects_to_index()
    {
        $doctor = Doctor::factory()->create();
        $specialty = Specialty::factory()->create();
        $clinic = Clinics::factory()->create();

        $data = ['name' => 'Updated Doctor', 'specialties' => [$specialty->id], 'clinics' => [$clinic->id]];

        $response = $this->put(route('doctors.update', $doctor), $data);
        $response->assertRedirect(route('doctors.index'));
        $this->assertDatabaseHas('doctors', ['name' => 'Updated Doctor']);
    }
}
