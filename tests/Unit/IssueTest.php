<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Issue;
use App\Solution;
use DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;


class IssueTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        factory(Issue::class)->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateIssue()
    {
        $issue = factory(Issue::class)->create();
        $this->assertIsNumeric($issue->id);
        $this->assertIsString($issue->title);
        $this->assertGreaterThan(0, strlen($issue->title));
    }

    /** @test */
    public function testIssueHasSolutions()
    {
        // Creo un nuovo issue senza alcuna soluzione
        $issue = factory(Issue::class)->create();
        $this->assertFalse( $issue->hasSolutions() );

        $unsolved = \App\Issue::doesntHave('Solutions')->get();
        $this->assertEquals( count($unsolved), 2 );

        // Associo una soluzione all'issue appena creato
        $issue->solutions()->save(factory(Solution::class)->make());
        $this->assertTrue( $issue->hasSolutions() );

        $unsolved = \App\Issue::doesntHave('Solutions')->get();
        $this->assertEquals( count($unsolved), 1 );
    }

    /** @test */
    public function testUnsolvedIssues()
    {
        $unsolved = \App\Issue::doesntHave('Solutions')->get();
        $this->assertEquals( count($unsolved), 1 );
        
        $this->assertTrue( true );
    }
}
