<script>
import InputSearch from './inputSearch.vue';

export default {
  name: 'Jumbotron',
  components:{
    InputSearch
  },
}
</script>


<template>

    <div class="jumbo mb-2 d-flex justify-content-center align-items-center">
        <div class="cover d-flex justify-content-end">
          <img src="/img/jumbotron-img.jpg" class="jumbotron-img" alt="home">
          <!-- <img src="/img/jumbotron.gif" class="jumbotron-img" alt="home"> -->
        </div>


          <div class="text">
            <span><h3 class="title mt-1">Trova alloggi su BoolBnb</h3></span>
            <span class="subtitle">Scopri interi alloggi o stanze per ogni tipo di viaggio</span>

            <inputSearch />
          </div>
    </div>


</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.jumbo{
  width: 100%;
  height: calc(80vh - 70px);
  .cover{
    width: 100%;
    height: 100%;
    position: relative;
  }
  .jumbotron-img{
    width: 100%;
    height: auto;
    filter: brightness(1.0);
    object-fit: cover;
  }
  .text {
    position: absolute;
    bottom: 40%;
    left: 15%;
    z-index: 1;
    background-color: white;
    padding: 50px;
    border-radius: 20px;
    box-shadow: 1px 1px 70px rgba($color: #000000, $alpha: .2);
    .subtitle {
      color: gray;
      margin: 10px 0;
    }
    .title {
      color: $low-black;
    }
  }
}

// Media Query

@media (max-width: 670px){
  .jumbo{
  width: 100%;
  height: calc(75vh - 70px);
  .text{
    padding: 20px;
    bottom: 50%;
  }
  .subtitle {
    display: none;
    }
  }
}

</style>

