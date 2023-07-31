@extends('layouts.app')

@section('content')

<div class="container p-5">

  <div class="card text-center shadow">
    <div class="card-header bg-white d-flex justify-content-center align-items-center gap-5">

      <i class="fa-solid fa-check fs-1 text-success"></i>
      <h3>Transazione avvenuta con successo</h3>

    </div>
    <div class="card-body">
      <h5 class="card-title">Hai aquistato: <strong>{{$sponsorship->name}}</strong></h5>

      <div class="my-3">
        <p><strong>Appartamento: </strong>{{ $apartment->name}}</p>
      </div>

      <div class="d-flex gap-3 justify-content-center my-3">
        <span class="card-text"><strong>Prezzo:</strong> &euro; {{$transaction->amount }}</span>
        <span><strong>Durata : </strong>{{$sponsorship->duration }} h.</span>
      </div>

      <div class="my-3">
        <p><strong>La sponsorizzazione avrà inizio il :</strong> {{$startDate}}</p>
        <p><strong>E durerà fino al :</strong> {{ $expiration_date }} </p>
      </div>

      <a href="{{ route('admin.apartments.index')}}" class="btn mvm-button">Torna alla dashboard</a>
      {{-- @dump($apartment) --}}
    </div>
  </div>

</div>


@endsection
