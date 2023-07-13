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
        $fakeUsers = ['Cassio Sabbatini','Michelangelo Mazzi','Athos Padovano','Tommaso Calabrese', 'Anna Dellucci'];

        foreach ($fakeUsers as $name){

          $new_user = new User();
          $new_user->name = $name;
          $new_user->email = str_replace(' ', '', $name) . '@admin.it' ;
          $new_user->password = Hash::make('0000');
          $new_user->save();
        }


    }
}
