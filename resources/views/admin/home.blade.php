@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="text-secondary my-4">Benvenuto {{ Auth::user()->name }} {{ Auth::user()->last_name }} </h2>

    <div class="row justify-content-between">
        <div class="col col-7">
            <div class="card shadow">
                <div class="card-header">Recap</div>

                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Tot. appartamenti Sponsorizzati :</strong> ???? </li>

                        @foreach ($apartmentsCount as $label => $value )
                            <li class="list-group-item"><strong>Tot. {{ $label}} :</strong> {{ $value }}</li>
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
</div>
@endsection
