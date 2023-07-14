<script>
export default {
  name: 'Header',
}
</script>
<template>
  <header>
    <div class="container h-100">

      <div class="row d-flex align-items-center h-100">

        <div class="col col-2 d-none d-sm-block h-100">
          <a href="/" class="h-100 logo">
            <img class="h-100" src="/img/boolbnb-sfondo-trasparente.png" alt="">
          </a>
        </div>

        <div class="col col-11 col-sm-9 col-lg-8">

          <form role="search">
            <div class="input-group flex-nowrap">
              <input type="text" class="form-control" placeholder="Cerca per indirizzo" aria-label="Username" aria-describedby="addon-wrapping">
              <span class="input-group-text search" id="addon-wrapping">
                <i class="fa-solid fa-magnifying-glass"></i>
              </span>
            </div>
          </form>

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
  height: 70px;

  span.search{
    background-color: $brand-main;
    transition: all .3s;
    i{
      transition: all .3s;
      color: $brand-blue;
    }
    &:hover{
      background-color: white;
      i{
        color: $brand-main;
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
