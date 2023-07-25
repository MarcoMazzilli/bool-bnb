<script>
import {store} from '../../data/store';
import axios from 'axios';
import {advancedSearch, convertAddress} from'../function/basicCall';
export default {
  name: 'InputSearch',
  data(){
    return{
      apiKey: store.apiKey,
      indirizzo: '',
      // --------------------------
      autocomplete:'cerca',
    }
  },
  methods :{

    search(){
    store.advSrcRequest.address = this.indirizzo;
    console.log(store.TomtomBaseUrl + store.apiUrlSearchAddress + convertAddress(this.indirizzo) + store.queryType + this.apiKey);
    // -------- chiamata centratura mappa
      axios.get(store.TomtomBaseUrl + store.apiUrlSearchAddress + convertAddress(this.indirizzo) + store.queryType + store.apiKey)
      .then(result =>{
        store.mapCoord = [result.data.results[0].position.lon, result.data.results[0].position.lat];
        console.log('store.mapCoord', store.mapCoord);
        advancedSearch();
        this.$router.push({ name: 'advancedSearch' });
      })
      .catch(function (error) {
        console.warn(error);
      })
    },
  },

  mounted(){

  }

}
</script>

<template>
    <div class="container g-1">

        <div class="input-group g-0" id="" >
          <input @keypress.enter="search()"
          id="via" v-model="indirizzo"
          type="text"
          class="form-control"
          placeholder="Cerca dove vorresti andare"
          >
          <span @click="search()"
          class="input-group-text search"
          >
            <i class="fa-solid fa-magnifying-glass"></i>
          </span>
        </div>

    </div>
</template>

<style lang="scss" scoped>

@use '../../scss/var' as *;


</style>
