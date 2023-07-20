<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    private function calculateDistanceInKm($longitude1, $latitude1, $longitude2, $latitude2)
  {
      $rawDistance = DB::selectOne("SELECT ST_Distance_Sphere(point($longitude1, $latitude1), point($longitude2, $latitude2)) as distance");
      return $rawDistance->distance / 1000;
  }

  public function searchByRange(Request $request){

    $data = $request->all();

    $apartments = Apartment::select(['id','user_id','name','slug','description','slug','cover_image','address','address_info','price','n_of_bed','n_of_room','n_of_bathroom','apartment_size','type','created_at',
    DB::raw("ST_AsText(coordinate) as coordinate")])
  ->get()
  ->map(function ($apartment) {
    $coordinates = sscanf($apartment->coordinate, 'POINT(%f %f)');
    $apartment->coordinate = [
        'longitude' => $coordinates[0],
        'latitude' => $coordinates[1]
    ];
    return $apartment;});



    // $longitude = 12.29600;
    // $latitude = 44.43871;
    // $radius = 20; // Raggio in chilometri

    $longitude = $data['longitude'];
    $latitude = $data['latitude'];
    $radius = $data['radius']; // Raggio in chilometri

      $filteredApartments = $apartments->filter(function ($apartment) use ($longitude, $latitude, $radius) {
      $distanceInKm = $this->calculateDistanceInKm($apartment->coordinate['longitude'], $apartment->coordinate['latitude'], $longitude, $latitude);
      return $distanceInKm <= $radius;
      });

      // $provolone = [
      //   "nome" => "marco"
      // ];

      return response()->json(compact('filteredApartments'));
  }

}
