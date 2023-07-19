<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index(){

      // 'id','user_id','name','slug','description','slug','cover_image','address','address_info','price','n_of_bed','n_of_room','n_of_bathroom','apartment_size','type','created_at',

        $coordinates = Apartment::select([DB::raw("ST_AsText(coordinate) as coordinate")])
        ->get()
        ->map(function ($apartment) {
          $coordinates = sscanf($apartment->coordinate, 'POINT(%f %f)');
          $apartment->coordinate = [
              'longitude' => $coordinates[0],
              'latitude' => $coordinates[1]
          ];
          return $coordinates;});

          $apartments = Apartment::all()
          ->map(function ($apartment) {
            return collect($apartment)->except(['coordinate']);
        });

        // $apartments->map(function($apartment)){

        // };

        return response()->json(compact('apartments'));
    }
}
