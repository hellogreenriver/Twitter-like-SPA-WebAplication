<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class peopletableSeeder extends Seeder
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
            'comment' => 'php',
            'person_id' => '1'
        ];
        DB::table('people') -> insert($param);

        $param = [
            'name' => 'takashi',
            'comment' => 'javascript',
            'person_id' => '2'
        ];
        DB::table('people') -> insert($param);

        $param = [
            'name' => 'hanako',
            'comment' => 'hello world',
            'person_id' => '3'
        ];
        DB::table('people') -> insert($param);
    }
}
