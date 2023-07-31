<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{


    public function index(){

      // // ----------------------------------------------------------complete-apartments
      $now = Carbon::now('GMT+2')->toDateTimeString();

      $apartments = Apartment::select([
        'id','user_id','name','slug','description','slug','cover_image','address','address_info','price','n_of_bed','n_of_room','n_of_bathroom','apartment_size','type','created_at',
      DB::raw("ST_Y(coordinate) as latitude"),
      DB::raw("ST_X(coordinate) as longitude")])
      ->where('visible', true)
      ->with('services', 'sponsorships')
      ->whereHas('sponsorships', function ($query) use ($now) {
        $query->where('expiration_date', '>', $now)->where('started_at', '<=', $now);
      })
      ->orderBy('id','desc')
      ->paginate(18)
    ;


        return response()->json(compact('apartments'));
    }



    //   // -----------------------------------------------------apartmentsWithoutCoord

    //   $apartmentsWithoutCoord = Apartment::all()
    //   ->map(function ($apartment) {
      //     return collect($apartment)->except(['coordinate']);
      // });

      // // ------------------------------------------------------------------coordinates
      public function getCoordinates(){
        $coordinates = Apartment::select([DB::raw("ST_AsText(coordinate) as coordinate")])
        ->get()
        ->map(function ($apartment) {
          $coordinates = sscanf($apartment->coordinate, 'POINT(%f %f)');
          $apartment->coordinate = [
            'longitude' => $coordinates[0],
            'latitude' => $coordinates[1]
          ];
          return $coordinates;});

          return response()->json(compact('coordinates'));
        }




}
