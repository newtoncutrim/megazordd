<template>
  <div>
    <div class="form-group row">
      <label for="international" class="col-sm-2 control-label">Internacional?</label>
      <div class="col-sm-10">
        <input
          type="checkbox"
          aria-label="Internacional"
          name="international"
          id="international"
          v-model="model_international"
          value="1"> Sim
      </div>
    </div>
    <div class="form-group row" v-if="!model_international">
      <label for="state" class="col-sm-2 control-label">Estado*</label>
      <div class="col-sm-6">
        <select
          class="form-control"
          required
          v-model="model_state"
          id="state"
          name="state"
        >
          <option
            v-for="(option, index) in select_state"
            :key="index"
            :value="option.value"
          >
            {{ option.label }}
          </option>
        </select>
      </div>
    </div>
    <div class="form-group row" v-if="!model_international">
      <label for="city" class="col-sm-2 control-label">Cidade*</label>
      <div class="col-sm-6">
        <select
          class="form-control"
          required
          v-model="model_city"
          id="city"
          name="city"
        >
          <option
            v-for="(option, index) in select_cities"
            :key="index"
            :value="option.value"
          >
            {{ option.label }}
          </option>
        </select>
      </div>
    </div>
  </div>
</template>
 
<script>
import brazil from "/public/cities/cidades.json";
export default {
  props: ["city", "state", "international"],
  data() {
    return {
      select_cities: [],
      select_state: [],
      model_state: "",
      model_city: "",
      model_international: "",
    };
  },

  created() {
    if (this.city) {
      this.model_city = this.city;
    }
    if (this.state) {
      this.model_state = this.state;
    }
    console.log("this.international");
    console.log(this.international);
    if (this.international != 0) {
      this.model_international = this.international;
    }
    for (var city of brazil.estados) {
      this.select_state.push({
        value: city.sigla,
        label: city.sigla + " - " + city.nome,
      });
    }
  },

  watch: {
    model_state() {
      this.select_cities = brazil.estados.filter((estado) => {
        if (estado.sigla == this.model_state) {
          return estado.cidades;
        }
      });
      if (this.select_cities[0]) {
        for (var city of this.select_cities[0].cidades) {
          this.select_cities.push({
            value: city,
            label: city,
          });
        }
      }
    },
  },
};
</script> 