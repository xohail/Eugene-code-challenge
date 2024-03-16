<?php

namespace Tests\Http\Controllers;

use App\Models\Clinics;
use App\Models\Doctor;
use App\Models\TestName;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class TestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method_returns_view_with_tests()
    {
        $response = $this->get(route('tests.index'));
        $response->assertStatus(200);
        $response->assertViewHas('tests');
    }

    public function test_create_method_returns_view_with_doctors_and_tests()
    {
        $response = $this->get(route('tests.create'));
        $response->assertStatus(200);
        $response->assertViewHas('doctors');
        $response->assertViewHas('tests');
    }

    public function test_store_method_creates_test_and_redirects_to_index()
    {
        $testName = TestName::factory()->create();
        $doctor = Doctor::factory()->create();
        $clinic = Clinics::factory()->create();

        $request = $this->app->make(Request::class);
        $request->merge(['test_name_id' => $testName->id, 'description' => 'test', 'referring_doctor_id' => $doctor->id . '_' . $clinic->id,]);

        $response = $this->post(route('tests.store'), $request->all());

        $response->assertRedirect(route('tests.index'));
        $this->assertDatabaseHas('tests', ['test_name_id' => $testName->id, 'description' => 'test', 'referring_doctor_id' => $doctor->id,]);
    }
}
