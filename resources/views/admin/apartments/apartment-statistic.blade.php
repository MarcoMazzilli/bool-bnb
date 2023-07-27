@extends('layouts.app')

@section('content')
    <div class="container p-5">

        <h1>Statistiche</h1>

        <div class="row justify-content-center">

            <div class="col col-6">
              <label for="apartment" class="form-label">Filtra in base all'appartamento:</label>
              <select name="apartment" class="form-select" id="apartment">
                  @foreach ($apartments as $apartment)
                      <option value="{{ $apartment->id }}">
                          <span>{{ $apartment->name }}</span>
                      </option>
                  @endforeach
              </select>
          </div>

        </div>

    </div>
@endsection
