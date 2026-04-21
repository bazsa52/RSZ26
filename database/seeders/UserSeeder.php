<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Role;
use App\Models\RoleEnum;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $address = count(Address::all()) > 0 ? Address::all()->random() : Address::factory()->create();

        foreach (Role::all() as $role) {
            $user = User::factory()->make();
            $user->address()->associate($address);
            $user->save();
            $user->roles()->attach($role);
            $user->save();
        }
    }
}
