<script>

// --------------------------------------------------------------------import
import tt from '@tomtom-international/web-sdk-maps';
import DrawingTools from '@tomtom-international/web-sdk-plugin-drawingtools';

import axios from 'axios';
import {store} from '../../data/store';
// function import basic calls
import {getCordianates,findServices,   searchByRange, getMarkers} from '../function/basicCall';
// import components
import ApartmentCard from '../components/apartmentCardSrc.vue';
import advSrcBar from '../components/advSrcBar.vue';
import inputSearch from '../components/inputSearch.vue';
import ResultSynthesis from '../components/resultSynthesis.vue';

export default {

    name: 'AdvancedSearch',
    data(){
        return{
          store,
          load:true,
          selectedApartment: null,
          advToggle: false,
          address: '',
          // Da valorizzare in fase di ricerca
          servicesToSearch: 1,

        }
    }, // close data

    components:{ApartmentCard, inputSearch, advSrcBar, ResultSynthesis}, // close components

    watch: {}, // close watch

    methods :{

      showApartmentDetails(apart) {
        // console.log(apart)
        store.apartmentDetails = apart
        this.$router.push({ name: 'apartment', params: { slug: apart.slug } });
      },

    }, // close methods

    mounted(){
      console.log('whereIam?', this.$route.name );
    } // close mounted
}
</script>

<template>

  <!-- <button @click="test()">test function</button> -->
    <div class="AdvancedSearch_container" id="AdvancedSearch-page">
      <!-- ---------------search-filter -----------------------------------------------\-->



      <!-- ---------------search-filter -----------------------------------------------/-->
      <advSrcBar />
      <inputSearch />
      <ResultSynthesis />
      <!-- ---------------result
        ------------------------------------------------------\-->


      <div v-if="store.load" class="container mt-3">

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
          <div v-for="apart in store.apartmentsfiltred" :key="apart.id" class="col d-flex justify-content-center">

            <ApartmentCard
            :apartmentData="apart"
            @apartmentSelected="showApartmentDetails(apart)"
            @click="showApartmentDetails(apart)"
            />

          </div>
        </div>

      </div>

      <!-- ---------------result ------------------------------------------------------/-->

  </div>
</template>

<style lang="scss" scoped>
@import '../../scss/var';



</style>
