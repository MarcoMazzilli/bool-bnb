<script>
import axios from 'axios';

export default {
    name: 'ApartmentCard',
    props: {
        apartment: Object
    },
}
</script>

<template>
    <div class="container py-5">

        <div class="card" style="width: 22rem; height: 22rem;">
                <!-- Immagine -->
                <img src="https://www.miprendoemiportovia.it/wp-content/uploads/2020/10/Casa-Nea-Sardegna.jpg" class="card-img-top" alt=""  style="width: 22rem; height: 22rem;">

                <!-- Testo -->
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-text m-0"><b>Indirizzo</b></p>
                        <span><i class="fa-solid fa-star"></i> 5,0</span>
                    </div>


                    <p class="card-text m-0">Host privato/professionista</p>
                    <p class="card-text m-0">Date random</p>
                    <p class="card-text m-0"><b>€</b> notte</p>
                </div>

        </div>

    </div>


</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.card{
    border: none;
    .card-body{
        padding-left: 0;
    }
}
img{
    border-radius: 10px;
}

</style>
