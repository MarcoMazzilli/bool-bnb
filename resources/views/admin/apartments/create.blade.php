@extends('layouts.app')

@section('content')

<div class="container p-5">

  <h3 class="mb-3">Aggiungi nuovo appartamento</h3>


  {{-- Gestione degli errori --}}
  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      {{-- @dump($errors->all); --}}
    </div>
  @endif

    <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      {{-- @method($method) --}}


        <div class="mb-3">
          <label for="title" class="form-label">Nome</label>
          <input
            id="name"
            name='name'
            value=""
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Nome appartamento"
            type="text"
          >

            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
          <label for="type" class="form-label">Tipologia</label>
          <input
            id="type"
            name='type'
            value=""
            class="form-control @error('type') is-invalid @enderror"
            placeholder="Monolocale, trilocale, villetta..."
            type="text"
          >


            @error('type')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Descrizione</label>
          <input
            id="description"
            name='description'
            value=""
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Descrizione appartamento"
            type="text"
          >


            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>



        <div class="mb-3 d-flex">

          <section class="me-3">
            <label for="address" class="form-label">Metri quadri</label>
            <input
              id="apartment_size"
              name='apartment_size'
              value=""
              class="form-control @error('apartment_size') is-invalid @enderror"
              placeholder="Metri quadri"
              type="text"
            >


            @error('apartment_size')
                <p class="text-danger">{{ $message }}</p>
            @enderror
          </section>

          <section class="me-3">
              <label for="n_of_room" class="form-label">Numero di camere</label>
              <input
                id="n_of_room"
                name='n_of_room'
                value=""
                class="form-control @error('n_of_room') is-invalid @enderror"
                placeholder="Numero di camere"
                type="text"
              >

            @error('n_of_room')
                <p class="text-danger">{{ $message }}</p>
            @enderror
          </section>

          <section class="me-3">
              <label for="n_of_bed" class="form-label">Numero di letti</label>
              <input
                id="n_of_bed"
                name='n_of_bed'
                value=""
                class="form-control @error('n_of_bed') is-invalid @enderror"
                placeholder="Numero di letti"
                type="text"
              >
            @error('n_of_bed')
                <p class="text-danger">{{ $message }}</p>
            @enderror
          </section>

          <section class="me-3">
              <label for="n_of_bathroom" class="form-label">Numero di bagni</label>
              <input
                id="n_of_bathroom"
                name='n_of_bathroom'
                value=""
                class="form-control @error('n_of_bathroom') is-invalid @enderror"
                placeholder="Numero di bagni"
                type="text"
              >

            @error('n_of_bathroom')
                <p class="text-danger">{{ $message }}</p>
            @enderror
          </section>

        </div>


        <div class="mb-3" id="autocomplete">
          <label for="address" class="form-label">Indirizzo</label>
          {{-- <input
            id="address"
            name='address'
            value=""
            class="form-control"
            placeholder="Indirizzo appartamento"
            type="text"
          > --}}
        </div>

        <div class="mb-3">
            <label for="visible" class="form-label"></label>

            <select name="visible" id="visible">
              <option value=1> visibile</option>
              <option value=0 > non visibile</option>
            </select>

          </div>

        <div class="mb-3">
            <label for="address_info" class="form-label">Informazioni aggiuntive indirizzo</label>
            <input
                id="address_info"
                name='address_info'
                value=""
                class="form-control"
                placeholder="Informazioni aggiuntive sull'indirizzo"
                type="text"
                >
        </div>

{{-- ----------------- servizi offerti       --}}
        <div class="mb-3">

            <p class="form-label">Servizi offerti</p>

            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">


                  <div class="my_btn_grp" role="group" aria-label="Basic checkbox toggle button group">
                  @foreach ($services as $service )

                  <input type="checkbox" class="btn-check" autocomplete="off" id="{{$service->name}}" name="services[]" value="{{$service->id}}">
                  <label class="btn btn-outline-primary m-1" for="{{$service->name}}">{{ $service->name }}</label>

                    @endforeach
                </div>

          </div>
        </div>


        <div class="mb-3">
          <label for="cover_image" class="form-label">Seleziona immagine di copertina</label>
          <input
            id="cover_image"
            name='cover_image'
            value=""
            class="form-control"
            placeholder="copertina"
            type="file"
          >
        </div>

        <div class="mb-3">
          <label for="image_description" class="form-label">Dai un nome all' immagine</label>
          <input
            id="image_description"
            name='image_description'
            value=""
            class="form-control"
            placeholder="copertina"
            type="text"
          >
        </div>


        <button type="submit" class="btn btn-success">Invia</button>


    </form>

</div>

{{-- autocomplete seach bar tomtom script --}}
<script>

    const options = {
      searchOptions: {
        key: "{{ env('API_TT_KEY') }}",
        language: "it-IT",
        limit: 5,
      },

      autocompleteOptions: {
        key: "{{ env('API_TT_KEY') }}",
        language: "it-IT",
      },
    }

    const ttSearchBox = new tt.plugins.SearchBox(tt.services, options)
    const searchBoxHTML = ttSearchBox.getSearchBoxHTML()
    const searchBoxContainer = document.getElementById('autocomplete');

    if (searchBoxContainer) {
        searchBoxContainer.appendChild(searchBoxHTML);
        // console.log(ttSearchBox);
    }
    const inputElement = document.querySelector('.tt-search-box-input');
    // console.log(inputElement);

    // attributi dell input
    Object.assign(inputElement, {
      id: 'address',
      name: 'address',
      value: '',
      className: 'form-control' + ' ' + 'tt-search-box-input',
      placeholder: 'Indirizzo appartamento',
      type: 'text'
    });
    // console.log(inputElement);
  </script>

@endsection
