<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actionType =[
            [
                'type'=> 'Like',
            ],
            [
                'type'=> 'Dislike',
            ]
        ];

        foreach ($actionType as $action) {
            Action::create($action);
        }
    }
}
