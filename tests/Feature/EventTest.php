<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_useractivity(): void
    {
        $this->withoutExceptionHandling();
        //Prepare
        $testData = [
            'activity_id'=>'Math-1',
            'user_id'=> ["user122","user134","user139","user137"]
        ];
        //Action / Perform
        $response = $this->postJson('api/showtime',$testData);
        //Assertion / predict
        $response->assertJsonStructure([ // Verify the JSON structure
            '*' => ['*' => [
                'quiz_id',
                'activity_id',
                'name',
                'timetaken'
            ]
                ],]);
        $this->assertEquals(2, count($response->json()));
        $response->assertStatus(200);
    }
}
