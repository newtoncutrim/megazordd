<template>
    <select
        class="form-control"
        :name="name"
        :id="id"
        :required="required"
        >
        <option value="" :selected="!selected || selected == 0">Selecione</option>
        <option v-for="(option, index) in options" :key="index" :value="option.value" :selected="(selected == option.value) || false">{{option.label}}</option>
    </select>
</template>

<script>
    export default {
        props: ['name', 'id', 'required', 'options', 'selected'],
        created() {
            this.options = JSON.parse(this.options);
        }
    }
</script>
