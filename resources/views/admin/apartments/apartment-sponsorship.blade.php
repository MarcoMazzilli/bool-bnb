@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <h1 class="py-3">Sponsorizza un appartamento</h1>
            <form action="{{ route('sponsorship.request') }}" method="POST">
                @csrf

                {{-- SELEZIONE DELL'APPARTAMENTO --}}
                <div class="col col-6">
                    <label for="apartment" class="form-label">Seleziona un appartamento</label>
                    <select name="apartment" class="form-select" id="apartment">
                        @foreach ($apartments as $apartment)
                            <option id="apartmentSelected" value="{{ $apartment->id }}">
                                <span>{{ $apartment->name }}</span>
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- /SELEZIONE DELL'APPARTAMENTO --}}

                {{-- SELEZIONE DELLO SPONSOR --}}
                <div class="d-flex gap-5 py-5">
                    @foreach ($sponsorships as $sponsor)
                        <input type="radio" class="btn-check" name="sponsor" id="{{ $sponsor->id }}"
                            value="{{ $sponsor->id }}" selected>
                        <label class="btn shadow" for="{{ $sponsor->id }}">

                            <div class="card border-0" style="width: 18rem;" id="SponsorId">
                                <div class="card-body">
                                    <h4>{{ $sponsor->name }}</h4>
                                    <p>Scopri i vantaggi di sponsorizzare il tuo appartamento!</p>
                                    <p class="card-text">{{ $sponsor->description }}</p>
                                    <span><strong>Prezzo:</strong> &euro; {{ $sponsor->price }}</span>
                                </div>
                            </div>

                        </label>
                    @endforeach
                </div>
                {{-- /SELEZIONE DELLO SPONSOR --}}


                {{-- DATA INIZIO SPONSORIZZATA --}}
                <div class="row">
                    <div class="col col-6">
                        <label for="sponsorship" class="form-label">Data di inizio sponsorizzata</label>
                        <input type="date" class="form-select" name="date" id="startDate">
                    </div>
                </div>
                {{-- /DATA INIZIO SPONSORIZZATA --}}

                <button class="btn btn-primary my-3" type="submit">Procedi al pagamento</button>

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
            } else{
              console.log('rosso')
              inputstartingDate.classList.remove('is-valid')
              inputstartingDate.classList.add('is-invalid')
            }
        });

    </script>
@endsection
