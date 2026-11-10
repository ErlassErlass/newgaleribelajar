<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Lead;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_submit_consultation_lead_form(): void
    {
        $response = $this->post('/leads', [
            'type' => 'consultation',
            'sender_type' => 'school',
            'name' => 'Budi Santoso',
            'phone' => '081234567890',
            'email' => 'budi@teladansuci.sch.id',
            'school_name' => 'SDI Teladan Suci',
            'city' => 'Jakarta Timur',
            'student_count' => 120,
            'program' => 'coding-informatika',
            'message' => 'Konsultasi program ekskul coding semester depan.',
            'consent_given' => '1',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('leads', [
            'name' => 'Budi Santoso',
            'phone' => '081234567890',
            'school_name' => 'SDI Teladan Suci',
            'status' => 'new',
        ]);
    }
}

