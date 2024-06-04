<template>
	<span>
		<vue-editor v-if="!image" :id="name" v-model="editor.content" :editorToolbar="editor.customToolbar" ></vue-editor>
		<vue-editor 
			v-if="image"
			:id="name"
			v-model="editor.content"
			:editorToolbar="editor.customToolbar"
			useCustomImageHandler
      		@imageAdded="handleImageAdded"
		/>
		<input type="hidden" :name="name" :value="editor.content">
	</span>
 </template>
 
<script>
   import { VueEditor } from 'vue2-editor'
 
	export default {
	   	props : ['name', 'value', 'image', 'domain'],
		data : function() {
			return {
	       		editor : {
		         	customToolbar: [
			            ['bold', 'italic', 'underline'],
			            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
		      		],
		      		style : 'font-size:12px!important',
		      		content: this.value
	       		}
			}
	    },
	    components: {
			VueEditor
		} ,
		methods: {
			handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
				var formData = new FormData();
				formData.append('image', file);
				axios({
					url: `${this.domain}/cms/propostas/text-area-image-upload`,
					method: 'POST',
					data: formData,
  					headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
				}).then((result) => {
					let url = result.data.url
					Editor.insertEmbed(cursorLocation, 'image', url);
					resetUploader();
				}).catch((err) => {})
			}
		}
   }
 </script> 

<style lang="scss">
	#description{
		height: 200px!important;
	}
	.ql-editor{
		height: 200px!important;
		font-size: 14px !important;
		font-family: inherit !important;
	}
</style>
