<template>
	<form @submit.prevent="submitForm" class="col-xl-9" method="POST">
		<div class="d-flex flex-lg-row flex-column align-items-center justify-content-center newsletter__form">
			<input type="hidden" name="_token" :value="this.token">
			<input aria-label="Seu nome" type="text" name="name" placeholder="Seu nome" v-model="form.name" required>
			<input aria-label="Seu e-mail" type="email" name="email" placeholder="Seu e-mail" v-model="form.email" required>
			<button type="submit" class="ui-button--big" :disabled="disabled">
				{{ button }}
			</button>
		</div>
	</form>
</template>

<script>
import axios from 'axios'
  export default {
  data () {
    return {
      button: 'CADASTRAR',
      disabled: false,
      form: {
        email: '',
				name: ''
      }
    }
  },
  methods: {
    resetForm () {
      this.form = {
        email: '',
				name: ''
      }
    },
    submitForm () {
      this.button = 'CADASTRANDO...'
      this.disabled = true
      axios.post(this.endpoint, this.form)
      .then(response => {
        this.resetForm()
        var msg = 'E-mail enviado com sucesso!'
        this.$swal("Enviado :)", msg, "success")
      })
      .catch(e => {
        var msg = 'Houve um erro ao enviar seus dados! Por favor, tente novamente.'
        this.$swal("Oops!", msg, "error")
        console.error(e)
      })
      .finally(() => {
        this.button = 'CADASTRAR'
        this.disabled = false
      })
    }
  },
  props:['endpoint', 'token']
}
</script>

<style lang="scss">
@import "resources/assets/sass/website/_variables.scss";

.newsletter__form {
	gap: 1rem;
	height: 100%;
	input {
		background: #FBFBFB;
		box-shadow: 0px 4px 0px #CD1844;
		border: none;
		border-radius: 70px;
		color: #231F20;
		flex: 35%;
		font-family: $font-one;
		font-style: normal;
		font-weight: normal;
		font-size: 19.0126px;
		line-height: 130%;
		max-width: 35%;
		outline: none;
		padding: 20px;
	}
	button {
		flex: 25%;
		max-width: 25%;
		@media screen and (max-width: 1500px) and (min-width: 1024px) {
			font-size: 15px;
		}
	}
	@media screen and (max-width: 1200px) {
		margin-top: 30px;
		button {
			padding: 20px;
		}
	}
	@media screen and (max-width: 1024px) {
		button {
			flex: 50%;
		}
	}
	@media screen and (max-width: 991px) {
		margin-top: 30px;
		button,
		input {
			flex: none;
			max-width: none;
			width: 70%;
			margin-bottom: 15px;
		}
	}
	@media screen and (max-width: 768px) {
		input,
		button {
			max-width: none;
			width: 100%;
			margin-bottom: 25px;
		}
	}
}
</style>