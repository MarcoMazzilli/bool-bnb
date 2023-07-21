<script>
import {store} from '../../data/store';
import axios from 'axios';
import ApartmentCard from '../components/apartmentCard.vue';
export default {
    name: 'AdvancedSearch',
    data(){
        return{
          store,
          load:true,
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

      <div id="search-type-selector">
        <div class="container">

          <span>Advanced Search</span>

          <span>Map Search</span>

        </div>
      </div>


      <div id="search-filter">

        <div class="advanced_search_bar d-flex justify-content-around  container debug2">

          <!-- search bar -->
          <div class="input-group flex-nowrap " id="" >
              <input @keypress.enter=""
              id="via" v-model="indirizzo"
              type="text"
              class="form-control"
              placeholder="Cerca indirizzo"
              aria-label="Username"
              aria-describedby="addon-wrapping">

              <span @click=""
              class="input-group-text search"
              id="addon-wrapping"
              >
                <i class="fa-solid fa-magnifying-glass"></i>
              </span>
            </div>
          <!-- search bar -->

          <!-- stanze letti raggio -->
          <div class="search_box d-flex flex-column justify-content-around align-items-center p-1  ">
            <label class="form-label" for="rooms">numero di stanze</label>
            <input class="form-control" id="rooms" type="number">
          </div>

          <div class="search_box d-flex flex-column justify-content-around align-items-center p-1  ">
            <label class="form-label" for="bad">numero di letti</label>
            <input class="form-control" id="bad" type="number">
          </div>

          <div class="search_box d-flex flex-column justify-content-around align-items-center p-1  ">
            <label class="form-label" for="radius">raggio in km</label>
            <input class="form-control" id="radius" type="number">
          </div>
        </div>
        <!-- stanze letti raggio -->

        <!-- servizi -->
        <div class="advanced_search_bar  mt-1  container debug2">

          <div class="btn_group " role="group" aria-label="Basic checkbox toggle button group">

            <div v-for="(service, index) in store.services" :key="index" style="display: inline-block;">
              <input type="checkbox" class="btn-check" :id="index" autocomplete="off">
              <label class="btn btn-outline-primary d-flex justify-content-center align-items-center" :for="index">   {{ service }}</label>
            </div>
          </div>

        </div>

      </div>

      <div id="map-search"></div>





<!-- ---------------result -->
        <div v-if="load" class="container py-5 d-flex flex-wrap justify-content-between">

          <ApartmentCard v-for="apart in store.apartmentsfiltred" :key="apart.id"
          :apartmentData="apart"
          />

        </div>

    </div>
</template>

<style lang="scss" scoped>
@import '../../scss/var';

.advanced_search_bar{
  // width: 80%;
  margin: 0px auto;
  // height: 60px;

  &.address{
    height: 40px;
  }

  & .search_box{
    width: calc(100% / 8);
    height: 100%;
    min-width: 110px;
    max-width: 160px;


    & input, label{
      text-align: center;
      line-height: 1rem;
      font-size: 0.8rem;
      height: 50%;
      border: none;
    }
    & input{
      width: 80%;
      padding: 0px;
    }
  }
}

.btn_group{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  width: 100%;
  height: 190px;
  overflow: auto;
  .btn{
    padding: 2px 10px;
    margin: 2px 2px;
    max-width: 80px;
    font-size: 0.8rem;
    min-width: 110px;
    // max-width: 160px;
    min-height: 90px;
    // max-height: 160px;

  }
  .btn-outline-primary{
    color: $light-text;
    border-color: lighten($low-black, 80%);
    box-shadow: inset 0px 0px 2px 1px lighten($brand-main, 20%);
    background-color: lighten($brand-main, 25%);
    border-radius: 7px;

    &:hover{
      color: $low-black ;
      border-color: lighten($low-black, 60%);
      box-shadow: inset 0px 0px 6px 1px lighten($brand-main, 10%);
      background-color: lighten($brand-main, 20%);

    }
  }

.btn-check:checked + .btn, :not(.btn-check) + .btn:active, .btn:first-child:active, .btn.active, .btn.show{
  color: $low-black  ;
  background-color: lighten($brand-main, 15%);
  border-color: rgba($color: #000000, $alpha: 0)
}
}

</style>
