<script>
import {store} from '../../data/store';
import axios from 'axios';
export default {
  name: 'Header',
  methods :{

    searchApartment(){
        console.log('CERCA!')

        // axios.get()
        // .then(result =>{
        // console.log(result.data)


        // --------------------------------------------------------------------------------------------------------
        // metodo fornito da vue per spostarsi tra le rotte del router!!!
        //  this.$router.push('/indirizzo')
        // this.$router.push('nome indirizzo');
        // this.$router.push({ nome: 'nomerotta',  params:{ slug: 'apartamentSlug'} }); mandando oggetto e parametri

        this.$router.push({ name: 'advancedSearch' });
        // ------------------------------------------------------------------------------------------------------



        // })
    },

    getAddres(){
      console.log('address di ricerca');
    },
  },
  mounted(){
    console.log(store.ttKey);
    //  autocomplete seach bar tomtom script ---------------------------------------/
    const options = {
            searchOptions: {
                key: import.meta.env.API_TT_KEY,
                language: "it-IT",
                limit: 5,
            },

            autocompleteOptions: {
                key: import.meta.env.API_TT_KEY,
                language: "it-IT",
            },
        }

        const ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
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
            value: '',
            className: 'form-control' + ' ' + 'tt-search-box-input',
            placeholder: 'Indirizzo appartamento',
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

            console.warn('indirizzo forzato :', replaceAddres);
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
  }

}

</script>

<template>
  <header>
    <div class="container h-100">

      <div class="row d-flex align-items-center h-100">

        <div class="col col-2 d-none d-sm-block h-100">
          <a href="/" class="h-100 logo">
            <img class="h-100" src="/img/boolbnb-sfondo-trasparente.png" alt="">
          </a>
        </div>

        <div class="col col-11 col-sm-9 col-lg-8">


            <div class="input-group flex-nowrap " id="autocomplete" >
              <input @keypress.enter="getAddres()"
              type="text"
              class="form-control"
              placeholder="Cerca per indirizzo"
              aria-label="Username"
              aria-describedby="addon-wrapping">

              <span @click="searchApartment()"
              class="input-group-text search"
              id="addon-wrapping"

              >
                <i class="fa-solid fa-magnifying-glass"></i>
              </span>
            </div>


        </div>

        <!-- TODO: sistemare l'icona quando è in mobile (va leggerente  sinistra)-->

        <div class="col col-1 d-lg-none ">

          <div class="dropdown">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/login">Login</a></li>
              <li><a class="dropdown-item" href="/register">Register</a></li>
            </ul>
          </div>

        </div>


        <div class="col col-2 d-none d-lg-block user">
          <a class="me-2" href="/login">Login</a>
          <a href="/register">Register</a>
        </div>

      </div>
    </div>

  </header>
</template>



<style lang="scss" scoped>

@use '../../scss/var' as *;

header{
  // background-color: $low-black;
  box-shadow: 0 2px 2px rgba($color: #000000, $alpha: .1);
  height: 50px;

  span.search{
    background-color: white;
    transition: all .3s;
    i{
      transition: all .3s;
      color: $brand-main;

    }
    &:hover{
    background-color: $brand-main;
      i{
      color: $brand-blue;
      }
    }
  }

  .user{
    a{
      color: $brand-blue;
      text-decoration: none;
      &:hover{
        text-decoration: underline;
      }
    }
  }
}


</style>
