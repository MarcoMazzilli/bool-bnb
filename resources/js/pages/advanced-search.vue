<script>
import {store} from '../../data/store';
import axios from 'axios';
import ApartmentCard from '../components/apartmentCard.vue';
export default {
    name: 'AdvancedSearch',
    data(){
        return{
          store,
        }
    },

    components:{ApartmentCard},

    methods :{},

    mounted(){
        console.log('Advanced Search!');
    }
}
</script>

<template>
    <div class="AdvancedSearch_container" id="AdvancedSearch-page">

        <h1>Advanced Search</h1>


        <div v-if="load" class="container py-5 d-flex flex-wrap justify-content-between">

          <ApartmentCard v-for="apart in store.apartmentsfiltred" :key="apart.id"
          :apartmentData="apart"
          />

        </div>

    </div>
</template>

<style lang="scss" scoped>

</style>
