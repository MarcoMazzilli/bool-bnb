<script>
import {store} from'../data/store.js';
import Header from '../views/guest/components/header.vue';
export default {
    name: 'home',

    components:{Header},
    methods:{},
    computed:{},
    mounted(){}
}
</script>

<template>
  <div class="main_wrapper">
    <Header  />
    <div class="container debug">

      <h1>home guest</h1>
    </div>

  </div>
</template>

<style lang="scss" >
@import '../scss/mainGuest.scss'
</style>
