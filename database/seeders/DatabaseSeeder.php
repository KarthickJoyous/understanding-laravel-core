<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Broker;
use App\Models\Car;
use App\Models\Mechanic;
use App\Models\Owner;
use App\Models\Project;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $users = User::factory(10)->create();

        // foreach ($users as $user) {
        //     Post::factory(rand(0, 10))
        //         ->for($user)
        //         ->hasComments(rand(0, 2))
        //         ->create();
        // }

        // $projects = Project::factory(10)->create();

        // foreach ($projects as $project) {

        //     $property = Property::factory(1)->for($project)->create();

        //     Broker::factory(1)->for($property[0])->create();
        // }

        $mechanics = Mechanic::factory(10)->create();

        foreach ($mechanics as $mechanic) {

            $owner = Car::factory(1)->for($mechanic)->create();

            Owner::factory(1)->for($owner[0])->create();
        }
    }
}
