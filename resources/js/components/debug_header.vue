<script>
export default {
  name: 'Header',
}
</script>
<template>
    <!-- esempio di come fare i link con le rotte vue  -->
  <header class="debug-header">

    <router-link :to="{name: 'home' }" class="m-1 d_link" >Home</router-link>
    <router-link :to="{name: 'advancedSearch' }" class="m-1 d_link" >Search</router-link>
    <router-link :to="{name: 'apartment', params:{ slug: 'apartamentSlug'} }" class="m-1 d_link" >apartment</router-link>

  </header>
</template>



<style lang="scss" scoped>


</style>
