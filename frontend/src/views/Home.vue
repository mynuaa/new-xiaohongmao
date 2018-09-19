<template>
  <div class="home">
    <div class="body-left">
      <Box  class="box-announcement"></Box>
      <Box  class="box-comment"></Box>
    </div>
    <div class="body-right">
      <Box  class="box-activity"></Box>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Box from '../components/Box.vue'

export default {
  name: 'home',
  components: {
    Box
  }
}
</script>

<style scoped lang="scss">
.home {
  display: flex;
  flex-direction: row;
  // text-align: center;
  justify-content: center;
}
.body-left {
  width: 40%;
  display: flex;
  flex-direction: column;
}
.body-right {
  width: 40%;
  display: flex;
  flex-direction: column;
}
.box-announcement {
  height: 50%;
}
</style>