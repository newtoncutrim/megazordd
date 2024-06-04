<template>
  <input type="text" :name="name" :class="class_name" :id="name" v-model="inputModel" v-mask="['(##) ####-####', '(##) #####-####']" :required="required">
</template>

<script>
  export default {
    props : ['name', 'value','required', 'class_name'],
    data: () => {
      return {
        inputModel: ''
      }
    },
    mounted(){
      this.inputModel = this.value;
    },
    computed: {
      mask(){
        if(this.inputModel && this.inputModel.length == 14) return '(##) ####-####'

        return '(##) #####-####'
      }
    }
  }
</script>
