<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = include(database_path('seeds/mixins/users.php'));

        foreach($users as $userData){

            $user = \App\User::query()->where('email', $userData['email'])->first();

            if (empty($user)) {
                /** @var \App\User $user */
                $user = new \App\User($userData);
                if (!array_key_exists('photo', $userData)) {
                    $user->photo = '/img/no-avatar.png';
                }
                $user->save();
            }

            $role = $userData['type'] == 'doctor' ?: 'user';
            $user->changeRole($role);

        }
    }
}
