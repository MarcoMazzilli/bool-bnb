@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="text-secondary my-4">Benvenuto {{ Auth::user()->name }} {{ Auth::user()->last_name }} </h2>
        @if ($apartmentsCount['appartamenti'] === 0)

            <div class="card">
                <div class="card-header">
                    Inserisci il tuo primo appartamento!
                </div>
                <div class="card-body">
                    <h3 class="card-title">Guadagna con <span>BoolBnb</span></h3>
                    <p class="card-text">Scatta delle foto, scegli un prezzo e preparati ad accogliere i tuoi primi ospiti!</p>
                    <p>Inserire il tuo appartamento non è mai stato così semplice</p>
                    <a class="btn" href="{{ route('admin.apartments.create') }}">Aggiungi alloggio</a>
                </div>
            </div>
        @else
            <div class="row justify-content-between">
                <div class="col col-7">
                    <div class="card shadow">
                        <div class="card-header">Recap</div>

                        <div class="card-body">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Tot. appartamenti Sponsorizzati :</strong> ???? </li>

                                @foreach ($apartmentsCount as $label => $value)
                                    <li class="list-group-item"><strong>Tot. {{ $label }} :</strong>
                                        {{ $value }}</li>
                                @endforeach

                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col col-5">
                    <div class="card shadow">
                        {{-- TODO: PASSARSI CON UNA QUERY TUTTI I MESSAGGI CON IL CAMPO READ FALSE --}}
                        <div class="card-header">N. nuovi messaggi</div>

                        <div class="card-body">

                            <div>
                                <p class="title fw-bold">Mittente :</p>
                                <p class="result">anteprima messaggio</p>
                            </div>
                            <div>
                                <p class="title fw-bold">Mittente :</p>
                                <p class="result">anteprima messaggio</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
