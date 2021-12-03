<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Issue;
use App\Solution;
use DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testBoo()
    {
        // $issue = factory(Issue::class)->create();
        // $this->assertFalse( $issue->hasSolutions() );

        // $issue->solutions()->save(factory(Solution::class)->make());
        // $this->assertTrue( $issue->hasSolutions() );        
        $this->assertTrue(true);
    }

}
