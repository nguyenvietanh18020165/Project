<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::insert([
            'name' => 'Ngọc Nguyễn Văn',
            'email' => 'doikotinh99@gmail.com',
            'password' => '$2y$10$lqhXkgUlc/7D3lpKfnoCp.VL9yosOE8saBV0TE.tkLFJrTq71QoiW',
            'is_admin' => '1'
        ]);
    }
}
