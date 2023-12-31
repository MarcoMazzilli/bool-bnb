@extends('layouts.app')

@section('content')

<div class="container p-5">

    <h3 class="mb-3">Modifica appartamento</h3>

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

    <form action="{{ route('admin.apartments.update', $apartment) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row row-cols-1 row-cols-md-2 mb-3">

          <section class="col mb-3 mb-md-0">
            <label for="title" class="form-label">Nome*</label>
            <input
              id="name"
              name='name'
              value="{{ old('name', $apartment?->name) }}"
              class="form-control @error('name') is-invalid @enderror"
              placeholder="Nome appartamento"
              type="text"
            >

              @error('name')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </section>

          <section class="col">
            <label for="type" class="form-label">Tipologia*</label>
            <input
              id="type"
              name='type'
              value="{{ old('type', $apartment?->type) }}"
              class="form-control @error('type') is-invalid @enderror"
              placeholder="Monolocale, trilocale, villetta..."
              type="text"
            >


              @error('type')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </section>
      </div>



        <div class="mb-3">
          <label for="description" class="form-label">Descrizione</label>
          <input
            id="description"
            name='description'
            value="{{ old('description', $apartment?->description) }}"
            value=""
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Descrizione appartamento"
            type="text"
          >


            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>



        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3">

          <section class="col mb-3 mb-lg-0">
            <label for="apartment_size" class="form-label">Metri quadri*</label>
            <input
              id="apartment_size"
              name='apartment_size'
              value="{{ old('apartment_size', $apartment?->apartment_size) }}"
              class="form-control @error('apartment_size') is-invalid @enderror"
              placeholder="Metri quadri"
              type="text"
            >
            @error('apartment_size')
                <p class="text-danger">{{ $message }}</p>
            @enderror
          </section>

          <section class="col mb-3 mb-lg-0">
              <label for="n_of_room" class="form-label">Numero di camere*</label>
              <input
                id="n_of_room"
                name='n_of_room'
                value="{{ old('n_of_room', $apartment?->n_of_room) }}"
                class="form-control @error('n_of_room') is-invalid @enderror"
                placeholder="Numero di camere"
                type="text"
              >


            @error('n_of_room')
                <p class="text-danger">{{ $message }}</p>
            @enderror
          </section>

          <section class="col mb-3 mb-sm-0">
              <label for="n_of_bed" class="form-label">Numero di letti*</label>
              <input
                id="n_of_bed"
                name='n_of_bed'
                value="{{ old('n_of_bed', $apartment?->n_of_bed) }}"
                class="form-control @error('n_of_bed') is-invalid @enderror"
                placeholder="Numero di letti"
                type="text"
              >

                @error('n_of_bed')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
          </section>

          <section class="col mb-sm-0">
              <label for="n_of_bathroom" class="form-label">Numero di bagni*</label>
              <input
                id="n_of_bathroom"
                name='n_of_bathroom'
                value="{{ old('n_of_bathroom', $apartment?->n_of_bathroom) }}"
                class="form-control @error('n_of_bathroom') is-invalid @enderror"
                placeholder="Numero di bagni"
                type="text"
              >
                @error('n_of_bathroom')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
          </section>

        </div>

        <div class="row row-cols-1 mb-3">

            <div class="col col-lg-6 mb-3 mb-lg-0" id="autocomplete">
              <label for="address" class="form-label">Indirizzo*</label>
              {{-- <input
                id="address"
                name='address'
                value=""
                class="form-control"
                placeholder="Indirizzo appartamento"
                type="text"
              > --}}
            </div>

            <div class="col col-lg-3 mb-3 mb-lg-0">
                <label for="price" class="form-label">Prezzo*</label>
                <input id="price" name='price' value="{{ old('price', $apartment?->price) }}"
                    class="form-control @error('price') is-invalid @enderror" placeholder="Prezzo"
                    type="text">

                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col col-lg-3">
              <label for="visible" class="form-label">Apparamento visibile</label>

              <select name="visible" id="visible" class="form-select" aria-label="Default select example">
                <option value=1 {{ old('visible') == 1 ? 'selected' : '' }}> visibile</option>
                <option value=0 {{ old('visible') == 0 ? 'selected' : '' }}> non visibile</option>
              </select>

            </div>
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


{{-- ----------------- servizi offerti       --}}
<div class="mb-3">

    <p class="form-label">Servizi offerti</p>

    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">


          <div class="my_btn_grp" role="group" aria-label="Basic checkbox toggle button group">
          @foreach ($services as $service )

          <input
            type="checkbox"
            class="btn-check"
            autocomplete="off"
            id="{{$service->name}}"
            name="services[]"
            value="{{$service->id}}"

            @if (!$errors->any() && $apartment->services->contains($service))
            checked
            @elseif ($errors->any() && in_array($service->id, old('services', [])))
            checked
            @endif>

          <label class="btn btn-outline-primary m-1" for="{{$service->name}}">{{ $service->name }}</label>

            @endforeach
        </div>

  </div>
