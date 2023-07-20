<script>
import {store} from '../../data/store';
import axios from 'axios';

export default {
    name: 'Apartment',

    data(){
        return{}
    },
    components:{},
    methods :{},
    mounted(){
        console.log('apartment page!')
    }
}
</script>

<template>
    <div class="apartment_container container py-5" id="apartment-page">

      <div class="card" style="width: 22rem; ">
        <div class="">
                <h4>Nome appartamento</h4>
                <p class="card-text m-0"><b>Indirizzo</b></p>
                <span><i class="fa-solid fa-star"></i> 5,0</span>
          </div>

        <!-- Immagine -->

        <img src="https://www.miprendoemiportovia.it/wp-content/uploads/2020/10/Casa-Nea-Sardegna.jpg" class="card-img-top mt-2" alt=""  style="width: 30rem;">

        <!-- <img :src=" 'storage/' + apartmentData.cover_image " class="card-img-top" alt=""  style="width: 22rem;"> -->

        <!-- Testo -->
        <div class="card-body">
            <p class="card-text m-0">Descrizione</p>
            <p class="card-text m-0"><b>Prezzo €</b> a notte</p>

        </div>

      </div>

    </div>


  <!-- <div class="apartment_container" id="apartment-page">
    <div v-if="selectedApartment" class="card m-2" style="width: 22rem;">

      <img :src="'storage/' + selectedApartment.cover_image" class="card-img-top" alt="" style="width: 22rem;" />


      <div class="card-body">
        <div class="d-flex justify-content-between">
          <h4>{{ selectedApartment.name }}</h4>
          <span><i class="fa-solid fa-star"></i> 5.0</span>
        </div>

        <p class="card-text m-0"><b>{{ selectedApartment.address }}</b></p>
        <p class="card-text m-0">{{ selectedApartment.description }}</p>
        <p class="card-text m-0"><b>{{ selectedApartment.price }}€</b> a notte</p>
      </div>
    </div>
  </div> -->


</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.card{
    border: none;

    .card-body{
        padding-left: 0;
        padding-right: 0;

        & h4{
          font-weight: bold;
        }
    }
}
img{
    border-radius: 10px;
    height: 300px;
    padding: 0;
}

</style>
