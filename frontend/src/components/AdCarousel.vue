<template>
    <div id="adCarousel" class="carousel">
        <carousel :per-page="1" :navigate-to="adCarousel">
            <slide>
            Slide 1 Content
            </slide>
            <slide>
            Slide 2 Content
            </slide>
        </carousel>
    </div>
</template>

<script>
export default {
  name: "AdCarousel",
  props: {
    // isTwo:string
  },
  data: function() {
    
  },
  filters: {
    
  },
  methods :{
    

  },
  mounted() {
  },
};
</script>

<style <style lang="scss" scoped>
.carousel{
    display: inline-block;
    background-color: grey;
    width: 80%;
    margin-bottom: 20px;
}
</style>

