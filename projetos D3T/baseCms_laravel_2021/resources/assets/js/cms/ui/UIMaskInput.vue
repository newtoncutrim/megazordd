<template>
  <input type="text" :name="name" :class="className" :id="name" v-model="inputValue" v-mask="mask" :required="required">
</template>
 
<script>
  export default {
    props : ['name', 'value', 'required', 'className', 'mask'],
    data(){
      return {
        inputValue: ''
      }
    },
    mounted(){
      this.inputValue = this.value
    }
  }
</script>