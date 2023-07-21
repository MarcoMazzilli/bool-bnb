<script>
import {store} from '../../data/store';
import axios from 'axios';
import Jumbotron from '../components/jumbotron.vue';
import ApartmentCard from '../components/apartmentCard.vue';
import Apartment from './apartment.vue';

export default {
    name: 'Home',
    data(){
        return{
          store,
          load: false,
        }
    },

    components:{Jumbotron, ApartmentCard, Apartment },

    methods :{

        getApartment(){
          this.load = false;
            axios.get(store.apiHostUrl + store.getTpartments)
            .then(result =>{
                // console.log(result.data.apartments);
                store.apartmentsGetted = result.data.apartments;
                console.log(store.apartmentsGetted);
                this.load = true;
            })
        },

    },
    mounted(){
        console.log('Home page!');
        this.getApartment();
    }
}
</script>

<template>
  <div class="home_container" id="home-page">
    <Jumbotron />

    <div v-if="load" class="container py-5 d-flex flex-wrap justify-content-between">

      <ApartmentCard v-for="apart in store.apartmentsGetted" :key="apart.id"
      :apartmentData="apart"
      />

    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>
