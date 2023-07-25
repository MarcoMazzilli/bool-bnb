<script>

// --------------------------------------------------------------------import
import tt from '@tomtom-international/web-sdk-maps';
import DrawingTools from '@tomtom-international/web-sdk-plugin-drawingtools';

import axios from 'axios';
import {store} from '../../data/store';
// function import basic calls
import {getCordianates,findServices, requestCompiler,  searchByRange, getMarkers} from '../function/basicCall';
// import components
import ApartmentCard from '../components/apartmentCard.vue';
import inputSearch from '../components/inputSearch.vue';
import advSrcBar from '../components/advSrcBar.vue';

/**
    - media query scatti grandezza mappa --OK.
    - barra chiudi apri adv-search-bar --OK.
    - bottone submit --OK.
    - centratura mappa con geocoding --OK.
    - disattivare raggio in km quandi si va in disegna mappa  <--
    - js scrolling <--
    - filtro prezzi <--
    - compilatore request  <--
      - v-bind e toggle per i servizi --OK
      - cordinate in mod drv disegna sulla mappa <--

 */

// ---------------- ADV-SRC-SUPERSTAR-------------------------------start-logic
export default {

    name: 'AdvancedSearch',
    data(){
        return{
          store,
          load:true,
          selectedApartment: null,
          center: store.cord,
          advToggle: false,
          address: '',
          // Da valorizzare in fase di ricerca
          servicesToSearch: 1,

        }
    }, // close data

    components:{ApartmentCard, inputSearch, advSrcBar}, // close components

    watch: {
      'store.advSrcRequest.cordinates'(n , o){
          if(n != o){
            store.newCenter = [store.advSrcRequest.cordinates.lon, store.advSrcRequest.cordinates.lat ];
            console.warn('watch')
          }
      },

      'store.newCenter'(newnewCenter, oldnewCenter) {
          if (newnewCenter != oldnewCenter) {
            console.log('WATCH : centro mappa cambiato --->');
            store.cord = store.newCenter;
            this.updateMapCenter();
          }
      },
      'store.fakePoints'(neww, old) {
          if (neww != old) {
            console.log('WATCH : centro mappa cambiato --->');
            store.cord = store.newCenter;
            this.initializeMap();
          }
      },

    }, // close watch

    methods :{
      advancedSearch(){
        if(store.advSrcRequest.type === 'adv'){
          // service ricerca avanzata -------------------------
          console.log(store.cord)
          store.advSrcRequest.coord = [[store.cord]];
          console.warn(store.newCenter);
          store.advSrcRequest.longitude = store.newCenter[0];
          store.advSrcRequest.latitude = store.newCenter[1];
          this.compileServiceIndex();
          let data = store.advSrcRequest;
          console.log('ricerca avanzata', store.advSrcRequest );
          searchByRange( data );

        }else if(store.advSrcRequest.type === 'drv'){
          // service ricerca avanzata -------------------------


        }else if(store.advSrcRequest.type = 'srv-only'){
          // service only search -------------------------
          store.advSrcRequest.coord = [[store.cord]]
          this.compileServiceIndex();
          let data = store.advSrcRequest;
          console.log('solo servizi', store.advSrcRequest );
          findServices(data);



        }

      },

      // per il paginate di una chiamata post devi riaggiungere la request!!!
      navigateApartmentResults(url){
      axios.post(url, store.advSrcRequest )
        .then(result =>{
          console.log(result.data);
          store.apartmentsfiltred = result.data.apartments.data;
      })
    },

      test(){
        console.log(store.advSrcRequest.radius);
      },

      compileServiceIndex(){
        store.advSrcRequest.services = [];
        store.advSrcRequest.servicesChecked.forEach((element, key) => {
          if(element){
            store.advSrcRequest.services.push(key + 1);
            // console.log(key, element , store.advSrcRequest.services);
          }
        });

      },

      toggleServices(serviceIndex){
        store.advSrcRequest.servicesChecked[serviceIndex] = !store.advSrcRequest.servicesChecked[serviceIndex];
        console.log(store.advSrcRequest.servicesChecked[serviceIndex]);
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
        if(!store.cord){
          this.center = [12.49427, 41.89056];
          store.newCenter = [12.49427, 41.89056];
        }

        // reset dom---
        const mapDiv = document.getElementById('map');
        mapDiv.innerHTML = '';

        // inizializza mappa
        map = tt.map({
        key: store.apiKey,
        container: 'map',
        center: this.center,
        zoom: 10,
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
        ttMapsSdk: tt
        });

        map = tt.map({
        key: store.apiKey,
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

          store.fakePoints.forEach(point => {
            new tt.Marker().setLngLat(point).addTo(map);
          });
        });

        ttDrawingTools.on('tomtom.drawingtools.created', function(feature) {
        console.log(
          feature.data.features[0].geometry.coordinates,
          feature.data.features[0],
          );
        });

      },

      updateMapCenter() {

      console.warn('update map center', store.newCenter);

      map.easeTo({
      center: store.newCenter,
      duration: 3000,
      animate: true, // nada de nada --- :'(
      });

      },

    // tomtom map------------------------------------------------------------------/

      showApartmentDetails(apart) {
        // console.log(apart)
        store.apartmentDetails = apart
        this.$router.push({ name: 'apartment', params: { slug: apart.slug } });
      },

    }, // close methods

    mounted(){
        console.log('Advanced Search!');
        this.initializeMap();
        getMarkers();
    } // close mounted
}
</script>

<template>

  <!-- <button @click="test()">test function</button> -->
    <div class="AdvancedSearch_container" id="AdvancedSearch-page">
      <!-- ---------------search-filter -----------------------------------------------\-->



      <!-- ---------------search-filter -----------------------------------------------/-->
      <advSrcBar />
      <inputSearch />
      <!-- ---------------result
        ------------------------------------------------------\-->


        <div v-if="store.pagination.current_page" class="container py-1 d-flex flex-wrap justify-content-between">

          <button v-for="(link, index) in store.pagination.links" :key="index"
          @click=" navigateApartmentResults(link.url)"
          v-show="(link.url != null)"
          style="height: 20px; font-size: 0.6rem;"
          >
          page {{link.label}}
          </button>

        </div>

        <div v-if="store.load" class="container py-5 d-flex flex-wrap justify-content-between">

            <ApartmentCard v-for="apart in store.apartmentsfiltred" :key="apart.id"
            v
            :apartmentData="apart"
            @apartmentSelected="showApartmentDetails(apart)"
            @click="showApartmentDetails(apart)"
            />

        </div>

      <!-- <div v-if="load" class="container py-5 d-flex flex-wrap justify-content-between">
        <ApartmentCard v-for="apart in store.apartmentsfiltred" :key="apart.id" :apartmentData="apart"
          @apartmentSelected="showApartmentDetails" />
      </div> -->

      <!-- ---------------result ------------------------------------------------------/-->

  </div>
</template>

<style lang="scss" scoped>
@import '../../scss/var';



</style>
