<script>
import axios from 'axios';

export default {
    name: 'ApartmentCard',
    props: {
        apartmentData: Object,
    },
    methods: {
    selectApartment() {
      //emetto l'evento
      // console.log('emit')
      this.$emit('apartmentSelected');
    },
  },
}
</script>

<template>


        <div class="card  m-2"  @click="selectApartment">

            <div class="overflow-hidden img-container">
              <img :src=" 'storage/' + apartmentData.cover_image " class="card-img-top" alt="" >
            </div>

            <!-- Testo -->
            <div class="card-body p-3">

              <div class="d-flex justify-content-between">
                  <h4>{{apartmentData.name}}</h4>
                  <span><i class="fa-solid fa-star"></i> 5,0</span>
              </div>

              <p class="card-text m-0"><b>{{apartmentData.address}}</b></p>

              <p class="card-text m-0">{{apartmentData.description}}</p>

              <p class="card-text m-0"><b>{{apartmentData.price}}€</b> a notte</p>
              {{apartmentData.n_of_bed}}
              <i class="fa-solid fa-bed"></i>
              {{apartmentData.n_of_bathroom}}
              <i class="fa-solid fa-shower"></i>
              {{apartmentData.n_of_room}}
              <i class="fa-solid fa-building"></i>
              {{apartmentData.apartment_size + ' ' +'m²'}}
              <!-- <i class="fa-regular fa-square"></i> -->
            </div>

        </div>

</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.card{
  width: 100%;
  border: none;
  box-shadow: .5px .5px 2px 1px rgba($color: #000000, $alpha: .1);
  .img-container{
    width: 100%;
    height: 250px;
  }
  .card-img-top{
    transition: all 1s;
    object-fit: cover;
    width: 100%;
    height: 100%;
  }
  &:hover{
    transition: all .4s;
    cursor: pointer;
    box-shadow: 1px 1px 30px rgba($color: #000000, $alpha: .2);

      img {
          transform: scale(1.2);
        }
    }

    .card-body{
        padding-left: 0;
        padding-right: 0;

        & h4{
          font-weight: bold;
        }
    }
}

@media screen and (min-width: 768px) {
.card {
  width: 47%;
}
}
@media screen and (min-width: 992px) {
.card {
  width: 48%;
}
}
@media screen and (min-width: 1200px) {
.card {
  width: 31%;
}
}

</style>
