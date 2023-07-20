<script>
import axios from 'axios';

export default {
    name: 'ApartmentCard',
    props: {
        apartmentData: Object,
    },
}
</script>

<template>


        <div class="card  m-2" style="width: 22rem; ">
                <!-- Immagine -->
                <!-- <img src="https://www.miprendoemiportovia.it/wp-content/uploads/2020/10/Casa-Nea-Sardegna.jpg" class="card-img-top" alt=""  style="width: 22rem;"> -->
                <img :src=" 'storage/' + apartmentData.cover_image " class="card-img-top" alt=""  style="width: 22rem;">

                <!-- Testo -->
                <div class="card-body">
                  <h4>{{apartmentData.name}}</h4>
                    <div class="d-flex justify-content-between">
                        <p class="card-text m-0"><b>{{apartmentData.address}}</b></p>
                        <span><i class="fa-solid fa-star"></i> 5,0</span>
                    </div>


                    <p class="card-text m-0">{{apartmentData.description}}</p>

                    <p class="card-text m-0"><b>{{apartmentData.price}}€</b> a notte</p>
                </div>

        </div>

</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.card{
    border: none;

    .card-body{
        padding-left: 0;

        & h4{
          font-weight: bold;
        }
    }
}
img{
    border-radius: 10px;
}

</style>
