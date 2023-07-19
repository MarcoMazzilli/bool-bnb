<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index(){

        // $apartments = Apartment::select(['coordinate'])->get();
        // $apartments = Apartment::select(['name','description','address',DB::raw("ST_AsText(coordinates) as coordinates")])->get();
        $latitude = DB::select(DB::raw("SELECT ST_X('latitude_longitude') FROM 'apartments"));
        $lat = json_decode(json_encode(($latitude), true ));

        $success = true;
        return response()->json(compact('lat'));
    }
}
