<script>
import {store} from '../../data/store';
import axios from 'axios';
import {searchByRange} from '../function/basicCall';

export default {
  name: 'Destinations',
  data(){
    return{
      store,
    }
  },

  watch:{
    'store.lastRequest'(n,o){
      if(n != o){
        this.$router.push({ name: 'advancedSearch' });
      }
    }
  },

  methods: {
    makeRequest(request) {
      store.mapCoord = [request.longitude, request.latitude]; // centra la mappa
      searchByRange(request);
    }
  }
}
</script>

<template>

  <div class="container py-3 mb-4">

    <div class="title mb-4">
      <h1>Mete più richieste</h1>
      <span>Le scelte preferite dai viaggiatori dall'Italia</span>
    </div>

    <div class="row row-cols-1">

      <div class="col  col-md-6 mb-3">
        <div class="card" @click="makeRequest(store.RomaRequest)">
          <img src="storage/destinations-img/roma.jpg" class="card-img" alt="Roma">
          <span class="position-absolute top-0 start-0 text-white p-2"><h3>Roma</h3></span>
        </div>
      </div>

      <div class="col  col-md-6 mb-3">
        <div class="card" @click="makeRequest(store.MilanoRequest)">
        <img src="storage/destinations-img/milano.jpg" class="card-img" alt="Milano">
        <span class="position-absolute top-0 start-0 text-white p-2"><h3>Milano</h3></span>
        </div>
      </div>

      <div class="col  col-md-4 mb-3">
        <div class="card ratio ratio-4x3" @click="makeRequest(store.NapoliRequest)">
          <img src="storage/destinations-img/napoli.jpg" class="card-img" alt="Napoli">
        <span class="position-absolute top-0 start-0 text-white p-2"><h4>Napoli</h4></span>
        </div>
      </div>

      <div class="col  col-md-4 mb-3">
        <div class="card ratio ratio-4x3" @click="makeRequest(store.RiminiRequest)">
          <img src="storage/destinations-img/rimini.jpg" class="card-img" alt="Rimini">
        <span class="position-absolute top-0 start-0 text-white p-2"><h4>Rimini</h4></span>
        </div>
      </div>

      <div class="col  col-md-4">
        <div class="card ratio ratio-4x3" @click="makeRequest(store.FirenzeRequest)">
          <img src="storage/destinations-img/firenze.jpg" class="card-img" alt="Firenze">
        <span class="position-absolute top-0 start-0 text-white p-2"><h4>Firenze</h4></span>
        </div>
      </div>

    </div>

  </div>

</template>

<style lang="scss" scoped>
.card{
  position: relative;
  box-shadow: .5px .5px 2px 1px rgba($color: #000000, $alpha: .1);
  overflow: hidden;
  h3,h4{
    font-weight:600;
  }
  img{
    transition: transform 1.0s;
  }

  &:hover{
    transition: all .4s;
    cursor: pointer;
    box-shadow: 1px 1px 20px rgba($color: #000000, $alpha: .2);

    img{
      transform: scale(1.1);
  }
  }
}

.destination-row{
    img{
    height: 350px !important;
  }
}
.destination-secondtrow{
  img{
    height: 250px !important;
  }
}

.position-absolute{
  background: linear-gradient(180deg,rgba(0,27,65,.65) 0,rgba(0,27,65,0));
  padding: 20px;
  width: 100%;
}


</style>
