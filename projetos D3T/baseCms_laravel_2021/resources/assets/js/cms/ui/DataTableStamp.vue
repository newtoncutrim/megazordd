<template>
  <div class="box box-widget">
    <div class="box-header">
      <div class="row">
        <div class="col-md-8 col-sm-6">
          <h3 class="box-title">{{ title }}</h3>
        </div>
        <div v-if="busca != 'false'" class="col-md-4 col-sm-6">
          <form method="GET" class="form-horizontal" :action="url">
            <div class="input-group">
              <input
                type="text"
                name="busca"
                class="ml-2 form-control"
                placeholder="Buscar por"
                :value="busca"
              />

              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary btn-flat h-100">
                  <i class="fa fa-search"></i>
                </button>
                <a
                  :href="url"
                  class="btn btn-default btn-flat h-100"
                  data-toggle="tooltip"
                  title="Limpar Busca"
                >
                  <i class="fa fa-list"></i>
                </a>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="box-body">
      <slot></slot>

      <form
        v-if="items.data.length > 0"
        :class="formClass"
        v-on:submit.prevent="confirmDelete"
        :action="url + '/destroy'"
        method="POST"
      >
        <input type="hidden" name="_token" :value="token" />
        <input type="hidden" name="_method" value="DELETE" />
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th v-if="!notDeletable" align="center" width="50px">
                <input
                  class="checkbox-delete"
                  id="checkbox-delete-origin"
                  type="checkbox"
                  name="registro[]"
                  data-toggle="tooltip"
                  title="Marcar tudo"
                  v-on:click="checkAll"
                  @click="checkDelete"
                />
              </th>
              <th v-for="(title, index) in titles" :key="index">{{ title }}</th>
              <th v-if="actions != 'false'">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items.data" :key="index">
              <th v-if="!notDeletable" align="center" class="v-middle">
                <input
                  @click="checkDelete"
                  class="checkbox-delete"
                  type="checkbox"
                  name="registro[]"
                  :value="item.id"
                />
              </th>

              <td
                v-for="(field, index) in item"
                :key="index"
                class="v-middle"
                :style="isMultiBadge(field) ? 'max-width: 300px' : ''"
              >
                <span v-if="field === null">{{ field }}</span>
                <span
                  v-html="field"
                  v-else-if="!field.type && !Array.isArray(field)"
                ></span>
                <span v-else-if="field.type == 'img'">
                  <img
                    :src="field.src"
                    style="max-width: 150px; max-height: 150px"
                  />
                </span>
                <span
                  v-else-if="field.type == 'config'"
                  class="badge"
                  style="font-size: 14px"
                  :class="'badge-' + field.style"
                  >{{ field.text }}</span
                >
                <span
                  class="mr-2 px-2 py-0 rounded-pill badge"
                  v-else-if="isMultiBadge(field)"
                  v-for="(campo, index) in field"
                  :key="index"
                  :class="'badge-' + campo.status"
                >
                  <span>{{ campo.text }}</span>
                </span>
                <span
                  v-else-if="field.type == 'badge'"
                  class="badge"
                  :class="'badge-' + field.status"
                  >{{ field.text }}</span
                >

                <span
                  v-else-if="field.type == 'action'"
                  v-for="(action, index) in item.actions"
                  :key="index"
                >
                  <a
                    data-toggle="tooltip"
                    class="btn btn-flat ml-10"
                    :class="'btn-' + action.color"
                    :href="action.path"
                    :title="action.label"
                  >
                    <i :class="action.icon"></i> </a
                  >&nbsp;
                </span>
              </td>
              <td class="v-middle" v-if="actions && actions != 'false'">
                <span v-for="(action, index) in actions" :key="index">
                  <a
                    data-toggle="tooltip"
                    class="btn btn-flat ml-10"
                    :class="'btn-' + action.color"
                    :href="url + '/' + actionUrl(action.path, item.id)"
                    :title="action.label"
                  >
                    <i :class="action.icon"></i> </a
                  >&nbsp;
                </span>

                <!-- <span v-for="(action, index) in actions" :key="index">
                  <a
                    data-toggle="tooltip"
                    class="btn btn-flat ml-10"
                    :class="'btn-' + action.color"
                    :href="url + '/' + 'products_stamp'"
                    :title="action.label"
                  >
                    <i :class="action.icon"></i> </a
                  >&nbsp;
                </span> -->
              </td>
              
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td
                :colspan="titles.length + 2"
                align="left"
                vertical-align="center"
              >
                <button
                  v-if="!notDeletable"
                  type="submit"
                  class="mv-22 btn btn-flat btn-danger"
                  :disabled="btnDelete.disabled"
                >
                  <i :class="btnDelete.icon"></i> {{ btnDelete.text }}
                </button>

                <slot name="pagination"></slot>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>

      <div v-if="items.data.length == 0" class="callout callout-default">
        <h4>Nenhum registro encontrado!</h4>
      </div>
    </div>
  </div>
</template>

<style>
.mv-22 {
  margin: 22px 0;
}
.v-middle {
  vertical-align: middle !important;
}
.badge-success {
  background-color: #28a745 !important;
}
.badge-danger {
  background-color: #dc3545 !important;
}
</style>

<script>
export default {
  props: [
    "title",
    "titles",
    "items",
    "busca",
    "url",
    "token",
    "formClass",
    "notDeletable",
    "actions",
    "isFather",
  ],
  data: function () {
    return {
      deleteItems: [],
      btnDelete: {
        icon: "fa fa-trash",
        text: "Excluir registros selecionados",
        disabled: true,
      },
    };
  },
  created() {
    if (!this.items.data) {
      this.items.data = this.items;
    }
  },
  methods: {
    checkDelete() {
      setTimeout(() => {
        var checkboxes = document.getElementsByClassName("checkbox-delete");
        var checkeds = 0;
        for (var i = 0, n = checkboxes.length; i < n; i++) {
          if (checkboxes[i].checked == true) {
            checkeds++;
          }
        }
        var checkboxOrigin = document.getElementById("checkbox-delete-origin");
        if (checkboxOrigin.checked) {
          this.btnDelete.disabled = false;
        } else {
          this.btnDelete.disabled = checkeds == 0;
        }
      }, 100);
    },
    isMultiBadge(field) {
      if (Array.isArray(field) && field.length > 0) {
        if (field[0].type == "multiBadge") {
          return true;
        }
      }
      return false;
    },
    checkAll: function () {
      var checkboxOrigin = document.getElementById("checkbox-delete-origin");
      var checkboxes = document.getElementsByClassName("checkbox-delete");
      for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = checkboxOrigin.checked;
      }
    },
    confirmDelete: function (e) {
      this.$swal({
        title: "Atenção!",
        html: this.isFather
          ? "Deseja realmente excluir os registros selecionados? Todos os itens <b>vinculados</b> a este, também serão excluidos! "
          : "Deseja realmente excluir os registros selecionados?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#008d4c",
        cancelButtonColor: "#d4d4d4",
        confirmButtonText: "Sim, deletar!",
        cancelButtonText: "Não!",
      }).then((result) => {
        if (result.value) {
          e.target.submit(), (this.btnDelete.icon = "fa fa-spinner fa-pulse");
          this.btnDelete.text = "Excluindo";
          this.btnDelete.disabled = true;
        }
      });
    },
    actionUrl: (path, id) => {
      return path.replace(/{item}/g, id);
    },
  },
};
</script>
