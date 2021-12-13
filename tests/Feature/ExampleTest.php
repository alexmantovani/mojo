<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function testRouteNewIssue()
    {
        $response = $this->get( route('new_issue') );
        $response->assertStatus(302);

        $response = $this->get( "issues/create" );
        $response->assertStatus(302);
    }


}
