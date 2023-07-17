<script>
export default {
  name: 'Jumbotron',
}
</script>


<template>

    <div class="jumbo d-flex justify-content-center align-items-center">

        <h1>Inserire un testo</h1>

    </div>


</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.jumbo{
    height: calc(100vh - 70px);
    background-image: url('https://services.meteored.com/img/article/italia-carta-natura-ispra-almeno-37-tipi-di-paesaggio-quali-sono-1637578644759_1280.jpg');
    background-size: cover;
    background-position-y: bottom;
    color: $low-black;
}
</style>
