<template>
  <div>
	{{ items }}
    <div v-if="items.length">
      <carousel
        v-if="items.length"
        :pagination-enabled="items.length > 0 ? true : false"
        :paginationPadding="15"
        :paginationSize="15"
        :loop="images.length > 0 ? true : false"
        :autoplay="images.length > 0 ? true : false"
        :autoplay-timeout="6000"
				:perPageCustom="[[352, 1], [425, 2], [768, 3], [1024, 4]]"
      >
        <slide v-for="(item,index) in items" :key="index">
          <div :style="`background-image: url(${item.image});`" class="banner"></div>
        </slide>
      </carousel>
    </div>
  </div>
</template>
<script>
import { Carousel, Slide } from 'vue-carousel';
export default {
  props: ['images'],
  components: {
    Carousel,
    Slide
  },
  data(){
    return {
      items: [],
    }
  },
  mounted(){
    let el = this;
    $(document).ready(function() {
      el.items = el.images;
    });
  }
}
</script>

<style lang="scss" scoped>
@import "resources/assets/sass/website/_variables.scss";
.banner{
  height: 350px;
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
}
</style>