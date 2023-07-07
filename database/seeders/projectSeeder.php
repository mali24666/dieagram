<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class projectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'id'    => 1,
                'top' => '100',
                'left' => '0',
                'station' => '1',
                'second_Feeder' => ' ',
                'ct_postion' => ' ',
                'descreption' => 'first station ',

            ],
        ];
        Project::insert($projects);

}
}
