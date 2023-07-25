<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Visit;
use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Paginate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Braintree\Gateway;
use Braintree\ClientTokenGateway;


class DashboardController extends Controller
{
  public function index()
  {

    $apartmentsCount = [
      'appartamenti' => Apartment::all()->where('user_id', Auth::id())->count(),
      'appartamenti visibili' => Apartment::where('visible', 1)->where('user_id', Auth::id())->count(),
      'appartamenti nascosti' => Apartment::where('visible', 0)->where('user_id', Auth::id())->count()
    ];

    $SponsoredApartmentsCount =       Apartment::where('user_id', Auth::id())
    ->with('services', 'sponsorships')
    ->whereHas('sponsorships', function (Builder $query) {
      $query->where('sponsorship_id', '!=', null);
    })->count();

    $countTypeOfSponsor = [
      '[ 24h. ] Livello 1' =>
      Apartment::where('user_id', Auth::id())
        ->with('services', 'sponsorships')
        ->whereHas('sponsorships', function (Builder $query) {
          $query->where('sponsorship_id', 1);
        })->count(),

      '[ 72h. ] Livello 2' =>
      Apartment::where('user_id', Auth::id())
        ->with('services', 'sponsorships')
        ->whereHas('sponsorships', function (Builder $query) {
          $query->where('sponsorship_id', 2);
        })->count(),

      '[ 144h. ] Livello 3' =>
      Apartment::where('user_id', Auth::id())
        ->with('services', 'sponsorships')
        ->whereHas('sponsorships', function (Builder $query) {
          $query->where('sponsorship_id', 3);
        })->count(),
    ];

    return view('admin.home', compact('apartmentsCount','countTypeOfSponsor','SponsoredApartmentsCount'));
  }

  public function getSponsorship(){

    $apartments = Apartment::where('user_id' , Auth::id())->get(['id','name','address']);

    $sponsorships = Sponsorship::all();


    return view('admin.apartments.apartment-sponsorship',compact( 'apartments','sponsorships'));
  }
}
