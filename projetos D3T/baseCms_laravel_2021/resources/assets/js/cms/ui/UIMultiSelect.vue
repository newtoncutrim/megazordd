<template>
  <multiselect
    v-model="inputValue"
    :tagPlaceholder="tagplacehold"
    :placeholder="placeholder"
    :name="name"
    label="name"
    track-by="id"
    :options="options"
    :multiple="multiple"
    :taggable="false"
    selectLabel="Pressione Enter para selecionar"
    deselectLabel="Pressione Enter para remover"
    @input="selector"
  ></multiselect>
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
  components: { Multiselect },
  props: [
    "name",
    "options",
    "placeholder",
    "multiple",
    "tagplacehold",
    "selected",
    "inputid",
  ],
  data() {
    return {
      inputValue: [],
    };
  },
  methods: {
    selector() {
      document.getElementById(this.inputid).value = JSON.stringify(
        this.inputValue
      );
    },
  },
  mounted() {
    this.inputValue = this.selected;
    this.selector();
  },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
