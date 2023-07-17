@extends('layouts.app')

@section('content')

<div class="container p-5">

  <h3 class="mb-3">Modifica appartamento</h3>

    <form action="{{ route('admin.apartments.update', $apartment) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <form>
        <div class="mb-3">
          <label for="title" class="form-label">Nome</label>
          <input
            id="name"
            name='name'
            value="{{ old('name', $apartment?->name) }}"
            class="form-control"
            placeholder="Nome appartamento"
            type="text"
          >
        </div>

        <div class="mb-3">
          <label for="type" class="form-label">Tipologia</label>
          <input
            id="type"
            name='type'
            value="{{ old('type', $apartment?->type) }}"
            class="form-control"
            placeholder="Monolocale, trilocale, villetta..."
            type="text"
          >
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Descrizione</label>
          <input
            id="description"
            name='description'
            value="{{ old('description', $apartment?->description) }}"
            class="form-control"
            placeholder="Descrizione appartamento"
            type="text"
          >
        </div>



        <div class="mb-3 d-flex">

          <section class="me-3">
            <label for="address" class="form-label">Metri quadri</label>
            <input
              id="apartment_size"
              name='apartment_size'
              value="{{ old('apartment_size', $apartment?->apartment_size) }}"
              class="form-control"
              placeholder="Metri quadri"
              type="text"
            >
          </section>

          <section class="me-3">
              <label for="address" class="form-label">Numero di camere</label>
              <input
                id="n_of_room"
                name='n_of_room'
                value="{{ old('n_of_room', $apartment?->n_of_room) }}"
                class="form-control"
                placeholder="Numero di camere"
                type="text"
              >
          </section>

          <section class="me-3">
              <label for="address" class="form-label">Numero di letti</label>
              <input
                id="n_of_bed"
                name='n_of_bed'
                value="{{ old('n_of_bed', $apartment?->n_of_bed) }}"
                class="form-control"
                placeholder="Numero di letti"
                type="text"
              >
          </section>

          <section class="me-3">
              <label for="address" class="form-label">Numero di bagni</label>
              <input
                id="n_of_bathroom"
                name='n_of_bathroom'
                value="{{ old('n_of_bathroom', $apartment?->n_of_bathroom) }}"
                class="form-control"
                placeholder="Numero di bagni"
                type="text"
              >
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
          <label for="address" class="form-label">Informazioni aggiuntive indirizzo</label>
          <input
            id="address_info"
            name='address_info'
            value="{{ old('address_info', $apartment?->address_info) }}"
            class="form-control"
            placeholder="Informazioni aggiuntive sull'indirizzo"
            type="text"
          >
        </div>

        <div class="mb-3">
          <label for="visible" class="form-label"></label>

          <select name="visible" id="visible">
            <option value=1> visibile</option>
            <option value=0 > non visibile</option>
          </select>

        </div>

        <div class="mb-3">

            <p class="form-label">Servizi offerti</p>

            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

              <div class="form-check me-3">
                <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckDefault"
                name="services">
                <label class="form-check-label" for="flexCheckDefault">
                  Default checkbox
                </label>
              </div>

              <div class="form-check">
                <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckChecked"
                checked>
                <label class="form-check-label" for="flexCheckChecked">
                  Checked checkbox
                </label>
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


        <button type="submit" class="btn btn-success">Invia</button>
      </form>

    </form>

</div>

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
      value: '{{ old('address', $apartment?->address) }}',
      className: 'form-control' + ' ' + 'tt-search-box-input',
      placeholder: 'inserisci indirizzo',
      type: 'text'
    });
    // console.log(inputElement);
  </script>

@endsection
