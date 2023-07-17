<script>
import {store} from'../data/store.js';
import Header from '../js/components/header.vue';
import Jumbotron from '../js/components/jumbotron.vue';
export default {
    name: 'home',

    components:{
        Header,
        Jumbotron
    },
    methods:{},
    computed:{},
    mounted(){}
}
</script>

<template>

    <Header  />

    <Jumbotron  />

    <!-- <div class="container debug">

      <h1>home guest</h1>
    </div> -->


</template>

<style lang="scss" >
@import '../scss/guest/mainGuest.scss';
</style>
