<script>

// --------------------------------------------------------------------import
import tt from '@tomtom-international/web-sdk-maps';
import DrawingTools from '@tomtom-international/web-sdk-plugin-drawingtools';

import axios from 'axios';
import {store} from '../../data/store';
// function import basic calls
import {getCordianates,findServices, searchByRange, getMarkers} from '../function/basicCall';
// import components


// ---------------- ADV-SRC------------------------------start-logic
export default {

    name: 'AdvancedSearchBar',
    data(){
        return{
          store,
          load:true,
          selectedApartment: null,
          center: store.cord,
          advToggle: true,
          address: '',
          // Da valorizzare in fase di ricerca
          servicesToSearch: 1,

        }
    }, // close data

    components:{}, // close components

    watch: {
      'store.mapCoord'(n, o) {
          if (n != o) {
            console.log('WATCH : centro mappa cambiato --->');

            this.updateMapCenter();
          }
      },

      'store.fakePoints'(n, o) {
          if (n != o) {
            console.log('WATCH : marker aggiornati');

            this.initializeMap();
          }
      },

    }, // close watch

    methods :{

      scrollService(event){
        console.log('scroll', event);
        const scrollableDiv = this.$refs.scrollable;
        const scrollSpeed = 80;
        scrollableDiv.scrollLeft += event.deltaY > 0 ? scrollSpeed : -scrollSpeed;
        event.preventDefault();
      },

      navigateApartmentResults(url){
      axios.post(url, store.advSrcRequest )
        .then(result =>{
          console.log(result.data);
          store.apartmentsfiltred = result.data.apartments.data;
      })
    },

      toggleServices(serviceIndex){
        store.servicesChecked[serviceIndex] = !store.servicesChecked[serviceIndex];
        console.log(store.servicesChecked[serviceIndex]);
      },

      toggleAdvBar(){
        console.log('toggle');
        this.advToggle ? this.advToggle = false : this.advToggle = true;
        console.log(this.advToggle);
      },

      serviceSearch(){
        store.advSrcRequest.type='srv-only';
      },

      mapCenter(){
        console.log(this.address);
        getCordianates(this.address);
      },

      // tomtom map----------------------------------------------------------------\

      initializeMap() {
        store.advSrcRequest.type='adv';
        // se arrivi direttamente in advanced search allora centra la mappa su Roma
        if(!store.mapCoord){
          store.mapCoord = [12.49427, 41.89056];
          console.warn('centro mappa mancante')
        }

        // reset dom---
        const mapDiv = document.getElementById('map');
        mapDiv.innerHTML = '';

        // inizializza mappa
        map = tt.map({
        key: store.apiKey,
        container: 'map',
        center: store.mapCoord,
        zoom: 9,
        pitch: true, // Abilita l'animazione --- D: ...ma non funziona!!! :(
        animate: true, // nada--- :'(
        });

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());

        map.on('load', () => {

          store.fakePoints.forEach(point => {
            new tt.Marker().setLngLat(point).addTo(map);
          });
        });
      },

      initializeMapDrawing() {
        store.advSrcRequest.type='drv';
        // reset dom---
        const mapDiv = document.getElementById('map');
        mapDiv.innerHTML = '';

        const ttDrawingTools = new DrawingTools({
        ttMapsSdk: tt,
        controls: {
          line: false,
          polygon: false,
        }
        });

        map = tt.map({
        key: store.apiKey,
        container: 'map',
        center: store.mapCoord,
        zoom: 9,
        pitch: true, // Abilita l'animazione
        animate: true
        });

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        map.addControl(ttDrawingTools, 'top-left');

        map.on('load', () => {

          store.fakePoints.forEach(point => {
            new tt.Marker().setLngLat(point).addTo(map);
          });
        });

        ttDrawingTools.on('tomtom.drawingtools.created', function(feature) {
        console.log(
          feature.data.features[0].geometry.coordinates,
          feature.data.features[0],
          );
          store.advSrcRequest.coord = feature.data.features[0].geometry.coordinates[0];
          console.log('request drv state',  store.advSrcRequest )
        });

      },

      updateMapCenter() {

      console.warn('update map center', store.mapCoord);

      map.easeTo({
      center: store.mapCoord,
      duration: 3000,
      animate: true, // nada de nada --- :'(
      });

      },

    // tomtom map------------------------------------------------------------------/
    }, // close methods

    mounted(){
        console.log('Advanced Search Bar!');
        this.initializeMap();
        getMarkers();
    } // close mounted
}
</script>

