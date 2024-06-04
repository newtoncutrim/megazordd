<template>
	<div class="box box-widget">
		<div class="box-header with-border">
			<h3 class="box-title">{{title}}</h3>
		</div>
		
		<form :class="formClass" :action="url" v-on:submit="btnLoading" :method="method == 'GET' ? method : 'POST'" enctype="multipart/form-data">
			<input type="hidden" name="_token" :value="token" />
			<input type="hidden" name="_method" :value="method" />
			<div class="box-body">
				
				<slot></slot>
				
			</div>			
			<div class="box-footer">
				<button type="submit" class="btn btn-success btn-flat ctaButton" :disabled="btnGravar.disabled"><i :class="btnGravar.icon"></i> {{ btnGravar.text }}</button>
				<a v-if="cancelUrl" :href="cancelUrl" class="btn btn-default btn-flat">Cancelar</a>
			</div>
			
		</form>
	</div>
</template>

<script>
	export default {
		props: ['title', 'url', 'cancelUrl', 'token', 'method', 'formClass'],
		data : function(){
			return {
				btnGravar : {
					'icon' : 'fa fa-check',
					'text' : 'Gravar',
					'disabled' : false
				}
			}
		},
		methods : {
			btnLoading : function(e){
				this.btnGravar.icon = 'fa fa-spinner fa-pulse';
				this.btnGravar.text = 'Gravando';
				this.btnGravar.disabled = true;
			}
		}
	}
</script>
