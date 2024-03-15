<?php

namespace Tests\Http\Controllers;

use App\Models\Clinics;
use Tests\TestCase;

class ClinicControllerTest extends TestCase
{
    /** @test */
    public function it_returns_view_with_potential_duplicates()
    {
        $response = $this->get('/clinics');

        $response->assertStatus(200)->assertViewIs('clinics.potential_duplicates')->assertViewHas('potentialDuplicates');
    }

    /** @test */
    public function it_merges_duplicate_clinics_and_redirects_to_index()
    {
        $clinic1 = Clinics::factory()->create();
        $clinic2 = Clinics::factory()->create();


        $response = $this->post('/clinics/merge', ['duplicate_ids' => "$clinic1->id,$clinic2->id"]);

        $response->assertRedirect('/clinics');
        $response->assertStatus(302); // the status code for a redirect
    }
}
