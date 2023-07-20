<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Helpers\CustomHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config('apartments');

        foreach ($apartments as $apartment) {
          $new_apartment = new Apartment();
          $new_apartment->user_id = User::inRandomOrder()->first()->id;
          $new_apartment->name = $apartment['name'];
          $new_apartment->slug = CustomHelper::generateUniqueSlug($apartment['name'], new Apartment());
          $new_apartment->description = $apartment['description'];
          $new_apartment->cover_image = $apartment['cover_image'];
          $new_apartment->address = $apartment['address'];
          $new_apartment->address_info = $apartment['address_info'];

          $new_apartment->coordinate = DB::raw($new_apartment->getCoordinates($apartment['address'])) ;

          $new_apartment->price = $apartment['price'];
          $new_apartment->n_of_bed = $apartment['n_of_bed'];
          $new_apartment->n_of_room = $apartment['n_of_room'];
          $new_apartment->n_of_bathroom = $apartment['n_of_bathroom'];
          $new_apartment->apartment_size = $apartment['apartment_size'];
          $new_apartment->visible = $apartment['visible'];
          $new_apartment->type = $apartment['type'];


          // dump($new_apartment);
          $new_apartment->save();

          if (array_key_exists('services', $apartment)) {
            $new_apartment->services()->attach($apartment['services']);
        }

          if (array_key_exists('sponsor', $apartment)) {
            // $new_apartment->sponsorships()->attach($apartment['sponsor']);
            $new_apartment->sponsorships()->attach(
              $apartment['sponsor'],
              // per la data corrente usare Carbon::now
              // ['started_at' => Carbon::now()]
              [
                'started_at' => '2021-03-20 16:21:54',
                'expiration_date' => '2021-03-20 16:21:54'
                ]
            );

        }
        }
    }
}
