<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    // membuat testing alur dimana user tidak bisa melakukan create, contohnya pada web.php
    // endpoint create diprotect di dalam group

    public function test_user_cannot_create_student()
    {
        $response = $this->post('/register', [
            'name' => 'aisyah',
            'email' => 'aisyah@an.com',
            'password' => 'akuaisyah',
            'password_confirmation' => 'akuaisyah',
            'role' => 'member'
        ]);

        // mengecek apakah di database ada user yang telah diregister
        $this->assertDatabaseHas('users', [
            'email' => 'aisyah@an.com'
        ]);

        // untuk mencari email aisyah@an.com yang first
        $user = User::where('email', 'aisyah@an.com')->first();

        // untuk mesimulasi role dari user
        $this->actingAs($user);

        $response2 = $this->get('/create');
        $response2->assertStatus(403); // 403 not authorized, di return sesuai yang ada di middleware
    }

    // fungsi kalo admin bisa create student
    public function test_admin_can_create_student()
    {
        $response = $this->post('/register', [
            'name' => 'aini',
            'email' => 'aini@an.com',
            'password' => 'siapanih',
            'password_confirmation' => 'siapanih',
            'role' => 'admin'
        ]);

        // mengecek apakah di database ada user yang telah diregister
        $this->assertDatabaseHas('users', [
            'email' => 'aini@an.com'
        ]);

        // cek untuk apakah sesuatu data tidak ada di database
        $this->assertDatabaseMissing('users', [
            'email' => 'azura@zr.com'
        ]);

        // untuk mencari email aisyah@an.com yang first
        $user = User::where('email', 'aini@an.com')->first();

        // untuk mesimulasi role dari user
        $this->actingAs($user);

        $response2 = $this->get('/create');
        $response2->assertStatus(200); 
    }
}