<template>

    <div class="AdvancedSearch_container my-2 container gx-1 " id="AdvancedSearch-page"
    :class="this.advToggle ? 'adv-closed' : ' ' "
    >
      <!-- ---------------search-filter -----------------------------------------------\-->
      <div id="search-filter" class="search-filter position-relative w-100  "
      :class="this.advToggle ? 'adv-closed' : ' ' "
      >

        <!-- <button @click="advancedSearch()" class="adv_submit"><i class="fa-solid fa-magnifying-glass"></i></button> -->


        <!-- selettori tipo di ricerca -------------------------\ -->
        <div id="search-type-selector" class="search-type-selector "
        >

              <button
              @click="initializeMap()"
              class="src_typ_btn"
              :class="(store.advSrcRequest.type === 'adv') ? 'active' : '' "
              >
                <span>Ricerca Avanzata</span>
              </button>

              <button
              @click="initializeMapDrawing()"
              class="src_typ_btn"
              :class="(store.advSrcRequest.type === 'drv') ? 'active' : '' "
              >
                <span>Disegna Sulla Mappa</span>
              </button>

              <button
              @click="serviceSearch()"
              class="src_typ_btn"
              :class="(store.advSrcRequest.type === 'srv-only') ? 'active' : '' "
              >
                <span>service only search</span>
              </button>


        </div>
        <!-- selettori tipo di ricerca -------------------------/ -->


        <!-- filtri -------------------------\ -->
        <div class="flt_container d-flex flex-column "

        >
        <!-- filtri -------------------------/ -->

            <!-- map -->
            <div class="mapping w-100">

                <div id="mountMap" class="w-100 h-100">
                  <div class="map w-100 h-100 2" id="map" ref="mapRef"></div>
                </div>

            </div>
            <!-- map -->

            <!-- raggio metriquadri stanze letti bagno -->
            <div class="option d-flex justify-content-around align-items-center w-100 ">

              <div class="search_box d-flex flex-column  justify-content-center align-items-center ">
              <label class="" for="radius">Raggio in Km</label>
              <input min="20" max="1000"
              class="option-input mt-1 " id="radius" type="number"
              v-model="store.advSrcRequest.radius">
            </div>

            <div class="search_box d-flex flex-column  justify-content-center align-items-center  ">
              <label class="" for="mq">Minimo m²</label>
              <input min="40" max="300"
              class="option-input mt-1" id="mq" type="number"
              v-model="store.advSrcRequest.size">
            </div>

            <div class="search_box d-flex flex-column  justify-content-center align-items-center  ">
              <label class="" for="rooms">Minimo Stanze</label>
              <input min="1" max="20"
              class="option-input mt-1" id="rooms" type="number"
              v-model="store.advSrcRequest.rooms">
            </div>

            <div class="search_box d-flex flex-column  justify-content-center align-items-center  ">
              <label class="" for="bad">Minimo Letti</label>
              <input min="1" max="20"
              class="option-input mt-1" id="bad" type="number"
              v-model="store.advSrcRequest.beds">
            </div>

            <div class="search_box d-flex flex-column  justify-content-center align-items-center  ">
              <label class="" for="bathrooms">Minimo Bagni</label>
              <input min="1" max="6"
              class="option-input mt-1" id="bathrooms" type="number"
              v-model="store.advSrcRequest.bathrooms">
            </div>

            </div>
            <!-- raggio metriquadri stanze letti bagno -->

            <!-- servizi -->
            <div @wheel="scrollService" ref="scrollable" class="service w-100 ">

              <div class="btn_group " role="group" aria-label="Basic checkbox toggle button  group">

                <div v-for="(service, index) in store.services" :key="index" style="display:    inline-block;">
                  <input type="checkbox"
                  :checked="store.servicesChecked[index]"
                  @change="toggleServices(index)"
                  class="btn-check" :id="index" autocomplete="off">
                  <label class="btn btn-outline-primary d-flex justify-content-center     align-items-center" :for="index">   {{ service }}</label>
                </div>

              </div>

            </div>
          <!-- servizi -->
        </div>
        <!-- filtri -------------------------/ -->
      </div>

              <!-- open close bar -------------------------\ -->
      <div @click="toggleAdvBar()"
          class="open_close_bar d-flex justify-content-center w-100 ">
          <span v-if="this.advToggle">Mostra Ricerca Avanzata</span>
          <span v-if="!this.advToggle">Nascondi Ricerca Avanzata</span>
      </div>
        <!-- open close bar -------------------------/ -->
      <!-- ---------------search-filter -----------------------------------------------/-->


  </div>
