  <script>

  import {assistance, community, hosting, boolbnb} from '../../data/footer-store.js'
  export default {
    name: 'Footer',
    data(){
      return{
        assistance,
        community,
        hosting,
        boolbnb
      }
    },
    methods :{},

    mounted(){}
  }
  </script>

<template>
  <footer>
    <div class="container py-5">

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
        <div class="col mb-4">
          <h5>Assistenza</h5>
          <ul class="p-0">
            <li v-for="(link, index) in assistance" :key="index">
              <a :href="link.link">{{ link.label}}</a>
            </li>
          </ul>
        </div>
        <div class="col mb-4">
          <h5>Community</h5>
          <ul class="p-0">
            <li v-for="(link, index) in community" :key="index">
              <a :href="link.link">{{ link.label}}</a>
            </li>
          </ul>
        </div>
        <div class="col mb-4">
          <h5>Ospitare</h5>
          <ul class="p-0">
            <li v-for="(link, index) in hosting" :key="index">
              <a :href="link.link">{{ link.label}}</a>
            </li>
          </ul>
        </div>
        <div class="col mb-4">
          <h5>Boolbnb</h5>
          <ul class="p-0">
            <li v-for="(link, index) in boolbnb" :key="index">
              <a :href="link.link">{{ link.label}}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>


</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

footer{
  background-color: $low-black;

  h5{
    color: $brand-main;
    font-weight: bold;
    margin-bottom: 2rem;
  }

  ul{
    list-style: none;
    li{
      margin-bottom: 1rem;
      a{
        text-decoration: none;
        color: $light-text;
        &:hover{
          color: $brand-blue;
        }
      }
    }
  }
}

</style>
