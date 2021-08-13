<template>
  <div class="marginDiv" :style="{'height': h}" ></div>
</template>

<script>
export default {
props:{
    h:{
        default:'40px',
        value:String
    }
}
}
</script>

<style>

</style>