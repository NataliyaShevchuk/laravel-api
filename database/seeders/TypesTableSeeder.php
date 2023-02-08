<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ["HTML", "CSS", "Bootstrap", "JavaScript", "Vue", "PHP", "Laravel"];

        // foreach ($types as $type) {
        //     $newType = new Type();
        //     $newType->name = $type;
        //     $newType->save();
        // }

        foreach ($types as $type) {
            
            DB::table('types')->insert([
                "name" => $type,
            ]);
        }
    }
}
