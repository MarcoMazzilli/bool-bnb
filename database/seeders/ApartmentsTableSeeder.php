<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use App\Models\Sponsorship;
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

        $type = [
          'Monolocale',
          'Bilocale',
          'Trilocale',
          'Quadrilocale',
          'Studio',
          'Mansarda',
          'Rustico',
          'Chalet',
          'Appartamento duplex',
          'Villa',
          'Attico',
          'Bungalow',
          'Loft'
        ];

        foreach ($apartments as $apartment) {

          $services = [];
          // genero un array di numeri da 1 a 17 di lunghezza random
          for ($i=1; $i < rand(2,18); $i++) {
            $number = rand(1,17);
            if(!in_array($number, $services)){
              $services[] = $number;
            }
          }

          // dd($services);

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
          // $new_apartment->type = $apartment['type'];
          $new_apartment->type = $type[rand(0, count($type) - 1)];

          // dump($new_apartment);
          $new_apartment->save();

          $new_apartment->services()->attach($services);
          // dd($new_apartment['services']);

        //   if (array_key_exists('services', $apartment)) {
        //     $new_apartment->services()->attach($apartment['services']);
        // }

          if (array_key_exists('sponsor', $apartment)) {

            $randomDate = Carbon::now('GMT+2')->addDays(rand(0, 5));

            $sponsorship = Sponsorship::find($apartment['sponsor']);

            $new_apartment->sponsorships()->attach(
              $apartment['sponsor'],
              [
                'started_at' => $randomDate,
                'expiration_date' => $randomDate->copy()->addHours($sponsorship[0]->duration)
              ]
            );

        }
        }
    }
}
