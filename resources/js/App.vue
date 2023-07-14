<script>
import {store} from'../data/store.js';
import Header from '../js/components/header.vue';
export default {
    name: 'home',

    components:{Header},
    methods:{},
    computed:{},
    mounted(){}
}
</script>

<template>

    <Header  />

    <div class="container debug">

      <h1>home guest</h1>
    </div>


</template>

<style lang="scss" >
@import '../scss/guest/mainGuest.scss';
</style>
