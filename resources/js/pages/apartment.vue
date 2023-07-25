<script>
import {store} from '../../data/store';
import axios from 'axios';

export default {
    name: 'Apartment',

    data(){
        return{
          apartment : store.apartmentDetails
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
        <div class="col col-7 ">

          <div class="swiper py-3">

            <img :src="'/storage/' + apartment.cover_image" alt="">

          </div>
        </div>

        <!-- mappa -->
        <div class="col col-5">

          <!-- da mettere sotto -->

          <div id="mountMap" class="bg-info">
              <!-- <div class="map" id="map" ref="mapRef">MAPPA</div> -->
          </div>
        </div>

      </div>

      <!-- Testo -->
      <div class="info">
          <p class="">{{ apartment.description }}</p>
          <p class=""><b>{{ apartment.price }} €</b> a notte</p>
      </div>

      <div class="">
        <form action="">

          <!-- nome, cognome, email.messaggio -->

          <label for="descrizione" class="form-label">Invia un messaggio</label>
          <textarea
            name="description"
            id="description"
            class="form-control"
            placeholder="Inserisci un messaggio"
            cols="30"
            rows="10"></textarea>

        </form>
      </div>

    </div>
</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

img{
    border-radius: 10px;
    height: 300px;
    width: 500px;
}

</style>
