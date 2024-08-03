<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $clientRepository = new ClientRepository();
        $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );
    }

    /** @test */
    public function user_can_login_and_get_token()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);
        
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        
        Storage::put('test-output/response_content.json', $response->getContent());

        $response->assertStatus(200)
                ->assertJsonStructure(['token']);
    }

}
