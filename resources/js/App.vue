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



    <!--caricamento pagine virtuali  -->
    <router-view v-slot="{Component, route}">

        <component :is="Component">
        </component>

    </router-view>

</template>

<style lang="scss" >
@import '../scss/guest/mainGuest.scss';
</style>
