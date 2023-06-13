<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [    
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => password_hash('adminpass', PASSWORD_BCRYPT),
                'role' => 'admin',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
