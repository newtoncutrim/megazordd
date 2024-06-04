<template>
  <div class="">
    <div>
      <label for="status" class="col-sm-2 control-label">Cidade*</label>

      <div class="col-sm-4">
        <select
        class="form-control"
        :name="nome_cidade"
        :required="required"
        v-model="selected_cidade"
        >
          <option value="" :selected="!selected_cidade || selected_cidade == 0">Selecione</option>
          <option v-for="option in cidades" :value="option.value" :selected="(selected_cidade == option.value) || false">{{option.label}}</option>
        </select>
      </div>
    </div>
    <div v-if="selected_cidade != null && selected_cidade != ''">
      <label for="status" class="col-sm-2 control-label">Bairro*</label>

      <div class="col-sm-4">
        <select
        class="form-control"
        :name="nome_bairro"
        :required="required"
        >
          <option value="" :selected="!selected_bairro || selected_bairro == 0">Selecione</option>
          <option v-if="option.cidade_id == selected_cidade" v-for="option in bairros" :value="option.value" :selected="(selected_bairro == option.value) || false">{{option.label}}</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      props: ['nome_cidade', 'nome_bairro', 'required', 'cidades', 'bairros', 'selected_cidade', 'selected_bairro'],
    
    }
</script>
