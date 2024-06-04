<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'D3T',
            'email' => 'd3t@d3t.com.br',
            'password' => bcrypt('123456'),
            'remember_token' => 'WFZ3NMP2AoMuNFMvtxioVSmYoyZHPmlL3W8aXomkJ68FHGDtED3XRi03Ry0R',
            'created_at' => '2018-02-13 11:28:36',
            'updated_at' => '2018-02-19 13:59:28',
            'username' => 'admin',
            'group_id' => 1,
            'deleted_at' => null,
        ]);
    }
}