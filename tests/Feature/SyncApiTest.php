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

        \App\Models\Treatment::create(['disease_id' => $disease->id, 'treat' => 'Give vaccine']);

        $response = $this->getJson('/api/sync');

        $response->assertStatus(200)
            ->assertJson([
                'diseases' => [
                    [
                        'code' => 'P01',
                        'name' => 'Disease A',
                        'commonSymptoms' => ['G01']
                    ]
                ],
                'symptoms' => [
                    [
                        'code' => 'G01',
                        'imagePath' => 'img.jpg'
                    ]
                ],
                'rules' => [
                    [
                        'diseaseCode' => 'P01',
                        'symptomCode' => 'G01',
                        'mb' => 0.8,
                        'md' => 0.1
                    ]
                ],
                'treatments' => [
                    [
                        'diseaseCode' => 'P01',
                        'treat' => 'Give vaccine'
                    ]
                ]
            ]);
    }
}
