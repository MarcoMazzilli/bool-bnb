<script>
import {store} from '../../data/store';
import axios from 'axios';
export default {
    name: 'AdvancedSearch',
    data(){
        return{}
    },
    components:{},
    methods :{
      searchByRange(){
        // data = {
        //   longitude : 12.29600,
        //   latitude : 44.43871,
        //   radius : 20
        // }
        axios.post('http://127.0.0.1:8000/api/find')
        .then(result =>{
          console.log('risultato ===>',result)
        }).catch(error => {
          console.log('Errori ===>',error)
        })
      }
    },
    mounted(){
        console.log('Advanced Search!')
    }
}
</script>

<template>
    <div class="AdvancedSearch_container" id="AdvancedSearch-page">

        <h1>Advanced Search</h1>
        <button class="btn btn-danger" @click="searchByRange()">Sed request</button>

    </div>
</template>

<style lang="scss" scoped>

</style>
