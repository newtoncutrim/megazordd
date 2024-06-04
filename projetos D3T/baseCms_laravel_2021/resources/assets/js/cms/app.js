import Vue from 'vue';
import "bootstrap";
import "admin-lte";


import Vuetify from 'vuetify';
Vue.use(Vuetify);

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import Swal from "sweetalert2/dist/sweetalert2.js";

Vue.use(VueSweetalert2);

const Toast = Swal.mixin({
	toast: true,
	position: "top",
	timer: 1500,
	showConfirmButton: true
});
window.Toast = Toast;

import money from "v-money";
Vue.use(money, { precision: 4 });

import VueTheMask from "vue-the-mask";
Vue.use(VueTheMask);

import vClickOutside from "v-click-outside";
Vue.use(vClickOutside);

import VueFlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
Vue.use(VueFlatPickr);

const flatpicker_configs = {
	enableTime: true,
	altInput: true,
	dateFormat: "Y-m-d H:i",
	altFormat: "d/m/Y H:i",
	time_24hr: true,
	disableMobile: true,
}
window.flatpickerConfig = flatpicker_configs;

/* import tinymce from 'tinymce'; */
import Axios from "axios";
import Pagination from 'vue-pagination-2';

import ContentHeader from "./ui/ContentHeader.vue";
import UIForm from "./ui/UIForm.vue";
import UIPhone from "./ui/UIPhone.vue";
import UIMoney from "./ui/UIMoney.vue";
import UITextarea from "./ui/UITextarea.vue";
import UIMultiSelect from "./ui/UIMultiSelect.vue";
import UISelectWithParse from "./ui/UISelectWithParse.vue";
import UISelect from "./ui/UISelect.vue";
import Tabs from "./ui/Tabs.vue";
import FileUpload from "./ui/FileUpload.vue";
import DataTable from "./ui/DataTable.vue";
import DataTableStamp from "./ui/DataTableStamp.vue";
import UIPercent from "./ui/UIPercent.vue";
import UIMaskInput from "./ui/UIMaskInput.vue";
import Alert from "./ui/Alert.vue";
import Checkboxes from "./ui/Checkboxes.vue";
import Radios from "./ui/Radios.vue";
import DropdownList from "./ui/DropdownList.vue";
import DropdownEvents from "./ui/DropdownEvents.vue";
import CidadeBairro from "./ui/Cidade-bairro.vue";

Vue.component('pagination', Pagination);
Vue.component("content-header", ContentHeader);
Vue.component("data-table", DataTable);
Vue.component("data-table-stamp", DataTableStamp);
Vue.component('file-upload', FileUpload);
Vue.component("tabs", Tabs);
Vue.component("ui-form", UIForm);
Vue.component("ui-select", UISelect);
Vue.component("ui-select-parse", UISelectWithParse);
Vue.component("multi-select", UIMultiSelect);
Vue.component("ui-textarea", UITextarea);
Vue.component("ui-money", UIMoney);
Vue.component("ui-phone", UIPhone);
Vue.component("ui-percent", UIPercent);
Vue.component("ui-mask-input", UIMaskInput);
Vue.component("alert", Alert);
Vue.component("checkboxes", Checkboxes);
Vue.component("radios", Radios);
Vue.component("dropdown-list", DropdownList);
Vue.component("dropdown-events", DropdownEvents);
Vue.component("cidade-bairro", CidadeBairro);


/* tinymce.init({
	selector: 'textarea#full_textarea',
	language: 'pt_BR',
	plugins: 'advlist lists',
	toolbar: 'undo redo bold italic strikethrough | numlist bullist | alignleft aligncenter alignright alignjustify',
	height: "400",
	language_url: '/langs/pt_BR.js',
});


tinymce.init({
	selector: "textarea#full_textarea_description",
	language: 'pt_BR',
	relative_urls: false,
	paste_data_images: true,
	image_title: true,
	automatic_uploads: true,
	images_upload_url: "/api/upload",
	file_picker_types: "image",
	height: "420",
	plugins: [
	  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	  "searchreplace wordcount visualblocks visualchars code fullscreen",
	  "insertdatetime media nonbreaking save table contextmenu directionality",
	  "emoticons template paste textcolor colorpicker textpattern"
	],
	toolbar1:
	  "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	toolbar2: "print preview media | forecolor backcolor emoticons",
	// override default upload handler to simulate successful upload
	file_picker_callback: function (cb, value, meta) {
	  var input = document.createElement("input");
	  input.setAttribute("type", "file");
	  input.setAttribute("accept", "image/*");
	  input.onchange = function () {
		var file = this.files[0];
  
		var reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onload = function () {
		  var id = "blobid" + new Date().getTime();
		  var blobCache = tinymce.activeEditor.editorUpload.blobCache;
		  var base64 = reader.result.split(",")[1];
		  var blobInfo = blobCache.create(id, file, base64);
		  blobCache.add(blobInfo);
		  cb(blobInfo.blobUri(), {title: file.name});
		};
	  };
	  input.click();
	}
  }); */

const app = new Vue({
	el: "#app",
	vuetify: new Vuetify(),
});