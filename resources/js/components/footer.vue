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

      <div class="row row-cols-4 row-cols-md-2 row-cols-lg-4">

        <!--------------------------------Assistenza---------------------------------->
        <div class="col mb-4 p-0">

          <div class="dropdown d-md-none">
            <a class="btn btn-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Assistenza
            </a>

            <ul class="dropdown-menu">
              <li v-for="(link, index) in assistance" :key="index">
                <a class="dropdown-item" :href="link.link">{{ link.label}}</a>
              </li>
            </ul>
          </div>

          <div class="d-none d-md-block">
            <h5>Assistenza</h5>
            <ul class="p-0">
              <li v-for="(link, index) in assistance" :key="index">
                <a :href="link.link">{{ link.label}}</a>
              </li>
            </ul>
          </div>

        </div>

        <!--------------------------------Community---------------------------------->

        <div class="col mb-4 p-0">

          <div class="dropdown d-md-none">
            <a class="btn btn-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Community
            </a>

            <ul class="dropdown-menu">
              <li v-for="(link, index) in community" :key="index">
                <a class="dropdown-item" :href="link.link">{{ link.label}}</a>
              </li>
            </ul>
          </div>

          <div class="d-none d-md-block">
            <h5>Community</h5>
            <ul class="p-0">
              <li v-for="(link, index) in community" :key="index">
                <a :href="link.link">{{ link.label}}</a>
              </li>
            </ul>
          </div>

        </div>

        <!--------------------------------Ospitare---------------------------------->

        <div class="col mb-4 p-0">

          <div class="dropdown d-md-none">
            <a class="btn btn-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ospitare
            </a>

            <ul class="dropdown-menu">
              <li v-for="(link, index) in hosting" :key="index">
                <a  class="dropdown-item" :href="link.link">{{ link.label}}</a>
              </li>
            </ul>
          </div>

          <div class="d-none d-md-block">

            <h5>Ospitare</h5>
            <ul class="p-0">
              <li v-for="(link, index) in hosting" :key="index">
                <a :href="link.link">{{ link.label}}</a>
              </li>
            </ul>
          </div>

        </div>

        <!--------------------------------Boolbnb---------------------------------->

        <div class="col mb-4 p-0">

          <div class="dropdown d-md-none">
            <a class="btn btn-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Boolbnb
            </a>

            <ul class="dropdown-menu">
              <li v-for="(link, index) in boolbnb" :key="index">
                <a  class="dropdown-item" :href="link.link">{{ link.label}}</a>
              </li>
            </ul>
          </div>

          <div class="d-none  d-md-block">

            <h5>Boolbnb</h5>
            <ul class="p-0">
              <li v-for="(link, index) in boolbnb" :key="index">
                <a :href="link.link">{{ link.label}}</a>
              </li>
            </ul>
          </div>

        </div>

      </div>
    </div>

    <div class="footer-bottom text-center">
      © 2023 BoolBnb Andrea ∙ Carlo ∙ Marco ∙ Marica
    </div>
  </footer>


</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

footer{
  background-color: $low-black;
  padding-bottom: 15px;

  .dropdown{
  width: 95%;
  }
  .btn-brand{
    background-color: $brand-main;
    min-width: 100%;
    color: white;
  }

  .dropdown-menu{
    background-color: $low-black;
  }

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
  .footer-bottom{
    color:$brand-main;
  }

  .container{
    padding-bottom: 0 !important;
  }
}

// da modificare i px
@media screen and (max-width: 576px) {
.col {
  display: flex;
  justify-content: center;
  width: 50%;
  .dropdown{

    width: 80%;
  }
}
.footer-bottom{
  display: none;
}
}

</style>
