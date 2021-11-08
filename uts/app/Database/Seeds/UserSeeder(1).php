<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                "name" => "Rama1",
                "email" => "rama1@gmail.com",
                "phone_no" => "7899654125",
                "role" => "admin",
                "password" => password_hash("12345678", PASSWORD_DEFAULT)
            ],
            [
                "name" => "Rama2",
                "email" => "rama2@gmail.com",
                "phone_no" => "8888888888",
                "role" => "editor",
                "password" => password_hash("12345678", PASSWORD_DEFAULT)
            ]
        ];
        $this->db->table('tbl_users')->insertBatch($data);
    }
}
