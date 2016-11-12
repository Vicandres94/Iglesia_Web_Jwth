<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*  // $this->call(UsersTableSeeder::class);
        Model::unguard();

        DB::table('users')->delete();

        $users = array(
            [ 'username' => 'admin', 'password' => Hash::make('secret')=>],
            [ 'username' => 'user', 'password' => Hash::make('secret')]

        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        Model::reguard();*/
    }

}
