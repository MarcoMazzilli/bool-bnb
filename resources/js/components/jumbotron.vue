<script>
export default {
  name: 'Jumbotron',
}
</script>


<template>

    <div class="jumbo d-flex justify-content-center align-items-center">

        <h1>La tua casa, lontano da casa</h1>

    </div>


</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.jumbo{
    height: calc(35vh - 70px);
    background-image: url('https://s1.1zoom.me/b5050/755/360556-svetik_1920x1080.jpg');
    background-size: cover;
    background-position:center;
    color: $low-black;
    filter: brightness(1.0);
}
</style>
