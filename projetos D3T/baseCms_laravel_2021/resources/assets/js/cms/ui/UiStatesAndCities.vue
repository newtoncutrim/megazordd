<template>
  <div>
    <div class="row form-group">
      <label
        class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left"
        >CEP*</label
      >
      <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
        <the-mask
          aria-label="CEP"
          :masked="true"
          name="CEP"
          class="form-control"
          v-model="cep"
          :mask="['#####-###']"
          required
        />
      </div>
    </div>

    <div class="row form-group">
      <label
        class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left"
        >Estado*</label
      >
      <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
        <select
          class="form-control"
          @change="changeCity($event)"
          id="select-state"
          aria-label="Estado"
          name="state"
          v-model="form.state"
          required
        >
          <option disabled value="">Por favor, selecione um estado</option>
          <option
            v-for="(item, index) in states"
            :key="index"
            :value="item.sigla"
          >
            {{ item.nome }}
          </option>
        </select>
      </div>
    </div>

    <div class="row form-group">
      <label
        class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left"
        >Cidade*</label
      >
      <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
        <select
          class="form-control"
          aria-label="Cidade"
          name="city"
          v-model="form.city"
          required
        >
          <option disabled value="">
            {{ placeholder_city }}
          </option>
          <option
            v-for="(item, index) in cities_state.cidades"
            :key="index"
            :value="item"
            required
          >
            {{ item }}
          </option>
        </select>
      </div>
    </div>

    <div class="row form-group">
      <label
        class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left"
        >Rua*</label
      >
      <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
        <input
          class="form-control"
          aria-label="Rua"
          type="text"
          name="street"
          id="street"
          v-model="form.street"
          required
        />
      </div>
    </div>

    <div v-if="pages" class="row form-group">
      <label
        class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left"
        >Bairro</label
      >
      <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
        <input
          class="form-control"
          aria-label="Bairro"
          type="district"
          name="district"
          id="district"
          v-model="form.district"
        />
      </div>
    </div>

    <div class="row form-group">
      <label
        class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left"
        >Número</label
      >
      <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
        <input
          class="form-control"
          aria-label="Número"
          type="number"
          name="number"
          id="number"
          v-model="form.number"
        />
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import cities_json from "./locations/city.json";

export default {
  props: ["endpoint", "login", "session", "edit", "pages"],
  data() {
    return {
      button: "Cadastrar-se",
      disabled: false,
      cep: "",
      change_edit: 0,
      form: {
        state: "",
        city: "",
        cep: this.cep,
        street: "",
        number: "",
        district: "",
      },
      states: cities_json.estados,
      cities_state: "",
      placeholder_city: "Por favor, selecione um estado primeiro",
    };
  },

  created() {
    if (this.edit) {
      let address = JSON.parse(this.edit);
      this.cep = address.cep;
      this.form.street = address.street;
      this.form.state = address.state;
      this.form.city = address.city;
      this.form.number = address.number;
      this.change_edit = 1;
      if (this.pages) {
        this.form.district = address.district;
      }
    }
  },

  watch: {
    cep() {
      this.ViaCep();
    },
  },

  methods: {
    ViaCep() {
      if (this.cep) {
        if (this.cep.length == 9) {
          axios
            .get("https://viacep.com.br/ws/" + this.cep + "/json/")
            .then((response) => {
              if (response.data.erro) {
                this.$swal("Oops!", "CEP Inválido!", "error");
                this.cep = "";
              } else if (this.change_edit == 0 && this.pages != "true") {
                this.form.state = response.data.uf;
                this.form.city = response.data.localidade;
                this.form.street = response.data.logradouro;
              } else if (this.change_edit == 1 && this.pages != "true") {
                this.form.street = response.data.logradouro;
                this.change_edit = 0;
              } else if (this.change_edit == 0 && this.pages) {
                this.form.state = response.data.uf;
                this.form.city = response.data.localidade;
                this.form.street = response.data.logradouro;
                this.form.district = response.data.bairro;
              } else if (this.change_edit == 1 && this.pages) {
                this.form.street = response.data.logradouro;
                this.form.district = response.data.bairro;
                this.change_edit = 0;
              }
            })
            .catch((error) => {})
            .finally(() => {
              this.changeCityEdit(this.form.state);
            });
        }
      }
    },

    changeCityEdit(event) {
      this.placeholder_city = "Por favor, selecione uma cidade";
      this.cities_state = this.states.filter(function (state) {
        return state.sigla === event;
      });
      this.cities_state = this.cities_state[0];
    },

    changeCity(event) {
      this.placeholder_city = "Por favor, selecione uma cidade";
      this.cities_state = this.states.filter(function (state) {
        return state.sigla === event.target.value;
      });
      this.cities_state = this.cities_state[0];
    },
  },
};
</script>