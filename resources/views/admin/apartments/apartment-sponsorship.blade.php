@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <div class="row">

            <h1>Sponsorizza un appartamento</h1>
            <form action="{{ route('sponsorship.request') }}" method="POST">
                @csrf

                {{-- SELEZIONE DELL'APPARTAMENTO --}}
                <div class="col col-6">
                    <label for="apartment" class="form-label">Seleziona un appartamento</label>
                    <select name="apartment" class="form-select" id="apartment">
                        @foreach ($apartments as $apartment)
                            <option value="{{ $apartment->id }}">
                                <span>{{ $apartment->name }}</span>
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- /SELEZIONE DELL'APPARTAMENTO --}}

                {{-- SELEZIONE DELLO SPONSOR --}}
                <div class="col col-3">
                    <label for="sponsorship" class="form-label">Seleziona la durata</label>
                    <select name="sponsor" class="form-select">
                        @foreach ($sponsorships as $sponsor)
                            <option value="{{ $sponsor->id }}">
                                <span class="text-uppercase">Durata : {{ $sponsor->duration }}h. Prezzo: &euro; {{ $sponsor->duration }}</span>
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- /SELEZIONE DELLO SPONSOR --}}


                {{-- DATA INIZIO SPONSORIZZATA --}}
                <div class="row">
                    <div class="col col-6">
                        <label for="sponsorship" class="form-label">Data di inizio sponsorizzata</label>
                        <input type="date" class="form-select" name="date">
                    </div>
                </div>
                {{-- /DATA INIZIO SPONSORIZZATA --}}

                <button class="btn btn-primary my-3" type="submit">Procedi al pagamento</button>

            </form>
        </div>
    </div>
@endsection
