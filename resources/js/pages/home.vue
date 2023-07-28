<script>
import { store } from '../../data/store';
import axios from 'axios';
import Jumbotron from '../components/jumbotron.vue';
import Destinations from '../components/destinations.vue';
// import ApartmentCard from '../components/apartmentCard.vue';
import ApartmentCard from '../components/apartmentCardSrc.vue';
import Apartment from './apartment.vue';
import inputSearch from '../components/inputSearch.vue';

//SWIPER
import { Swiper, SwiperSlide } from 'swiper/vue';
// import { Mousewheel, Pagination } from 'swiper/vue';
import 'swiper/css';
// import 'swiper/css/pagination';
// import { Autoplay, Navigation, Pagination } from "swiper";
// Swiper.use([Autoplay, Navigation, Pagination]);

// import { searchByRange } from '../function/basicCall';


import { Button } from 'bootstrap';
export default {
  name: 'Home',
  data() {
    return {
      store,
      load: false,
      selectedApartment: null,
      // Home apiCall results
      links : [],
    }
  },

  components: { Jumbotron,inputSearch, ApartmentCard, Apartment, Button, Destinations, Swiper, SwiperSlide  },

  methods: {

    getApartment() {
      this.load = false;

      axios.get(store.apiHostUrl + store.getTpartments)
        .then(result => {

          store.apartmentsGetted = result.data.apartments.data;

          this.load = true;
          this.links = result.data.apartments.links;
          console.log('risultati', result.data)
        })
    },


    setup() {
      const onSwiper = (swiper) => {
        console.log(swiper);
      };
      const onSlideChange = () => {
        console.log('slide change');
      };
      return {
        onSwiper,
        onSlideChange,
      };
    },

    Preset(){
      searchByRange(store.RomaRequest)
    },



    navigateApartmentResults(url){
      axios.get(url)
        .then(result =>{
          store.apartmentsGetted = result.data.apartments.data;
      })
    },

    showApartmentDetails(apart) {
      // console.log(apart)
      store.apartmentDetails = apart
      this.$router.push({ name: 'apartment', params: { slug: apart.slug } });
    },
  },

  mounted() {
    console.log('whereIam?', this.$route.name );
    this.getApartment();
  }
}
</script>

<template>
  <div class="home_container" id="home-page">

    <Jumbotron />
    <inputSearch />

    <!-- TITOLO -->
    <div class="container py-3">
      <h1>Scopri i nostri appartamenti</h1>
      <!-- debug -->
      <h4 class="text-info">Scorri a dx e sx per visualizzare gli appartamenti</h4>
    </div>
    <!-- /TITOLO -->


    <swiper
  :slides-per-view="6"
  :space-between="20"
  :breakpoints="{
    '0': {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    '767': {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    '993': {
      slidesPerView: 3,
      spaceBetween: 20,
    },
  }"
  @swiper="onSwiper"
  @slideChange="onSlideChange"
  class="container d-flex flex-wrap justify-content-between"
  v-if="load"
>
  <swiper-slide v-for="apart in store.apartmentsGetted" :key="apart.id">


    <!--accrocchio per oviare al problema dei margini fra una card e l'altra in mobile ho aggiunto un p-2 che diventa p-0 al di sopra di 576px(mx-sm-4 p-2 p-sm-0)  -->
    <ApartmentCard
    class="mx-sm-4 p-2 p-sm-0"
    :key="apart.id"
    :apartmentData="apart"
    @apartmentSelected="showApartmentDetails(apart)"
    @click="showApartmentDetails(apart)"
    />

  </swiper-slide>
</swiper>

<!-- /BOTTONI NAVIGAZIONE  -->

<div class="container nav-button text-center mt-3">

  <button class="btn btn-primary mm-btn-nav mx-1"
  v-for="link in links" :key="link"
  v-html="link.label"
  @click="navigateApartmentResults(link.url)">
</button>

</div>

    <!-- COMPONENTE CARD -->

<!-- <div v-if="load" class="container d-flex flex-wrap justify-content-between">

  <ApartmentCard v-for="apart in store.apartmentsGetted"
  :key="apart.id"
      :apartmentData="apart"
      @apartmentSelected="showApartmentDetails(apart)"
      @click="showApartmentDetails(apart)"
      />

    </div> -->

    <!-- /COMPONENTE CARD DESTINATIONS-->

    <Destinations />

  </div>
</template>

<style lang="scss" scoped>
.mm-btn-nav{
  // HIDE FIRST AND LAST NAV-BUTTON
  &:first-of-type{
    display: none;
  }
  &:last-of-type{
    display: none;
  }
}

@media screen and (max-width: 500px) {
.card {
  margin: 0 auto;
}
}
@media screen and (max-width: 768px) {
.card {
  margin: 0;
}
}
</style>
