<script>
import {store} from'../data/store.js';
import Header from '../js/components/header.vue';
import Footer from '../js/components/footer.vue';
export default {
    name: 'home',

    components:{
        Header, Footer
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
