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

    },
    mounted(){
        console.log('apartment page!')
    }
}
</script>

<template>
    <div class="apartment_container container py-5" id="apartment-page">

      <div class="card" style="width: 22rem; ">
        <div class="">
                <h4>{{ apartment.name }}</h4>
                <p class="card-text m-0"><b>{{ apartment.address }}</b></p>
                <span><i class="fa-solid fa-star"></i> 5,0</span>
          </div>

        <!-- Immagine -->
        <img :src="'storage/' + apartment.cover_image" class="card-img-top" alt="" style="width: 22rem;">

        <!-- Testo -->
        <div class="card-body">
            <p class="card-text m-0">{{ apartment.description }}</p>
            <p class="card-text m-0"><b>{{ apartment.price }} €</b> a notte</p>

        </div>
      </div>

    </div>
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
