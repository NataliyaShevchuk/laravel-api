<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ["HTML", "CSS", "Bootstrap", "JavaScript", "SASS", "Vue", "PHP", "Laravel"];

        foreach($technologies as $technology){
            $technologyData = new Technology();
            $technologyData->name = $technology;
            $technologyData->save();
        }
    }
}
