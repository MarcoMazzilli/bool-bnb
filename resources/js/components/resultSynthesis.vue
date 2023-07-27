<script>
import {store} from '../../data/store';
import { navigateApartmentResults } from '../function/basicCall';

export default {
  name: 'ResultSynthesis',
  data(){
    return{
      store,
    }
  },
  watch: {
    'store.lastRequest'(n,o){
      if(n != o){
        console.log('lastr equest modificata')
      }
    }
  },
  methods :{
    navigate(url){
      navigateApartmentResults(url);
    }
  },
  mounted(){}
}
</script>

<template>

    <div  v-if="store.pagination.total < 1"
    class="no-result container mt-5 mb-5 g-1 ">
      <h3>Nessuna corrispondenza esatta</h3>
      <h6>Prova a modificare o rimuovere alcuni filtri o a cambiare l'area di ricerca.</h6>

      <div class="redirect mt-5">
        <router-link :to="{name: 'home' }" class="redirect-home text-dark" >
          Torna alla Home
        </router-link>
      </div>
    </div>

    <div v-if="store.pagination.total > 0"
    class="result-synthesis container  mt-2 g-1 d-flex">

      <div class="info-box ">
        <span>{{ 'risultati: '+ store.pagination.total}}</span>
      </div>
      <div class="info-box ">
        <span>{{ store.lastRequest.address }}</span>
      </div>
      <div class="info-box ">
        <span>{{ 'in km: '+ store.lastRequest.radius }}</span>
      </div>
      <div class="info-box ">

        <span><i class="fa-solid fa-building"></i>
          {{ 'min: '+ store.lastRequest.rooms }}</span>
      </div>
      <div class="info-box ">
        <span><i class="fa-solid fa-bed"></i>
          {{ 'min: '+ store.lastRequest.beds }}</span>
      </div>
      <div class="info-box ">
        <span><i class="fa-solid fa-bed"></i>
          {{ 'min: '+ store.lastRequest.bathrooms }}</span>
      </div>

    </div>


    <div v-if="store.pagination.total > 0"
    class="paginate container d-flex justify-content-between mt-2 g-5 ">

      <div
      v-for="(link, index) in store.pagination.links" :key="index"
      @click="navigate(link.url)"
      v-show="(link.url != null)"
      class="links mx-1"
      :class="{
          'pg_btn' : (!(link.label.length === 16) && !(link.label.length === 12) && !(store.pagination.current_page === index) ),
          'pg_btn current' : store.pagination.current_page === index,
          'pg_btn prv' : link.label.length === 16,
          'pg_btn nxt' : link.label.length === 12,
        }"
      >

        <span
        style="display: inline-block;"
        v-show="(link.url != null)"
        :class="{
          'prev' : link.label.length === 16,
          'next' : link.label.length === 12,
        }"
        >
        {{ link.label }}
        </span>

      </div>
    </div>
</template>

<style lang="scss" scoped>

@use '../../scss/var' as *;

.result-synthesis{
  height: 20px;
  color: rgb(143, 143, 143);
  font-size: 0.8rem;
  text-align: center;

  & .info-box {
    width: calc(100% / 4);
    margin-top: -3px;
  }
}
.paginate{
  height: 20px;
  font-size: 0.7rem;

  & .prev{
    font-size: 0.05rem;
    color: rgba(255, 0, 0, 0);
    &::before{
      content: "<<";
      color: rgb(0, 0, 0);
      font-size: 0.7rem;
    }
  }
  & .next{
    font-size: 0.05rem;
    color: rgb(0, 4, 255);
    &::before{
      content: ">>";
      color: rgb(0, 0, 0);
      font-size: 0.7rem;
    }
  }
  & .current{
    color: white;
  }
}

.redirect a{
  text-decoration: none;
  color: rgb(40, 39, 39);
  padding: 10px;
  border: 1px solid rgb(96, 95, 95);
  // background-color:$brand-main;
  border-radius: 5px;
  &:hover{
    border: 1px solid rgb(0, 0, 0);
  }
}

.pg_btn{
width: 500px;

// height: 10px;
// position: relative;
color: #fff;
background: linear-gradient(0deg, #7c9cd8  0%, rgba(153,164,180,1) 60%, rgba(255,255,255,1) 93%, rgb(214, 214, 214) 100%);
padding: 5px 5px;
border: none;
border-radius: 5px;
// box-shadow: rgb(202, 202, 202) 0px -1px 5px 0px;
// border-radius: 50px;
transition : 500ms;
transform: translateY(0);
display: flex;
flex-direction: row;
justify-content: center;
align-items: center;
cursor: pointer;
opacity: 0.8;

  &.current{
    background: linear-gradient(0deg, $brand-main  0%, rgba(231,186,120,1) 60%, rgba(255,255,255,1) 93%, rgb(214, 214, 214) 100%);
    opacity: 01;
  }
}

.btn:hover{
transition : 1000ms;
// padding: 10px 17px;
transform : translateY(-2px);
// background: linear-gradient(90deg, #0066CC 0%, #c500cc 100%);
color: #ffffff;
border: none;

}

</style>
