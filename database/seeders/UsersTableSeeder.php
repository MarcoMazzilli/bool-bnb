<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =[
          [
            "name" => 'Cassio',
            "lastName" => 'Sabbatini',
          ],
          [
            "name" => 'Michelangelo',
            "lastName" => 'Mazzi',
          ],
          [
            "name" => 'Athos',
            "lastName" => 'Padovano',
          ],
          [
            "name" => 'Tommaso',
            "lastName" => 'Calabrese'
          ],
          [
            "name" => 'Anna',
            "lastName" => 'Dellucci',
          ],
        ];

        foreach ($users as $user){

          $new_user = new User();
          $new_user->name = $user['name'];
          $new_user->last_name = $user['lastName'];
          $new_user->email = str_replace(' ', '', $user['name'] . $user['lastName'] ) . '@admin.it' ;
          $new_user->password = Hash::make('0000');
          $new_user->save();
        }


    }
}
