<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

  public function searchByRange(Request $request)
  {
    $data = $request->all();

    $longitude = $data['longitude'];
    $latitude = $data['latitude'];
    $radius = $data['radius']; // Raggio in chilometri
    $services = $data['services'];
    $beds = $data['beds'];
    $rooms = $data['rooms'];
    $bathrooms = $data['bathrooms'];
    $size = $data['size'];


      //Se arriva faccio un controllo sullla lunghezza, e se maggiore di 0 applico la logica
      if (count($services) > 0) {
        $apartments = Apartment::select([
          'id', 'user_id', 'name', 'slug', 'description', 'cover_image',
          'address', 'address_info', 'price', 'n_of_bed', 'n_of_room', 'n_of_bathroom',
          'apartment_size', 'type', 'created_at',
          DB::raw("ST_Y(coordinate) as latitude"),
          DB::raw("ST_X(coordinate) as longitude"),
          DB::raw("ST_Distance_Sphere(point(ST_X(coordinate), ST_Y(coordinate)), point($longitude, $latitude)) / 1000 as distance")
        ])
          ->where('n_of_bed', '>=', $beds)
          ->where('n_of_bathroom' ,'>=', $bathrooms )
          ->where('apartment_size' ,'>=', $size)
          ->where('n_of_room' ,'>=', $rooms)
          ->with('services', 'sponsorships')
          ->having('distance', '<=', $radius)
          ->whereHas('services', function (Builder $query) use ($services) {
            $query->whereIn('service_id', $services);
          }, '=', count($services))
          ->orderBy('distance')
          ->paginate(18);
      }else {
      $apartments = Apartment::select([
        'id', 'user_id', 'name', 'slug', 'description', 'cover_image',
        'address', 'address_info', 'price', 'n_of_bed', 'n_of_room', 'n_of_bathroom',
        'apartment_size', 'type', 'created_at',
        DB::raw("ST_Y(coordinate) as latitude"),
        DB::raw("ST_X(coordinate) as longitude"),
        DB::raw("ST_Distance_Sphere(point(ST_X(coordinate), ST_Y(coordinate)), point($longitude, $latitude)) / 1000 as distance")
        ])
        ->having('distance', '<=', $radius)
        ->where('n_of_bed', '>=', $beds)
        ->where('n_of_bathroom' ,'>=', $bathrooms )
        ->where('apartment_size' ,'>=', $size)
        ->where('n_of_room' ,'>=', $rooms)
        ->orderBy('distance')
        ->paginate(18);
    }


    //Controllo se mi arriva il parametro "services"


    return response()->json(compact('apartments'));
  }

  public function searchByServices(Request $request)
  {
    $data = $request->all();
    $services = $data['services'];

    $apartments = Apartment::select([
      'id', 'user_id', 'name', 'slug', 'description', 'slug', 'cover_image', 'address', 'address_info', 'price', 'n_of_bed', 'n_of_room', 'n_of_bathroom', 'apartment_size', 'type', 'created_at',
      DB::raw("ST_X(coordinate) as latitude"),
      DB::raw("ST_Y(coordinate) as longitude")
    ])
      ->with('services', 'sponsorships')
      ->whereHas('services', function (Builder $query) use ($services) {
        $query->whereIn('service_id', $services);
      }, '=', count($services))->orderBy('created_at')->paginate(18);

    return response()->json(compact('apartments'));
  }
}



// ----------- OLD QUERY

  // private function calculateDistanceInKm($longitude1, $latitude1, $longitude2, $latitude2)
  // {

  //   $rawDistance = DB::selectOne("SELECT ST_Distance_Sphere(point($longitude1, $latitude1), point($longitude2, $latitude2)) as distance");

  //   return $rawDistance->distance / 1000;
  // }

  // public function searchByRange(Request $request)
  // {

  //   $data = $request->all();

  //   $apartments = Apartment::select([
  //     'id', 'user_id', 'name', 'slug', 'description', 'slug', 'cover_image', 'address', 'address_info', 'price', 'n_of_bed', 'n_of_room', 'n_of_bathroom', 'apartment_size', 'type', 'created_at',
  //     DB::raw("ST_AsText(coordinate) as coordinate")
  //   ])
  //     ->get()
  //     ->map(function ($apartment) {
  //       $coordinates = sscanf($apartment->coordinate, 'POINT(%f %f)');
  //       $apartment->coordinate = [
  //         'longitude' => $coordinates[0],
  //         'latitude' => $coordinates[1]
  //       ];
  //       return $apartment;
  //     });

  //   // $longitude = 12.29600;
  //   // $latitude = 44.43871;
  //   // $radius = 20; // Raggio in chilometri

  //   $longitude = $data['longitude'];
  //   $latitude = $data['latitude'];
  //   $radius = $data['radius']; // Raggio in chilometri

  //   $filteredApartments = $apartments->filter(function ($apartment) use ($longitude, $latitude, $radius) {
  //     $distanceInKm = $this->calculateDistanceInKm($apartment->coordinate['longitude'], $apartment->coordinate['latitude'], $longitude, $latitude);
  //     return $distanceInKm <= $radius;
  //   });

  //   return response()->json(compact('filteredApartments'));
  // }
