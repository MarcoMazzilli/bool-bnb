<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Carbon\Carbon;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class SponsorshipController extends Controller
{

  public function index(){

    return view('admin.apartments.apartment-sponsorship');
  }

  public function request(Request $request){

    $data = $request->all();
    $new_sponsorship = new Sponsorship();

    $apartmentId = $data['apartment'];
    $sponsorId = $data['sponsor'];
    $startDate = $data['date'];

    // Se non viene specificata una data, prendo quella locale
    if ($startDate == null) {
        $startDate = Carbon::now()->toDateTimeString();
      };

    $sponsorship = Sponsorship::find($sponsorId);


    $new_sponsorship->apartments()->attach($sponsorId,[
      'apartment_id' => $apartmentId,
      'sponsorship_id' => $sponsorId,
      'started_at' => $startDate,
      'expiration_date' => Carbon::parse($startDate)->addHours($sponsorship->duration)->toDateTimeString(),
    ]);


    return redirect()->route('admin.apartments.index')->with('confirm','Appartamento sponsorizzato con successo');
  }
}
