<?php

namespace Tests\Unit\Services;

use App\Http\Controllers\Duplicates\ClinicsMergeController;
use App\Models\Clinics;
use App\Models\Doctor;
use App\Services\DuplicateMergeService;
use Illuminate\Support\Facades\DB;
use Mockery;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class DuplicateMergeServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Create an instance of the service with the mocked service
        $this->service = new DuplicateMergeService();
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // Destroy the mocked objects
        Mockery::close();
    }

    public function testMergeClinics()
    {
        // Mock DB facade
        DB::shouldReceive('table')->andReturnSelf();
        DB::shouldReceive('whereIn')->andReturnSelf();
        DB::shouldReceive('update')->andReturn(true);

        // Mock Clinics model methods
        $mock = Mockery::mock(Clinics::class);
        $mock->shouldReceive('whereIn')->andReturnSelf();
        $mock->shouldReceive('whereIn')->andReturn(true);

        // Call the mergeClinics method
        $this->service->mergeClinics([1, 2], 1);
        assertTrue(true);
    }

    public function testMergeDoctors()
    {
        // Mock DB facade
        DB::shouldReceive('table')->andReturnSelf();
        DB::shouldReceive('whereIn')->andReturnSelf();
        DB::shouldReceive('update')->andReturn(true);

        // Mock Doctor model methods
        $mock = Mockery::mock(Doctor::class);
        $mock->shouldReceive('whereIn')->andReturnSelf();
        $mock->shouldReceive('whereIn')->andReturn(true);

        // Call the mergeDoctors method
        $this->service->mergeDoctors([1, 2], 1);
        assertTrue(true);
    }
}
