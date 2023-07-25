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
    <div class="result-synthesis container my-1 g-1 d-flex">

      <div class="info-box ">
        <span>{{ 'risultati: '+ store.pagination.total }}</span>
      </div>
      <div class="info-box ">
        <span>{{ 'risultati: '+ store.pagination.total }}</span>
      </div>
      <div class="info-box ">
        <span>{{ 'risultati: '+ store.pagination.total }}</span>
      </div>
      <div class="info-box ">
        <span>{{ 'risultati: '+ store.pagination.total }}</span>
      </div>


    </div>


    <div v-if="store.pagination.current_page"
    class="paginate container d-flex justify-content-between my-1 g-1 debug">
      <div v-for="(link, index) in store.pagination.links" :key="index"
      class="links">

        <span @click="navigate(link.url)"
        style="cursor: pointer; margin-left: 10px; display: inline-block;"
        v-show="(link.url != null)"
        :class="{
          'prev' : link.label.length === 16,
          'next' : link.label.length === 12,
          'current' : store.pagination.current_page === index,
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
  font-size: 0.9rem;
  text-align: center;

  & .info-box {
    width: calc(100% / 4);
    margin-top: -3px;
  }
}
.paginate{
  height: 30px;
  font-size: 0.7rem;

  & .prev{
    font-size: 0.05rem;
    color: rgba(255, 0, 0, 0);
    &::before{
      content: "prev";
      color: rgb(255, 0, 0);
      font-size: 0.7rem;
    }
  }
  & .next{
    font-size: 0.05rem;
    color: rgb(0, 4, 255);
    &::before{
      content: "next";
      color: rgb(0, 4, 255);
      font-size: 0.7rem;
    }
  }
  & .current{
    color: white;
  }
}


</style>
