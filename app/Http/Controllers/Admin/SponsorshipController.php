<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Carbon\Carbon;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Braintree\Gateway;

class SponsorshipController extends Controller
{

  public function index()
  {
    return view('admin.apartments.apartment-sponsorship');
  }

  public function request(Request $request)
  {
    $data = $request->all();
    $jsonData = json_encode($data);

    $apartmentId = $data['apartment'];
    $sponsorId = $data['sponsor'];

    $sponsorship = Sponsorship::find($sponsorId);
    $apartment = Apartment::find($apartmentId);

    $gateway = new Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();


    return view('admin.partials.payMethod', compact('token', 'jsonData', 'apartment', 'sponsorship'));
  }

  public function checkout(Request $request)
  {
    $data = json_decode($request['data']);
    // --------------------------------------------

    $apartmentId = $data->apartment;
    $sponsorId = $data->sponsor;
    $startDate = $data->date;

    $sponsorship = Sponsorship::find($sponsorId);
    $apartment = Apartment::find($apartmentId);

    $gateway = new Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $sponsorship->price;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
      'amount' => $amount,
      'paymentMethodNonce' => $nonce,
      'customer' => [
        'firstName' => 'Tony',
        'lastName' => 'Stark',
        'email' => 'tony@avengers.com',
      ],
      'options' => [
        'submitForSettlement' => true
      ]
    ]);

    if ($result->success) {

      // Se non viene specificata una data, prendo quella locale
      if ($startDate == null) {
        $startDate = Carbon::now('GMT+2')->toDateTimeString();
      };


      if (!$apartment->visible) {
        $apartment->visible = 1;
        $apartment->update();
      }

      $new_sponsorship = new Sponsorship();

      $new_sponsorship->apartments()->attach($sponsorId, [
        'apartment_id' => $apartmentId,
        'sponsorship_id' => $sponsorId,
        'started_at' => $startDate,
        'expiration_date' => Carbon::parse($startDate)->addHours($sponsorship->duration)->toDateTimeString(),
      ]);

      // ---------------------------------------------
      $expiration_date = Carbon::parse($startDate)->addHours($sponsorship->duration)->toDateTimeString();
      $transaction = $result->transaction;

      $startDate = date_create($startDate);
      $startDate = date_format($startDate, 'd/m/Y') ;

      $expiration_date = date_create($expiration_date);
      $expiration_date = date_format($expiration_date, 'd/m/Y');

      // return redirect()->route('admin.apartments.index')->with('success_message', 'Transazione eseguita con successo' . $transaction->id);
      // return redirect()->route('sponsorship.feedback-transaction')->with('transaction_id', $transaction->id);
      return view('admin.partials.feedback-trasaction',compact('transaction','sponsorship','startDate','expiration_date','apartment'))->with('transaction_id', $transaction->id);
    } else {
      // dd('errore bloccante');
      $errorString = "";

      foreach ($result->errors->deepAll() as $error) {
        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
      }
      return back()->withErrors('An error occurred with the message: ' . $result->message);
    }
  }

  public function feedback(){
    $success = session()->get('transaction_id');


    return view('admin.partials.feedback-trasaction',compact('success'));
  }
}

// $new_sponsorship = new Sponsorship();

// $data = $request->all();

// $apartmentId = $data['apartment'];
// $sponsorId = $data['sponsor'];
// $startDate = $data['date'];

// // Se non viene specificata una data, prendo quella locale
// if ($startDate == null) {
//   $startDate = Carbon::now()->toDateTimeString();
// };

// $sponsorship = Sponsorship::find($sponsorId);


// $new_sponsorship->apartments()->attach($sponsorId, [
//   'apartment_id' => $apartmentId,
//   'sponsorship_id' => $sponsorId,
//   'started_at' => $startDate,
//   'expiration_date' => Carbon::parse($startDate)->addHours($sponsorship->duration)->toDateTimeString(),
// ]);
