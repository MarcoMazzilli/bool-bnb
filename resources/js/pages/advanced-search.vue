<script>
import tt from '@tomtom-international/web-sdk-maps';
import DrawingTools from '@tomtom-international/web-sdk-plugin-drawingtools';
import axios from 'axios';
import {store} from '../../data/store';
import ApartmentCard from '../components/apartmentCard.vue';
export default {
    name: 'AdvancedSearch',
    data(){
        return{
          store,
          load:true,
          // center: [12.49427, 41.89056],
          center: store.cord,
        }
    }, // close data

    components:{ApartmentCard}, // close components

    methods :{
      // tomtom map----------------------------------------------------------------\
      initializeMap() {

        // se arrivi direttamente in advanced search allora centra la mappa su Roma
        if(!store.cord){
          this.center = [12.49427, 41.89056];
        }

        // reset dom---
        const mapDiv = document.getElementById('map');
        mapDiv.innerHTML = '';

        // inizializza mappa
        map = tt.map({
        key: 'cxG50CTiIMJjWZztYbdn0RxgT658PVkx',
        container: 'map',
        center: this.center,
        zoom: 10,
        pitch: true, // Abilita l'animazione --- D: ...ma non funziona!!! :(
        animate: true, // nada--- :'(
        });

        map.addControl(new tt.FullscreenControl());
        // map.addControl(new tt.NavigationControl());

        map.on('load', () => {

          new tt.Marker().setLngLat(this.center).addTo(map);
        });
      },

      initializeMapDrawing() {

        // reset dom---
        const mapDiv = document.getElementById('map');
        mapDiv.innerHTML = '';

        const ttDrawingTools = new DrawingTools({
        ttMapsSdk: tt
        });

        map = tt.map({
        key: 'cxG50CTiIMJjWZztYbdn0RxgT658PVkx',
        container: 'map',
        center: this.center,
        zoom: 10,
        pitch: true, // Abilita l'animazione
        animate: true
        });

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        map.addControl(ttDrawingTools, 'top-left');

        map.on('load', () => {

          new tt.Marker().setLngLat(this.center).addTo(map);
        });

        ttDrawingTools.on('tomtom.drawingtools.created', function(feature) {
        console.log(
          feature.data.features[0].geometry.coordinates,
          feature.data.features[0],
          );
        });

      },

      updateMapCenter(newCenter) {

      map.easeTo({
      center: newCenter,
      duration: 3000,
      animate: true, // nada de nada --- :'(
      });

      }
    // tomtom map------------------------------------------------------------------/

    }, // close methods

    mounted(){
        console.log('Advanced Search!');
        this.initializeMap();
    } // close mounted
}
</script>

