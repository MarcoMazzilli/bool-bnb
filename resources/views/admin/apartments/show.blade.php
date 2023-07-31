@extends('layouts.app')

@section('content')
    <div class="container p-5">

        <div class="title d-flex justify-content-between align-items-center">
            <h1 class="">{{ $apartment->name }}</h1>

            <div class="btn">

              {{-- TODO: il bottone che rende visibile non funziona --}}
                {{-- @include('admin.partials.form-visible', [
                    'title' => 'Modifica',
                    'apartment' => $apartment,
                    'route' => route('admin.apartments.update', $apartment),
                ]) --}}

                <a title="Modifica" href="{{ route('admin.apartments.edit', $apartment) }}"
                    class="btn btn-outline-secondary">
                    <span class="d-none d-xl-inline-block">Modifica</span>
                    <i class="fa-solid fa-pencil d-xl-none"></i>
                </a>

                @include('admin.partials.form-delete',[
                    'title'=>'Eliminazione Post',
                    'id'=> $apartment->id,
                    'message'=> "Confermi l'eliminazione del appartamento $apartment->name",
                    'route' => route('admin.apartments.destroy', $apartment)
                ])
            </div>
        </div>

        <div class="image d-flex mt-4">
            {{-- <img class="w-50" src={{ $apartment['cover_image'] }}  alt="" > --}}
            <img src="{{ asset('storage/' . $apartment->cover_image) }}" alt="" style="width: 500px">
        </div>

        <div class="row row-cols-1">

          <div class="col col-md-8">
            <div class="description mt-4">
                <h5>{{ $apartment->description }} ( {{ $apartment->type }} )</h5>
            </div>

            <div class="n_of_services">
              {{-- TODO: cambiare le icone  --}}
                <span>
                  <i class="fa-solid fa-house"></i> {{ $apartment->n_of_room }} Camere ·
                  <i class="fa-solid fa-bed"></i> {{ $apartment->n_of_bed }} Letti ·
                  <i class="fa-solid fa-shower"></i> {{ $apartment->n_of_bathroom }} Bagni ·
                  {{ $apartment->apartment_size }} m²
                </span>
            </div>
          </div>

          <div class="col col-md-4 mt-4">
            <h5>Prezzo</h5>
            <p>&euro; {{ $apartment->price }}</p>
          </div>

        </div>



        <div class="extra-services mt-4">
            <h5>Servizi offerti:</h5>
            @forelse ($apartment->services as $service )
            <span class="badge">{{ $service->name }}</span></h5>
            @empty
            <span class="badge">Nessun servizio aggiunto</span></h5>
            @endforelse
        </div>

        <div class="coordinate my-4">
            <h5>Indirizzo appartamento</h5>
            <span>{{ $apartment->address }}</span>
        </div>

    </div>
@endsection
