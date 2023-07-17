@extends('layouts.app')

@section('content')
    <div class="container p-5">

        <div class="title d-flex justify-content-between align-items-center">
            <h1 class="">{{ $apartment->name }}</h1>

            <div class="btn">
                <a href="{{route('admin.apartments.edit', $apartment)}}" class="btn btn-outline-secondary">Modifica</a>
                @include('admin.partials.form-delete',[
                    'title'=>'Eliminazione Post',
                    'id'=> $apartment->id,
                    'message'=> "Confermi l'eliminazione del appartamento $apartment->name",
                    'route' => route('admin.apartments.destroy', $apartment)
                ])
            </div>
        </div>

        <div class="address">
            <span>{{ $apartment->address }}</span> <br> <span>{{ $apartment->visible }}</span>
        </div>

        <div class="image d-flex justify-content-center m-5">
            {{-- <img class="w-50" src={{ $apartment['cover_image'] }}  alt="" > --}}
            <img src="{{ asset('storage/' . $apartment->cover_image) }}" alt="" style="width: 500px">
        </div>


        <div class="description">
            <h5>{{ $apartment->description }} ( {{ $apartment->type }} )</h5>
        </div>

        <div class="n_of_services">
            <span> {{ $apartment->n_of_room }} camere · {{ $apartment->n_of_bed }} letti · {{ $apartment->n_of_bathroom }}
                Bagni</span>
        </div>

        <div class="extra services mt-4">
            <h5>Cosa troverai:</h5>
            <span class="badge bg-secondary">New</span></h5>
            {{-- <span>{{ $apartment->services }}</span> --}}
        </div>

        <div class="coordinate mt-4">
            <h5>Dove ti troverai</h5>
            <span>{{ $apartment->address }}</span>
            <div>MAPPA</div>
        </div>

    </div>
@endsection