<template>
    <div class="AdvancedSearch_container" id="AdvancedSearch-page">

      <div id="search-filter" class="container gx-0 debug2">

        <!-- selettori tipo di ricerca -------------------------\ -->
        <div id="search-type-selector" class="">
            <div class="">

              <button
              @click="initializeMap()"
              class="src_typ_btn">
                <span>Ricerca Avanzata</span>
              </button>

              <button
              @click="initializeMapDrawing()"
              class="src_typ_btn">
                <span>Disegna Sulla Mappa</span>
              </button>

            </div>
        </div>
        <!-- selettori tipo di ricerca -------------------------/ -->

        <!-- filtri -------------------------\ -->
        <div class="d-flex h-100 w-100">

            <!-- search bar & map -->
          <div class="advanced_search_bar mapping  d-flex flex-column  debug2">

            <div class="input-group flex-nowrap " id="" >
              <input @keypress.enter=""
              id="via" v-model="indirizzo"
              type="text"
              class="form-control"
              placeholder="Cerca indirizzo"
              aria-label="Username"
              aria-describedby="">

              <!-- <span @click=""
              class="input-group-text search"
              id=""
              >
                <i class="fa-solid fa-magnifying-glass"></i>
              </span> -->
            </div>

            <div id="mountMap" class="debug2">
                <div class="map debug2" id="map" ref="mapRef"></div>
            </div>

          <!-- search bar -->
          </div>

          <!-- raggio metriquadri stanze letti bagno -->
          <div class="advanced_search_bar option d-flex flex-column justify-content-around align-items-center debug2">

            <div class="search_box d-flex flex-column justify-content-around align-items-center p-1  ">
              <label class="form-label" for="radius">raggio in km</label>
              <input class="form-control" id="radius" type="number">
            </div>

            <div class="search_box d-flex flex-column justify-content-around align-items-center p-1  ">
              <label class="form-label" for="bad">metriquadri</label>
              <input class="form-control" id="bad" type="number">
            </div>

            <div class="search_box d-flex flex-column justify-content-around align-items-center p-1  ">
              <label class="form-label" for="rooms">numero di stanze</label>
              <input class="form-control" id="rooms" type="number">
            </div>

            <div class="search_box d-flex flex-column justify-content-around align-items-center p-1  ">
              <label class="form-label" for="bad">numero di letti</label>
              <input class="form-control" id="bad" type="number">
            </div>

            <div class="search_box d-flex flex-column justify-content-around align-items-center p-1  ">
              <label class="form-label" for="bad">numero di bagni</label>
              <input class="form-control" id="bad" type="number">
            </div>

          </div>
          <!-- raggio metriquadri stanze letti bagno -->

          <!-- servizi -->
          <div class="advanced_search_bar service  debug2">

            <div class="btn_group " role="group" aria-label="Basic checkbox toggle button group">

            <div v-for="(service, index) in store.services" :key="index" style="display: inline-block;">
              <input type="checkbox" class="btn-check" :id="index" autocomplete="off">
              <label class="btn btn-outline-primary d-flex justify-content-center align-items-center" :for="index">   {{ service }}</label>
            </div>
            </div>

          </div>
          <!-- servizi -->

        </div>
        <!-- filtri -------------------------\ -->

      </div>


      <!-- ---------------result ------------------------------------------------------\-->
      <div v-if="load" class="container py-5 d-flex flex-wrap justify-content-between">

          <ApartmentCard v-for="apart in store.apartmentsfiltred" :key="apart.id"
          :apartmentData="apart"
          />

      </div>
      <!-- ---------------result ------------------------------------------------------/-->

    </div>
</template>

<style lang="scss" scoped>
@import '../../scss/var';


.src_typ_btn {
	box-shadow:inset 0px 0px 0px 0px #ffffff;
	background:linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
	background-color:#f9f9f9;
	border-radius:5px 5px 0px 0px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#666666;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
	padding:2px 25px;

  &:hover {
    background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
    background-color:#e9e9e9;
  }
  &:active {
    position:relative;
    top:1px;
  }
}

.advanced_search_bar{
  margin: 0px auto;

  &.mapping{
    width: 78%;
    margin-right: 1%;
  }
  &.option{
    width: 10%;
  }
  &.service{
    width: 12%;
    height: 300px;
    padding: 2px;
    overflow: hidden;
  }

  #search-type-selector{
    margin: 0 !important;
    padding: 0 !important;
  }


  & .search_box{
    width: calc(100% / 8);
    height: 100%;
    margin: 2px 0px;
    min-width: 110px;
    max-width: 160px;
    border-color: lighten($low-black, 80%);
    box-shadow: inset 0px 0px 2px 1px lighten($brand-main, 20%);
    background-color: lighten($brand-main, 25%);
    border-radius: 7px;


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
      background-color: lighten($brand-main, 30%);
    }
  }
}
.input-group{
  height: 30px;
  max-width: 400px;
  margin-right: 3px;
}
.btn_group{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  width: 100%;
  height: 100%;
  overflow-y: scroll;
  overflow-x: hidden;
  .btn{
    padding: 2px 10px;
    margin: 2px 2px 2px 2px;
    max-width: 80px;
    font-size: 0.8rem;
    min-width: 110px;
    // max-width: 160px;
    // min-height: 90px;
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
.map{
  margin: auto;
  width: 100%;
  height: 270px;
}


</style>
