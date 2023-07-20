<script>
import {store} from '../../data/store';
import axios from 'axios';
import ApartmentCard from '../components/apartmentCard.vue';
export default {
    name: 'AdvancedSearch',
    data(){
        return{
          store,
          load: true,
          selectedApartment: null,
        }
    },
    components:{ApartmentCard},
    methods :{
      // searchByRange(){
      //   this.load = false;
      //   let data = {
      //     longitude : store.cord[0],
      //     latitude : store.cord[1],
      //     radius : 200,
      //   }
      //   axios.post('http://127.0.0.1:8000/api/find', data)
      //   .then(result =>{
      //     console.log('risultato ===>',result.data.filteredApartments);
      //     store.apartmentsfiltred = result.data.filteredApartments;
      //     this.load = true;
      //   }).catch(error => {
      //     console.log('Errori ===>',error)
      //   })
      // }
    },
    mounted(){
        console.log('Advanced Search!');

        // this.searchByRange();
    }
}
</script>

<template>
    <div class="AdvancedSearch_container" id="AdvancedSearch-page">

        <h1>Advanced Search</h1>
        <!-- <button class="btn btn-danger" @click="searchByRange()">Console log</button> -->

        <div v-if="load" class="container py-5 d-flex flex-wrap justify-content-between">
          <ApartmentCard v-for="apart in store.apartmentsfiltred" :key="apart.id" :apartmentData="apart" @apartmentSelected="showApartmentDetails" />
        </div>

    </div>
</template>

<style lang="scss" scoped>

</style>
