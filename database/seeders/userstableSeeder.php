<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'sachiko',
            'email' => 'sachiko@example.com',
            'password' => bcrypt('sachikodayo'),
        ];
        DB::table('users') -> insert($param);

        $param = [
            'name' => 'takashi',
            'email' => 'takashi@example.com',
            'password' => bcrypt('takashidayo'),
        ];
        DB::table('users') -> insert($param);

        $param = [
            'name' => 'tampopo',
            'email' => 'hanako@example.com',
            'password' => bcrypt('hanakodayo'),
        ];
        DB::table('users') -> insert($param);
    }
}
