<script>
import { store } from '../../data/store';
import axios from 'axios';
import Jumbotron from '../components/jumbotron.vue';
import Destinations from '../components/destinations.vue';
import ApartmentCard from '../components/apartmentCard.vue';
import Apartment from './apartment.vue';
import { searchByRange } from '../function/basicCall';

import { Button } from 'bootstrap';
export default {
  name: 'Home',
  data() {
    return {
      store,
      load: false,
      selectedApartment: null,
      // Home apiCall results
      links : [],
    }
  },
  components: { Jumbotron, ApartmentCard, Apartment, Button, Destinations },
  methods: {

    getApartment() {
      this.load = false;

      axios.get(store.apiHostUrl + store.getTpartments)
        .then(result => {

          store.apartmentsGetted = result.data.apartments.data;

          this.load = true;
          this.links = result.data.apartments.links;
          console.log('risultati', result.data)
        })
    },

    Preset(){
      searchByRange(store.RomaRequest)

    },

    // oldGetApartment(){
    //       if(!store.homeStored){
    //         this.load = false;
    //           axios.get(store.apiHostUrl + store.getTpartments)
    //           .then(result =>{
    //               store.apartmentsGetted = result.data.apartments;
    //               console.log(store.apartmentsGetted);
    //               this.load = true;
    //               store.homeStored = true;
    //           });
    //       }else{this.load = true;}
    //     },

    navigateApartmentResults(url){
      axios.get(url)
        .then(result =>{
          store.apartmentsGetted = result.data.apartments.data;
      })
    },

    showApartmentDetails(apart) {
      // console.log(apart)
      store.apartmentDetails = apart
      this.$router.push({ name: 'apartment', params: { slug: apart.slug } });
    },
  },
  mounted() {
    // console.log('Home page!');
    this.getApartment();
  }
}
</script>

<template>
  <div class="home_container" id="home-page">

    <Jumbotron />

    <!-- TITOLO -->
    <div class="container py-3">
      <h1>Scopri i nostri appartamenti</h1>
    </div>
    <!-- /TITOLO -->

    <!-- BOTTONI NAVIGAZIONE  -->
    <div class="container nav-button text-end">

      <button class="btn btn-primary mm-btn-nav mx-1"
        v-for="link in links" :key="link"
        v-html="link.label"
        @click="navigateApartmentResults(link.url)">
      </button>

    </div>
    <!-- /BOTTONI NAVIGAZIONE  -->

    <!-- COMPONENTE CARD -->
    <div v-if="load" class="container d-flex flex-wrap justify-content-between">

      <ApartmentCard v-for="apart in store.apartmentsGetted"
      :key="apart.id"
      :apartmentData="apart"
      @apartmentSelected="showApartmentDetails(apart)"
      @click="showApartmentDetails(apart)"
      />

    </div>
    <!-- /COMPONENTE CARD -->

    <Destinations />

  </div>
</template>

<style lang="scss" scoped>
.mm-btn-nav{
  // HIDE FIRST AND LAST NAV-BUTTON
  &:first-of-type{
    display: none;
  }
  &:last-of-type{
    display: none;
  }
}
</style>
