<?php

namespace Tests\Unit\Controllers\Duplicates;

use App\Http\Controllers\Duplicates\ClinicsMergeController;
use App\Models\Clinics;
use App\Services\DuplicateMergeService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class ClinicsMergeControllerTest extends TestCase
{
    protected $controller;
    protected $duplicateMergeService;

    public function setUp(): void
    {
        parent::setUp();

        // Mock the DuplicateMergeService
        $this->duplicateMergeService = Mockery::mock(DuplicateMergeService::class);

        // Create an instance of the controller with the mocked service
        $this->controller = new ClinicsMergeController($this->duplicateMergeService);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // Destroy the mocked objects
        Mockery::close();
    }

    public function testIndexReturnsViewWithData()
    {
        // Mock Clinics model methods
        $mock = Mockery::mock(Clinics::class);
        $mock->shouldReceive('selectRaw')->andReturnSelf();
        $mock->shouldReceive('whereNotNull')->andReturnSelf();
        $mock->shouldReceive('groupBy')->andReturnSelf();
        $mock->shouldReceive('havingRaw')->andReturnSelf();
        $mock->shouldReceive('get')->andReturn([
            (object) ['duplicate_ids' => '1,2', 'name' => 'Clinic A', 'house' => 'House A', 'duplicates_count' => 2],
            (object) ['duplicate_ids' => '3', 'name' => 'Clinic B', 'house' => 'House B', 'duplicates_count' => 2],
        ]);

        // Call the index method
        $response = $this->controller->index();

        // Assert that the response is a view
        $this->assertInstanceOf(View::class, $response);

        // Assert that the view has the correct data
        $this->assertArrayHasKey('potentialDuplicates', $response->getData());
        $this->assertTrue($response->getData()['potentialDuplicates'][0]->getAttributes()['duplicates_count'] > 1);
    }

    public function testClinicsMergeRedirectsToCorrectRoute()
    {
        // Mock the request
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('input')->with('duplicate_ids')->andReturn('1,2');

        // Mock the mergeClinics method of the DuplicateMergeService
        $this->duplicateMergeService->shouldReceive('mergeClinics');

        // Call the clinics_merge method
        $response = $this->controller->clinicsMerge($request);

        // Assert that the response is a redirect
        $this->assertTrue($response->isRedirect());

        // Assert that the response redirects to the correct route
        $this->assertEquals(env('APP_URL').'/duplicates/clinics', $response->getTargetUrl());
    }
}
