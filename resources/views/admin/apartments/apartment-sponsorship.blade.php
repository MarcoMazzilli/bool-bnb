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
                <option value="{{ $apartment->id}}">
                  <span >{{ $apartment->name }}</span>
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
                <option value="{{ $sponsor->id}}">
                  <span class="text-uppercase">{{ $sponsor->duration }} h.</span>
                </option>
                @endforeach
              </select>
            </div>
            {{-- /SELEZIONE DELLO SPONSOR --}}

            {{-- VISUALIZZAZIONE PREZZO --}}
            <div class="col col-3">
              <label for="sponsorship-price" class="form-label">Prezzo :</label>
              <input class="form-control" type="text" value="" aria-label="readonly input example" readonly>
            </div>
            {{-- /VISUALIZZAZIONE PREZZO --}}

            {{-- DATA INIZIO SPONSORIZZATA --}}
            <div class="row">
              <div class="col col-6">
                <label for="sponsorship" class="form-label">Data di inizio sponsorizzata</label>
                <input type="date" class="form-select" name="date" >
              </div>
            </div>
            {{-- /DATA INIZIO SPONSORIZZATA --}}

            <P>A cosa mi serve???? a dare un nome alla scelta fatta dll'utente, un prezzo per effettuare il pagamento, e una
              durata</P>
              <p>posso mettere un input di tipo date() che valorizza l'effettiva data di inizio sponsorizzazione , permettendo
                quindi di pagare oggi ma far partire la sponsorizzata quando voglio.</p>
                <p>a questo punto il metodo di pagamento...solol se ricevo esito positivo dal metodo di pagamento submitto il
                  form.
                  (questo richede un controllo serio! non baypassabile in alcun modo)</p>





                  <button type="submit">Procedi al pagamento</button>

                </form>
              </div>
            </div>
            @endsection
