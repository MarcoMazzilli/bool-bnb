@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="text-secondary my-4">Benvenuto {{ Auth::user()->name }} {{ Auth::user()->last_name }} </h2>

    <div class="row justify-content-between">
        <div class="col col-7">
            <div class="card shadow">
                <div class="card-header">Recap</div>

                <div class="card-body">

                    <div>
                        <span class="title fw-bold">Tot. appartamenti :</span><span class="result"> Da inserire la variabile ricevuta tramite una query </span> <hr>
                    </div>
                    <div>
                        <span class="title fw-bold">Tot. appartamenti Sponsorizzati :</span><span class="result"> Da inserire la variabile </span> <hr>
                    </div>
                    <div>
                        <span class="title fw-bold">Tot. appartamenti visibili :</span><span class="result"> Da inserire la variabile </span> <hr>
                    </div>
                    <div>
                        <span class="title fw-bold">Tot. appartamenti nascosti :</span><span class="result"> Da inserire la variabile </span>
                    </div>

                </div>
            </div>
        </div>
        <div class="col col-3">
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
