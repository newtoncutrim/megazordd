<template>
	<div class="alert al ert-dismissible" :class="typeClass">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		
		<h4 v-if="title"><i class="icon fa" :class="icon"></i> {{title}}</h4>
		<i v-if="!title" class="icon fa" :class="icon"></i>

		{{text}}
	</div>		
</template>

<script>
	export default {
		props: ['typeClass', 'icon', 'title', 'text']
	}
</script>
