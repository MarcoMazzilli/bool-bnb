<script>
import {store} from '../../data/store';
import axios from 'axios';
export default {
  name: 'Header',
  data(){
    return{
      apiKey: store.apiKey,

    }
  },
  methods :{

  },

  mounted(){

  }

}

</script>

<template>
  <header>
    <div class="container h-100">

      <div class="d-flex align-items-center h-100">

        <div class="w-100 h-100">
          <!-- <a href="/" class="h-100 logo"> -->
            <router-link :to="{name: 'home' }" class=" h-100 logo" >
            <img class="h-100" src="/img/boolbnb-sfondo-trasparente-ritagliato.png" alt="">
          </router-link>
          <!-- </a> -->
        </div>


        <div class="flex-shrink-1 d-lg-none">

          <div class="dropdown">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/login">Login</a></li>
              <li><a class="dropdown-item" href="/register">Register</a></li>
            </ul>
          </div>

        </div>

        <div class="d-none d-lg-block user">
          <a class="me-2" href="/login">Login</a>
          <a href="/register">Register</a>
        </div>

      </div>
    </div>

  </header>
</template>


<style lang="scss" scoped>
@use '../../scss/var' as *;

header{
  // background-color: $low-black;
  box-shadow: 0 2px 2px rgba($color: #000000, $alpha: .1);
  height: 50px;

  .btn{
    background-color:$light-text;
    transition: all .4s;
    color: $brand-blue;
    &:hover{
      background-color: $brand-main;
    }
  }
  .user{
    a{
      color: $brand-blue;
      text-decoration: none;
      &:hover{
        text-decoration: underline;
      }
    }
  }
}


</style>
