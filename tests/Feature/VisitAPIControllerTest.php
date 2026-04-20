<?php

namespace Tests\Feature;

use App\Models\Patient;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisitAPIControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function getDistinctDiagnosis_requires_authentication(): void
    {
        $this->getJson('/api/visits/diagnosis')
             ->assertStatus(401);
    }

    /** @test */
    public function getDiagnosisByVisitId_requires_authentication(): void
    {
        $this->getJson('/api/visit/diagnosis/1')
             ->assertStatus(401);
    }

    /** @test */
    public function getDistinctDiagnosis_returns_unique_diagnoses(): void
    {
        $patient = Patient::factory()->create();
        Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Flu']);
        Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Flu']);
        Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Hypertension']);

        $response = $this->actingAs($this->user)
                         ->getJson('/api/visits/diagnosis');

        $response->assertStatus(200);
        $results = $response->json('results');
        $this->assertCount(2, $results);
        $this->assertTrue(collect($results)->pluck('id')->contains('Flu'));
        $this->assertTrue(collect($results)->pluck('id')->contains('Hypertension'));
    }

    /** @test */
    public function getDistinctDiagnosis_excludes_soft_deleted_visits(): void
    {
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'DeletedDisease']);
        $visit->delete();

        $response = $this->actingAs($this->user)
                         ->getJson('/api/visits/diagnosis');

        $response->assertStatus(200);
        $results = $response->json('results');
        $this->assertFalse(collect($results)->pluck('id')->contains('DeletedDisease'));
    }

    /** @test */
    public function getDiagnosisByVisitId_returns_diagnosis_for_valid_visit(): void
    {
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Diabetes']);

        $response = $this->actingAs($this->user)
                         ->getJson("/api/visit/diagnosis/{$visit->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'results' => [
                         ['id' => 'Diabetes', 'text' => 'Diabetes']
                     ]
                 ]);
    }

    /** @test */
    public function getDiagnosisByVisitId_returns_404_for_missing_visit(): void
    {
        $this->actingAs($this->user)
             ->getJson('/api/visit/diagnosis/99999')
             ->assertStatus(404);
    }

    /** @test */
    public function getDiagnosisByVisitId_returns_404_for_soft_deleted_visit(): void
    {
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Gone']);
        $visit->delete();

        $this->actingAs($this->user)
             ->getJson("/api/visit/diagnosis/{$visit->id}")
             ->assertStatus(404);
    }
}
