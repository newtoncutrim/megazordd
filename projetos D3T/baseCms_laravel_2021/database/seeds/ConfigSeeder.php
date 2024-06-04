<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_timestamp = date('Y-m-d h:i:s');

        DB::table('configurations')->insert([
            [
                'id' => 1,
                'keywords' => '',
                'description' => '',
                'title' => '',
                'phone' => '',
                'whatsapp' => '',
                'facebook' => '',
                'instagram' => '',
                'linkedin' => '',
                'form_email' => '',
                'email' => '',
                'created_at' => $current_timestamp,
                'updated_at' => $current_timestamp,
            ]
        ]);
    }
}
