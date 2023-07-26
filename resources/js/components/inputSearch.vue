<script>
import {store} from '../../data/store';
import axios from 'axios';
import {advancedSearch, convertAddress} from'../function/basicCall';
export default {
  name: 'InputSearch',
  data(){
    return{
      store,
      apiKey: store.apiKey,
      indirizzo: '',
      // --------------------------
      autocomplete:'cerca',
    }
  },
  methods :{

    search(){
    if(this.indirizzo.trim() == ''){
      console.log('indirizzo vuoto');
      this.indirizzo = 'Roma';
    }

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

    updateAddress(){
      if(store.lastRequest){
      this.indirizzo =  store.lastRequest.address;
    }
    }
  },

  mounted(){

    if(this.$route.name == 'home'){
      this.indirizzo = ''
    }else{
      this.updateAddress();
    }
  }

}
</script>

<template>
    <div class="container g-1">

        <div class="input-group g-0" id="" >
          <input @keypress.enter="search()"
          v-if="store.advSrcRequest.type === 'adv'"
          id="via" v-model="indirizzo"
          type="text"
          class="form-control"
          placeholder="Cerca dove vorresti andare"
          >
          <span @click="search()"
          class="input-group-text search"
          :class="{
            'alone' : store.advSrcRequest.type === 'drv' || store.advSrcRequest.type === 'srv-only' ,
          }"
          >
            <i class="fa-solid fa-magnifying-glass"></i>
          </span>
        </div>

    </div>
</template>

<style lang="scss" scoped>

@use '../../scss/var' as *;

.alone{
  width: 100%;
  justify-content: center;

}

</style>
