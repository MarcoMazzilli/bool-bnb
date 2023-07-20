<script>
import {store} from '../../data/store';
import axios from 'axios';
import Jumbotron from '../components/jumbotron.vue';
import ApartmentCard from '../components/apartmentCard.vue'
export default {
    name: 'Home',
    data(){
        return{}
    },
    components:{Jumbotron, ApartmentCard },
    methods :{

        getApartment(){
            axios.get()
            .then(result =>{
                console.log(result.data)
            })
        }

    },
    mounted(){
        console.log('Home page!')
    }
}
</script>

<template>
    <div class="home_container" id="home-page">

        <Jumbotron/>

        <div class="container py-5">

          <ApartmentCard />
          <ApartmentCard />
          <ApartmentCard />
          <ApartmentCard />
          <ApartmentCard />
          <ApartmentCard />

        </div>


    </div>
</template>

<style lang="scss" scoped>

</style>
