<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = factory(User::class)->make([
            'email' => 'admin@admin.com',
        ])->toArray();

        User::updateOrCreate(
            ['email' => $user['email']],
            array_merge($user, ['password' => Hash::make('password')])
        );
    }
}
