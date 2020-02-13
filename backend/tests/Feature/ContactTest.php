<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Contact;

class ContactTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEditLastName() {
        $id = Contact::first()->uuid;

        $response = $this->json('PUT', "api/contacts/$id", [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@gmail.com'
        ])
         ->assertStatus(200)
         ->assertJson([
             'data' => [
                 'attributes' => [
                     'last_name' => 'Doe'
                 ]
             ]
             ]);
    }
}