</div>


        <div class="mb-2">
          <label for="cover_image" class="form-label">Seleziona immagine di copertina</label>
          <input
            id="cover_image"
            name='cover_image'
            onchange="showImage(event)"
            value=""
            class="form-control"
            placeholder="copertina"
            type="file"
          >


          <img width="150" class="mt-3" id="prev-image" src="{{ asset('storage/' . $apartment?->cover_image) }}">
        </div>

        <div class="mb-3">
            <label for="image_description" class="form-label">Dai un nome all' immagine</label>
            <input
              id="image_description"
              name='image_description'
              value="{{ old('image_description', $apartment?->image_description) }}"
              class="form-control"
              placeholder="copertina"
              type="text"
            >
          </div>


        <button type="submit" class="btn btn-success">Invia</button>


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
    }
    const inputElement = document.querySelector('.tt-search-box-input');
    // attributi dell input
    Object.assign(inputElement, {
      id: 'address',
      name: 'address',
      value: '{{ old('address', $apartment?->address) }}',
      className: 'form-control' + ' ' + 'tt-search-box-input',
      placeholder: 'inserisci indirizzo',
      type: 'text'
    });


        // forzatura autocomplete
        inputElement.addEventListener('blur', function() {verify(inputElement);});

        function verify(inputElement) {
            console.log('valore lasciato',inputElement.value);
            const elements = document.querySelectorAll('.tt-search-box-result-list-bold');

            let replaceAddres;

            console.warn('first child',elements[2].firstChild.data);
            console.warn('next silibing',elements[2].nextSibling);

                if(elements[2].firstChild.data && elements[2].nextSibling ){
                    replaceAddres = elements[2].firstChild.data + ' ' + elements[2].nextSibling.data;
                    Object.assign(inputElement, {
                    value: replaceAddres });

                }else if(elements[2].firstChild.data){
                    replaceAddres = elements[2].firstChild.data;
                    Object.assign(inputElement, {
                    value: replaceAddres });
                }

            console.warn('indirizzo forzato :',replaceAddres);
            indirizzo = inputElement.value;
            getCordianates();
        };


        // verifica dell indirizzo
        const
            TomtomBaseUrl ='https://api.tomtom.com/',
            apiKey = "{{ env('API_TT_KEY') }}",
            apiUrlSearchAddress = 'search/2/geocode/',
            queryType = '.json?typeahead=false&limit=1&view=Unified&key=';
        let indirizzo = 'inserisci indirizzo';

        function convertAddress(address){
            const converted = address.replace(/ /g,'%20') ;
            console.log(converted);
            return converted;
        };
        // stampa json link del geocoding
        function   getCordianates(){
            console.log(TomtomBaseUrl + apiUrlSearchAddress + convertAddress(indirizzo) + queryType + apiKey);
        };


// ---------------------------------------------------------------------------


//Gestione anteprima immagine di copertina
        // ClassicEditor
        //     .create( document.querySelector( '#text' ) )
        //     .catch( error => {
        //         console.error( error );
        //     } );

        function showImage(event){
            const tagImage = document.getElementById('prev-image');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }

        function removeImage(){
            const imageInput = document.getElementById('image_description');
            imageInput.value = '';
            const tagImage = document.getElementById('prev-image');
            tagImage.src = '';
        }


        // CONTROLLI INPUT FORM ------------------------

        // DATA ------------------------

        const name = document.getElementById('name');
        const type = document.getElementById('type');
        const description = document.getElementById('description');
        const apartment_size = document.getElementById('apartment_size');
        const n_of_room = document.getElementById('n_of_room');
        const n_of_bed = document.getElementById('n_of_bed');
        const n_of_bathroom = document.getElementById('n_of_bathroom');
        const cover_image = document.getElementById('cover_image');

        //FUNCTION ------------------------

        function swithClass(condition,input){
          if(condition){
            input.classList.remove('is-invalid')
            input.classList.add('is-valid')
          }else{

            input.classList.remove('is-valid')
            input.classList.add('is-invalid')
          }
        }
        function errorSpecialCharacter(text){
            const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            return specialChars.test(text)
        }

        // EVENT ------------------------

        name.addEventListener('keyup',()=>{
          const condition = name.value.length >= 2 && !errorSpecialCharacter(name.value)
          console.log(condition)
          swithClass(condition, name)
        });

        type.addEventListener('keyup',()=>{swithClass(type.value.length >= 2, type)});

        description.addEventListener('keyup',()=>{
          swithClass(description.value.length >= 10, description)
        });

        apartment_size.addEventListener('keyup',()=>{
          const condition = apartment_size.value >= 15  && apartment_size.value <= 1000;
          swithClass(condition , apartment_size)
        });

        n_of_bed.addEventListener('keyup',()=>{
          const condition = n_of_bed.value >= 1  && n_of_bed.value <= 20;
          swithClass(condition , n_of_bed)
        });

        n_of_room.addEventListener('keyup',()=>{
          const condition = n_of_room.value >= 1  && n_of_room.value <= 10;
          swithClass(condition , n_of_room)
        });

        n_of_bathroom.addEventListener('keyup',()=>{
          const condition = n_of_bathroom.value >= 1  && n_of_bathroom.value <= 10;
          swithClass(condition , n_of_bathroom)
        })

</script>

@endsection
