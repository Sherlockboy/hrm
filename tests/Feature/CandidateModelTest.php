<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class CandidateModelTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function test_scope_search_by_first_name()
    {
        Candidate::factory()
            ->create([
                'first_name' => 'Jack'
            ]);

        $candidate = Candidate::search('jack')->get();

        $this->assertTrue($candidate->isNotEmpty());
    }

    public function test_scope_search_by_last_name()
    {
        Candidate::factory()
            ->create([
                'last_name' => 'London'
            ]);

        $candidate = Candidate::search('London')->get();

        $this->assertTrue($candidate->isNotEmpty());
    }

    public function test_scope_search_by_position()
    {
        Candidate::factory()
            ->create([
                'position' => 'Senior PHP Developer'
            ]);

        $candidate = Candidate::search('senior')->get();

        $this->assertTrue($candidate->isNotEmpty());
    }

    public function test_scope_search_by_status()
    {
        Candidate::factory()
            ->create([
                'status' => 'initial'
            ]);

        $candidate = Candidate::search('initial')->get();

        $this->assertTrue($candidate->isNotEmpty());
    }

    public function test_scope_search_by_skills()
    {
        $candidate = Candidate::factory()->create();

        $skill = Skill::factory()->create(['name' => 'PHP']);

        $candidate->skills()->attach($skill);

        $candidate = Candidate::search('php')->get();

        $this->assertTrue($candidate->isNotEmpty());
    }
}
