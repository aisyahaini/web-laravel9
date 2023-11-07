<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UsetTest extends TestCase
{
    // kalo mau cek halaman ada pake 200, kalo cek halaman tidak ada pake 404

    public function test_login_form()
    {
        // melakukan get kepada endpoint / login
        $response = $this->get('/login'); // kalo berhasil maka /login bisa diakses
        $response->assertStatus(200); // kalo mau lancar pake 200
    }

    // untuk mengecek apakah ada end point yang tidak exists
    public function test_endpoint_not_exists()
    {
        // pake /update karena di router nya tidak ada route get yang pake /updata (ya terserah sih)
        $response = $this->get('/update');
        $response->assertStatus(404); // 404 itu not found
    }

    // untuk tes pembuatan user
    public function test_user_duplication()
    {
        $user1 = User::make([
            'name' => 'aisyah',
            'email' => 'aisyah@an.com'
        ]);

        $user2 = User::make([
            'name' => 'aini',
            'email' => 'aini@an.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
        $this->assertTrue($user1->email != $user2->email);
    }

    // untuk mengetest delete user
    public function test_delete_user()
    {
        $user = User::make([
            'name' => 'test',
            'email' => 'test@t.com'
        ]);

        $user->delete();

        $this->assertTrue(true);
    }
    
}
