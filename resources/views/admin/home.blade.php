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
                    <p class="card-text">Scatta delle foto, scegli un prezzo e preparati ad accogliere i tuoi primi ospiti!
                    </p>
                    <p>Inserire il tuo appartamento non è mai stato così semplice</p>
                    <a class="btn mm-btn" href="{{ route('admin.apartments.create') }}">Aggiungi alloggio</a>
                </div>
            </div>
        @else
            <div class="row justify-content-between">
                <div class="col col-7">
                    <div class="card shadow">
                        <div class="card-header">Recap</div>

                        <div class="card-body">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Tot. appartamenti Sponsorizzati :</strong>
                                    {{ $SponsoredApartmentsCount }} </li>

                                @foreach ($apartmentsCount as $label => $value)
                                    <li class="list-group-item"><strong>Tot. {{ $label }} :</strong>
                                        {{ $value }}</li>
                                @endforeach

                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col col-5">
                    <div class="card shadow h-100">
                        {{-- TODO: PASSARSI CON UNA QUERY TUTTI I MESSAGGI CON IL CAMPO READ FALSE --}}
                        <div class="card-header"><strong>Tot. messaggi ricevuti : </strong> {{ $messagesCount }}</div>

                        <div class="card-body overflow-y-scroll">
                          <ul class="list-group ">

                            @foreach ($messages as $message)
                            <li class="border rounded p-2">
                              @if (!$message->message_read)
                              <span class="badge text-bg-primary">1</span>
                              @else
                              <span class="badge text-bg-success">&checkmark;</span>
                              @endif

                                <span class="title fw-bold">{{ $message->author_email }} :</span>
                                <small class="result over">{{ $message->text }}</small>
                            </li>
                            <li>
                            @endforeach
                          </ul>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                {{-- TIPOLOGIA DI SPONSORIZZAZIONI ATTIVE --}}
                <div class="col col-4 my-5">
                    <div class="card shadow">
                        <div class="card-header">Tipologia di sponsorizzazioni</div>

                        <div class="card-body">

                            <ul class="list-group list-group-flush">

                                @foreach ($countTypeOfSponsor as $label => $value)
                                    <li class="list-group-item"><strong>{{ $label }} :</strong>
                                        {{ $value }}</li>
                                @endforeach

                            </ul>

                        </div>
                    </div>
                </div>
                {{-- /TIPOLOGIA DI SPONSORIZZAZIONI ATTIVE --}}

                {{-- ANALITICA APPARTAMENTI --}}
                <div class="col my-5">
                    <div class="card shadow">
                        <div class="card-header">Statistiche appartamenti</div>

                        <div class="card-body">

                            <span>INSERIRE STATISTICHE APPPARTAMENTI</span>

                        </div>
                    </div>
                </div>
                {{-- /ANALITICA APPARTAMENTI --}}
            </div>
        @endif
    </div>
@endsection
