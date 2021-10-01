<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Auth\User;

use App\Models\Empresa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EmpresaControllerTest extends TestCase
{
    use DatabaseTransactions;

    // Este metodo se ejecuta antes de cada test
    protected function setUp(): void
    {
        parent::setUp();
        // Le pongo el token de autenticacion a un usuario
        Sanctum::actingAs(User::factory()->make([
            'email' => 'rogelio@mail.com',
            'name' => 'Rogelio',
        ]));
    }
    
    public function test_index()
    {
        $empresas = Empresa::factory()->count(4)->create();
        $response = $this->json('GET', '/api/v1/empresa');
        $response->assertJsonCount(4);
    }

    public function test_create_new_company()
    {
         
        $data = [
            'nombre' => 'Polymath',
            'email' => 'polymath@mail.com',
            'logotipo' =>  UploadedFile::fake()->image('avatar.jpg'),
            'sitio_web' => 'polymath.com', 
        ];
        $response = $this->postJson('/api/v1/empresa', $data);

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseHas('empresa', $data);
    }
}
