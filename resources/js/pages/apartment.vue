<script>
import {store} from '../../data/store';
import axios from 'axios';

export default {
    name: 'Apartment',

    data(){
        return{
          apartment : store.apartmentDetails,
          name: "",
          lastname: "",
          email: "",
          mainText: "",
        }
    },
    components:{},
    methods :{
      getImage(img){
        return new URL ()
      }
    },
    mounted(){
        console.log('apartment page!')
    }
}
</script>

<template>
    <div class="container py-3" id="apartment-page">

      <!--Titolo -->
      <div class="">
        <h4>{{ apartment.name }}</h4>
        <span><i class="fa-solid fa-star"></i> 5,0</span>
        <span class="card-text mx-2"><b>{{ apartment.address }}</b></span>
      </div>

      <div class="row">

        <!-- Immagine -->
        <div class="col col-5">

          <div class="swiper py-3">

            <img :src="'/storage/' + apartment.cover_image" alt="">

          </div>
        </div>

        <!-- mappa -->
        <div class="col col-7 bg-warning">
          <div id="mountMap" class="">
              <div class="map" id="map" ref="mapRef">MAPPA</div>
          </div>
        </div>

      </div>

      <!-- Testo -->
      <div class="info py-4">

        <div v-show="apartment.address_info">

          <h5>Come raggiungere l'indirizzo</h5>
          <div class="alert alert-info" role="alert">
            {{ apartment.address_info }}
          </div>

        </div>

        <div class="row row-cols-2 row-cols-md-3 py-2">
          <div class="col my-2 ">
            Tipologia: {{ apartment.type }} <i class="fa-solid fa-house"></i>
          </div>
          <!-- <div class="col my-2">
            Descrizione: {{ apartment.description }}
          </div> -->
          <div class="col my-2">
            Grendezza del locale: {{ apartment.apartment_size }} m2
          </div>
          <div class="col my-2">
            Numeri di letti: {{ apartment.n_of_bed }} <i class="fa-solid fa-bed"></i>
          </div>
          <div class="col my-2">
            Camere: {{ apartment.n_of_room }}
          </div>
          <div class="col my-2">
            Numeri di bagni: {{ apartment.n_of_bathroom }} <i class="fa-solid fa-bath"></i>
          </div>
          <div class="col my-2">
            Prezzo: <b>{{ apartment.price }} €</b> a notte
          </div>
        </div>
      </div>

      <div class="alert alert-primary w-50 w-25" role="alert">
        Contatta l'host
      </div>

      <form class="row">

        <div class="col col-4 mb-3">
          <label for="name" class="form-label">Nome</label>
          <input v-model="name" type="text" class="form-control" id="name" placeholder="Inserisci il nome">
        </div>
        <div class="col col-4 mb-3">
          <label for="lastname" class="form-label">Cognome</label>
          <input v-model="lastname" type="text" class="form-control" id="lastname" placeholder="Inserisci il cognome">
        </div>
        <div class="col col-4 mb-3">
          <label for="email" class="form-label">Indirizzo email</label>
          <input v-model="email" type="email" class="form-control" id="email" placeholder="Inserisci la tua email">
        </div>
        <div class="mb-3">
          <label for="main-text" class="form-label">Messaggio</label>
          <textarea v-model="mainText" class="form-control" placeholder="Inserisci un messaggio" id="main-text" rows="3"></textarea>
        </div>

        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3">Invia</button>
        </div>
      </form>

    </div>
</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

img{
    border-radius: 10px;
    height: 300px;
    width: 400px;
}

</style>
