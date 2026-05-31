<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rule;

class SyncApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_sync_endpoint_returns_correct_structure()
    {
        $disease = Disease::create(['code' => 'P01', 'name' => 'Disease A', 'description' => 'Desc A']);
        $symptom = Symptom::create(['code' => 'G01', 'name' => 'Symptom A', 'description' => 'Desc A', 'image' => 'img.jpg']);
        Rule::create(['disease_id' => $disease->id, 'symptom_id' => $symptom->id, 'mb' => 0.8, 'md' => 0.1]);

        \App\Models\KnowledgeBaseVersion::create([
            'version' => 1,
            'published_at' => now(),
            'created_by' => null,
            'diseases_count' => 1,
            'symptoms_count' => 1,
            'rules_count' => 1,
        ]);

        $response = $this->getJson('/api/sync');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'new_update_available',
                'version' => 1,
                'data' => [
                    'diseases' => [
                        [
                            'code' => 'P01',
                            'name' => 'Disease A',
                            'description' => 'Desc A'
                        ]
                    ],
                    'symptoms' => [
                        [
                            'code' => 'G01',
                            'name' => 'Symptom A'
                        ]
                    ],
                    'rules' => [
                        [
                            'diseaseCode' => 'P01',
                            'symptomCode' => 'G01',
                            'mb' => 0.8,
                            'md' => 0.1
                        ]
                    ]
                ]
            ]);
    }
}
