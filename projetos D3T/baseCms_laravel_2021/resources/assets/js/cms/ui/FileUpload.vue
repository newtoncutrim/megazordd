<template>
  <div class="file-upload">
    <div class="form-group row align-items-baseline">
      <label
        for="name"
        class="col-xl-1 col-lg-1 col-sm-1 col-12 text-lg-right text-sm-left"
        ><strong>Arquivos*</strong></label
      >

      <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
        <input
          type="file"
          multiple="multiple"
          id="attachments"
          :accept="accept || '*'"
          @change="uploadFieldChange"
        />
        <label></label>
      </div>
    </div>
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label"></label>

      <div class="col-sm-10">
        <table class="table">
          <thead>
            <tr>
              <td>
                Selecionado:
                <strong
                  >{{ Number(upload_size / 1024 / 1024).toFixed(2) }}MB</strong
                >
              </td>
            </tr>
            <tr>
              <th>Arquivo</th>
              <th width="50px">Ação</th>
            </tr>
          </thead>
          <tbody>
            <tr v-cloak v-for="(attachment, index) in attachments" :key="index">
              <td>
                {{
                  attachment.name +
                  " (" +
                  Number((attachment.size / 1024 / 1024).toFixed(1)) +
                  "MB)"
                }}
              </td>
              <td>
                <button
                  type="button"
                  class="btn btn-xs btn-danger"
                  @click="removeAttachment(attachment)"
                  :disabled="loading"
                >
                  Remover
                </button>
              </td>
            </tr>
            <tr v-if="!attachments || attachments.length == 0">
              <td class="UpFile" colspan="2">Nenhum arquivo selecionado</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="box-footer">
      <button
        type="button"
        class="btn btn-success btn-flat ctaButton"
        @click="submit"
        :disabled="loading"
      >
        <span v-if="!loading">
          <i class="fa fa-upload"></i> Enviar Arquivos
        </span>
        <span v-if="loading">
          <i class="fa fa-spinner fa-pulse"></i> Enviando
        </span>
      </button>
      <a v-if="cancelUrl" :href="cancelUrl" class="btn btn-default btn-flat"
        >Cancelar</a
      >
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: {
    endpoint: String,
    cancelUrl: String,
    accept: String,
  },

  data() {
    return {
      attachments: [],
      data: new FormData(),
      percentCompleted: 0,
      upload_size: 0,
      loading: false,
    };
  },
  methods: {
    validate() {
      if (!this.attachments.length) {
        alert("Por favor, adicione um arquivo");
        return false;
      }

      return true;
    },

    getAttachmentSize() {
      this.upload_size = 0; // Reset to beginningƒ

      this.attachments.map((item) => {
        this.upload_size += parseInt(item.size);
      });

      this.upload_size = Number(this.upload_size.toFixed(1));

      this.$forceUpdate();
    },

    prepareFields() {
      for (var i = this.attachments.length - 1; i >= 0; i--) {
        this.data.append("attachments[]", this.attachments[i]);
      }
    },

    removeAttachment(attachment) {
      this.attachments.splice(this.attachments.indexOf(attachment), 1);
      this.getAttachmentSize();
    },

    // This function will be called every time you add a file
    uploadFieldChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;

      for (var i = files.length - 1; i >= 0; i--) {
        this.attachments.push(files[i]);
      }

      this.getAttachmentSize();

      document.getElementById("attachments").value = [];
    },

    submit() {
      this.prepareFields();

      if (!this.validate()) {
        return false;
      }

      this.loading = true;

      var config = {
        headers: { "Content-Type": "multipart/form-data" },
        onUploadProgress: function (progressEvent) {
          this.percentCompleted = Math.round(
            (progressEvent.loaded * 100) / progressEvent.total
          );
          // window.Event.fire('percent', this.percentCompleted);
          this.$forceUpdate();
        }.bind(this),
      };

      // Make HTTP request to store announcement
      axios
        .post(this.endpoint, this.data, config)
        .then(
          function (response) {
            if (response.data) {
              this.resetData();
              this.$swal(
                "Cadastrado!",
                "Arquivos enviados com sucesso!",
                "success"
              ).then((value) => {
                location.reload();
              });
            } else {
              this.$swal(
                "Oops!",
                "Erro ao enviar os arquivos :( Tente novamente",
                "error"
              );
            }
          }.bind(this)
        ) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
        .catch(function (error) {
          this.$swal(
            "Oops!",
            "Erro ao enviar os arquivos :( Tente novamente",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
    },

    // We want to clear the FormData object on every upload so we can re-calculate new files again.
    // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
    resetData() {
      this.data = new FormData(); // Reset it completely
      this.attachments = [];
    },
  },
};
</script>
