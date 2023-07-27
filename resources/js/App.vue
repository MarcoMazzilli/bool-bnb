<script>
import {store} from'../data/store.js';
import Header from '../js/components/header.vue';
import Footer from '../js/components/footer.vue';
import DebHeader from '../js/components/debug_header.vue';
export default {
    name: 'home',

    components:{
        Header,DebHeader, Footer
    },
    methods:{},
    computed:{},
    mounted(){}
}
</script>

<template>

    <Header  />

    <!--caricamento pagine virtuali  -->
    <router-view v-slot="{Component}">

        <component :is="Component">
        </component>

    </router-view>

    <Footer />

</template>

<style lang="scss" >
@import '../scss/guest/mainGuest.scss';
</style>
