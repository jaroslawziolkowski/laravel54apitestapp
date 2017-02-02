<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReportTest extends TestCase
{
    /**
     * A basic test for correct call to report
     *
     * @return void
     */
    public function testReport()
    {
      $response = $this->json('POST','/api/report',[]);

      $response->assertStatus(200);
    }


}
