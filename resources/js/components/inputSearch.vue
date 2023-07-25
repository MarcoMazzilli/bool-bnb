<script>
import {store} from '../../data/store';
import axios from 'axios';
export default {
  name: 'InputSearch',
  data(){
    return{
      apiKey: store.apiKey,

      indirizzo: '',
      jsonLink: '',
      cordinates:{},
      // --------------------------
      autocomplete:'cerca',
    }
  },
  methods :{

    searchByRange(){
        store.load = false;
        let data = store.advSrcRequest;
        console.log(data);
        axios.post('http://127.0.0.1:8000/api/find/location', data)
        .then(result =>{
          console.log('risultato ===>',result);
          store.apartmentsfiltred = result.data.apartments.data;
          store.load = true;
          this.$router.push({ name: 'advancedSearch' });
        }).catch(error => {
          console.log('Errori ===>',error)
        })
      },

    getCordianates(){
    console.log(store.TomtomBaseUrl + store.apiUrlSearchAddress + this.convertAddress(this.indirizzo) + store.queryType + this.apiKey);

    // -------- chiamata
    axios.get(store.TomtomBaseUrl + store.apiUrlSearchAddress + this.convertAddress(this.indirizzo) + store.queryType + store.apiKey)
    .then(result =>{
      // console.log(result.data.results[0].position);
      store.advSrcRequest.cordinates = result.data.results[0].position;
      console.log(store.advSrcRequest.cordinates )
      store.advSrcRequest.longitude = store.advSrcRequest.cordinates.lon;
      store.advSrcRequest.latitude = store.advSrcRequest.cordinates.lat;
      console.log('store cord', store.cord )
      this.jsonLink = this.TomtomBaseUrl + this.apiUrlSearchAddress + this.convertAddress(this.indirizzo) + this.queryType + this.apiKey;
      this.searchByRange();

    })
    .catch(function (error) {
      // handle error
    console.warn(error);
    })
    .finally(function () {
     // always executed
    });
    },

    convertAddress(address){
    const converted = address.replace(/ /g,'%20') ;
    // console.log(converted);
    return converted;
    },
  },

  mounted(){

  }

}
</script>

<template>
    <div class="container g-1">

        <div class="input-group g-0" id="" >
          <input @keypress.enter="getCordianates()"
          id="via" v-model="indirizzo"
          type="text"
          class="form-control"
          placeholder="Cerca dove vorresti andare"
          >
          <span @click="getCordianates()"
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
