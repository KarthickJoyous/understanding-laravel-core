<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Car;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Owner;
use App\Models\Broker;
use App\Models\Garage;
use App\Models\Project;
use App\Models\Mechanic;
use App\Models\Property;
use App\Models\Security;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            Post::factory(rand(0, 10))
                ->for($user)
                ->hasComments(rand(0, 2))
                ->create();
        }

        $projects = Project::factory(10)->create();

        foreach ($projects as $project) {

            $property = Property::factory(1)->for($project)->create();

            Broker::factory(1)->for($property[0])->create();
        }

        $mechanics = Mechanic::factory(10)->create();

        foreach ($mechanics as $mechanic) {

            $owner = Car::factory(1)->for($mechanic)->create();

            Owner::factory(1)->for($owner[0])->create();
        }

        $user_ids = User::pluck('id')->toArray();

        $role_ids = collect(Role::factory(20)->create())->pluck('id')->toArray();

        foreach (range(1, 60) as $range) {
            $role_users[] = [
                'user_id' => $user_ids[rand(0, count($user_ids) - 1)],
                'role_id' => $role_ids[rand(0, count($role_ids) - 1)],
                'created_at' => (string)now(),
                'updated_at' => (string)now()
            ];
        }

        DB::table('role_user')->insert($role_users);

        Garage::factory(20)->has(Bus::factory(rand(5, 15))->has(Security::factory(rand(1,5))))->create();
    }
}
