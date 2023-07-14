@extends('layouts.app')

@section('content')

<div class="container p-5">

  <h3 class="mb-3">Aggiungi nuovo appartamento</h3>

    <form action="#" method="POST" enctype="multipart/form-data">
      @csrf
      @method($method)

      <form>
        <div class="mb-3">
          <label for="title" class="form-label">Titolo appartamento</label>
          <input
            id="name"
            name='name'
            value=""
            class="form-control"
            placeholder="Nome appartamento"
            type="text"
          >
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Descrizione appartamento</label>
          <input
            id="description"
            name='description'
            value=""
            class="form-control"
            placeholder="Descrizione appartamento"
            type="text"
          >
        </div>


        <div class="mb-3">
          <label for="address" class="form-label">Indirizzo appartamento</label>
          <input
            id="address"
            name='address'
            value=""
            class="form-control"
            placeholder="Indirizzo appartamento"
            type="text"
          >
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Info aggiuntive indirizzo</label>
          <input
            id="address_info"
            name='address_info'
            value=""
            class="form-control"
            placeholder="Info indirizzo appartamento"
            type="text"
          >
        </div>

        <div class="mb-3">

            <p class="form-label">Servizi offerti</p>

            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

              <input
                          id="services"
                          class="btn-check"
                          autocomplete="off"
                          type="checkbox"
                          value=""
                          name="services"
              >

          </div>
        </div>


        <div class="mb-3">
          <label for="cover_image" class="form-label">Cover appartamento</label>
          <input
            id="cover_image"
            name='cover_image'
            value=""
            class="form-control"
            placeholder="immagine appartamento"
            type="file"
          >
        </div>


        <button type="submit" class="btn btn-success">Invia</button>
      </form>

    </form>

</div>

@endsection
