<template>
  <div>
    <money class="form-control" v-model="price" v-bind="money"></money>
    <input type="hidden" :name="name" :required="required" :value="price">
  </div>
</template>
 
<script>
  import {Money} from 'v-money'
 
  export default {
    components: {Money},
 	props : ['name', 'value','required'],
    data () {
      return {
        price: this.value,
        money: {
          decimal: ',',
          thousands: '.',
          prefix: 'R$ ',
          precision: 2,
          masked: false
        }
      }
    }
  }
</script> 