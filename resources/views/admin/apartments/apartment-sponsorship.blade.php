@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <div class="row">

            <h1>Sponsorizza un appartamento</h1>

            <div class="col col-6">
                <label for="apartment" class="form-label">Seleziona un appartamento</label>
                <select name="apartment" class="form-select" id="apartment">
                    @foreach ($apartments as $apartment)
                        <option value="#####">
                          <span >{{ $apartment->name }}</span>
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col col-3">
              <label for="sponsorship" class="form-label">Seleziona la durata</label>
              <select name="sponsorship" class="form-select">
                @foreach ($sponsorships as $sponsor)
                <option value="#####">
                  <span class="text-uppercase">{{ $sponsor->duration }} h.</span>
                </option>
                @endforeach
              </select>
            </div>

            <div class="col col-3">
              <label for="sponsorship" class="form-label">Prezzo della sponsorizzazione</label>
              <input class="form-control" type="text" value="Inner HTML DI JS" aria-label="readonly input example" readonly>
            </div>

            <div class="row">
              <div class="col col-6">
                <label for="sponsorship" class="form-label">Data di inizio sponsorizzata</label>
                <input type="date" class="form-select" >
              </div>
            </div>
            <P>A cosa mi serve???? a dare un nome alla scelta fatta dll'utente, un prezzo per effettuare il pagamento, e una
                durata</P>
            <p>posso mettere un input di tipo date() che valorizza l'effettiva data di inizio sponsorizzazione , permettendo
                quindi di pagare oggi ma far partire la sponsorizzata quando voglio.</p>
            <p>a questo punto il metodo di pagamento...solol se ricevo esito positivo dal metodo di pagamento submitto il
                form.
                (questo richede un controllo serio! non baypassabile in alcun modo)</p>






        </div>
    </div>
@endsection
