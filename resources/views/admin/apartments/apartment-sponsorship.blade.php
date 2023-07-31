@extends('layouts.app')

@section('content')
    <div class="container mb-5 pe-5">
        <div class="row">

            <div class="description my-2">
                <h1 class="py-3">Sponsorizza un appartamento</h1>
                <p>Le sponsorizzazioni offrono un opportunità unica per aumentare l'esposizione del tuo appartamento sul
                    nostro sito.</p>
                <p>Ogni pacchetto ha una durata diversa, che indica quanto tempo la stanza sarà in evidenza e ben visibile
                    sulla piattaforma, ottenendo una maggiore visibilità rispetto alle altre stanze non sponsorizzate.</p>
            </div>

            <form action="{{ route('sponsorship.request') }}" method="POST">
              @csrf

              {{-- SELEZIONE DELL'APPARTAMENTO --}}
              <div class="col-12 col-md-6">
                <label for="apartment" class="form-label">Seleziona un appartamento</label>
                <select name="apartment" class="form-select" id="apartment">
                  @foreach ($apartments as $apartment)
                  <option id="apartmentSelected" value="{{ $apartment->id }}">
                    <span>{{ $apartment->name }}</span>
                  </option>
                  @endforeach
                </select>
              </div>
              <small>(Se il tuo appartamento è nascosto, questa operazione lo renderà automaticamente visibile)</small>
                {{-- /SELEZIONE DELL'APPARTAMENTO --}}

                {{-- SELEZIONE DELLO SPONSOR --}}
                <div class="row">

                    @foreach ($sponsorships as $sponsor)
                        <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center gap-lg-5 py-3 py-lg-5">
                            <input type="radio" class="btn-check" name="sponsor" id="{{ $sponsor->id }}"
                                value="{{ $sponsor->id }}" checked>
                            <label class="btn shadow" for="{{ $sponsor->id }}">

                                <div class="card border-0" id="SponsorId">
                                    <div class="card-body">
                                        <h4>{{ $sponsor->name }}</h4>
                                        <p>Scopri i vantaggi di sponsorizzare il tuo appartamento!</p>
                                        <p class="card-text">{{ $sponsor->description }}</p>
                                        <span><strong>Prezzo:</strong> &euro; {{ $sponsor->price }}</span>
                                    </div>
                                </div>

                            </label>
                        </div>
                    @endforeach
                </div>
                {{-- /SELEZIONE DELLO SPONSOR --}}


                {{-- DATA INIZIO SPONSORIZZATA --}}
                <div class="row">

                    <div class="col-12 col-md-6">
                        <label for="sponsorship" class="form-label">Data di inizio sponsorizzata</label><br>
                        <small>(Se non inserisci nessuna data d'inizio la sponsorizzata partirà subito)</small>

                        <input type="date" class="form-select" name="date" id="startDate">
                    </div>
                </div>
                {{-- /DATA INIZIO SPONSORIZZATA --}}
                <div class=" my-3 text-center text-md-start">
                  <button class="btn mvm-button" type="submit">Procedi al pagamento</button>
                </div>

            </form>
        </div>
    </div>
    <script>
        let inputstartingDate = document.getElementById('startDate')
        const date = new Date();
        let day = date.getDate();
        let month = date.getMonth();
        let year = date.getFullYear();
        // let currentDate = `${day}-${month}-${year}`
        let currentDate = new Date(year, month, day)

        function swithClass(condition, input) {
            if (condition) {
                input.classList.remove('is-invalid')
                input.classList.add('is-valid')
            } else {
                input.classList.remove('is-valid')
                input.classList.add('is-invalid')
            }
        }
        inputstartingDate.addEventListener('change', () => {

            let startingDate = new Date(inputstartingDate.value);

            if (startingDate >= currentDate) {
                console.log('verde')
                inputstartingDate.classList.remove('is-invalid')
                inputstartingDate.classList.add('is-valid')
            } else {
                console.log('rosso')
                inputstartingDate.classList.remove('is-valid')
                inputstartingDate.classList.add('is-invalid')
            }
        });
    </script>
@endsection