</template>

<style lang="scss" scoped>
@import '../../scss/var';

.AdvancedSearch_container{
  box-shadow:  0px 0px 5px rgba(54, 69, 206, 0.507);
  background-color: #f2f8f8;
  border-radius: 10px;
  height: 425px;
  overflow: hidden;
  transition :all 900ms ease-out;
  &.adv-closed{
  height: 20px ;
  transition :all 1100ms ease-out;
}
}

.adv_submit{
  position:absolute;
  top: calc(300px - 10px);
  right: 0%;
  z-index: 999;
}
.search-filter{
  height: 402px;
  overflow: hidden;
  transition :all 1000ms ease-out;
  &.adv-closed{
  height: 0px ;
}
}
.search-type-selector{
  height: 25px;
  overflow: hidden;
}

.flt_container{
  height: 375px;
  overflow: hidden;

}

.mapping{
  height: calc(400px - 25px - 80px);
}

.option{
  height: 60px;
}
.search_box{
  width: calc(100% / 5);
  & label{
    font-size: 0.8rem;
  }
}

.option-input{
  width: 95%;
  text-align: center;
  font-size: 0.8rem;
  border: none;
  border-radius: 5px;
}
.service{
  height: 65px;
  overflow-x: hidden; //
  overflow-y: hidden;
}

.open_close_bar{
  height: 20px;
  font-size: 0.8rem;
  cursor: pointer;
}

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
  opacity: 0.5;

  &:hover {
    background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
    background-color:#e9e9e9;
  }
  &:active {
    position:relative;
    top:1px;
  }
  &.active{
    border: 1px solid rgba(20, 199, 199, 0.466);
    opacity: 1;
  }
}




// bootstrap overwrite
.btn_group{
  display: inline-block; //
  flex-wrap: nowrap; //
  justify-content: center;
  width: 1400px; //
  height: 100%;


  .btn{
    padding: 2px 10px;
    margin: 1px 1px 1px 1px;
    max-width: 400px; //
    font-size: 0.8rem;
    min-width: 110px;

  }
  .btn-outline-primary{
    color: $light-text;
    border-color: rgba(0, 0, 0, 0.096);
    box-shadow: inset 0px 0px 1px 0px rgba(0, 0, 255, 0.185);
    background-color: none;
    border-radius: 7px;

    &:hover{
      color: rgba(0, 0, 0, 0.548);

      box-shadow: inset 0px 0px 6px 1px white;

    }
  }

.btn-check:checked + .btn, :not(.btn-check) + .btn:active, .btn:first-child:active, .btn.active, .btn.show{
  color: $low-black  ;
  background-color: rgb(220, 232, 255);
  box-shadow: inset 0px 0px 1px 1px rgba(0, 0, 255, 0.486);
  // border-color: rgba($color: #000000, $alpha: 0)
}
}
// --------------------



</style>
