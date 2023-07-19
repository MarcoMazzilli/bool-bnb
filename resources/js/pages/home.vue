<script>
import {store} from '../../data/store';
import axios from 'axios';
import Jumbotron from '../components/jumbotron.vue';
export default {
    name: 'Home',
    data(){
        return{}
    },
    components:{Jumbotron},
    methods :{},
    mounted(){
        console.log('Home page!')
    }
}
</script>

<template>
    <div class="home_container" id="home-page">

        <h1>home page</h1>

        <Jumbotron/>

    </div>
</template>

<style lang="scss" scoped>

</style>
