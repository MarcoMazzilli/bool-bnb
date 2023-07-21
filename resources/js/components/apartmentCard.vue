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


        <div class="card  m-2" style="width: 22rem;" @click="selectApartment">
                <!-- Immagine -->
                <!-- <img src="https://www.miprendoemiportovia.it/wp-content/uploads/2020/10/Casa-Nea-Sardegna.jpg" class="card-img-top" alt=""  style="width: 22rem;"> -->
                <div class="overflow-hidden">
                  <img :src=" 'storage/' + apartmentData.cover_image " class="card-img-top" alt=""  style="width: 22rem;">
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
                </div>

        </div>

</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.card{
    border: none;
    box-shadow: .5px .5px 2px 1px rgba($color: #000000, $alpha: .1);
    &:hover{
      transition: .4s;
      cursor: pointer;
      box-shadow: 1px 1px 30px rgba($color: #000000, $alpha: .2);

      img {
        transition: all 1s;
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
img{
    border-radius: 10px;
    height: 250px;
}

</style>
