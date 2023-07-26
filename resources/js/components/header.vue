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

      <div class="row d-flex align-items-center h-100">

        <div class="col col-2 d-none d-sm-block h-100">
          <!-- <a href="/" class="h-100 logo"> -->
            <router-link :to="{name: 'home' }" class=" h-100 logo" >
            <img class="h-100" src="/img/boolbnb-sfondo-trasparente.png" alt="">
          </router-link>
          <!-- </a> -->
        </div>

        <div class="col col-11 col-sm-9 col-lg-8">

            <div class="input-group flex-nowrap " id="" >


            </div>

        </div>

        <!-- TODO: sistemare l'icona quando è in mobile (va leggerente  sinistra)-->

        <div class="col col-1 d-lg-none ">

          <div class="dropdown">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/login">Login</a></li>
              <li><a class="dropdown-item" href="/register">Register</a></li>
            </ul>
          </div>

        </div>


        <div class="col col-2 d-none d-lg-block user">
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

  span.search{
    background-color: white;
    transition: all .3s;
    i{
      transition: all .3s;
      color: $brand-main;

    }
    &:hover{
    background-color: $brand-main;
      i{
      color: $brand-blue;
      }
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
