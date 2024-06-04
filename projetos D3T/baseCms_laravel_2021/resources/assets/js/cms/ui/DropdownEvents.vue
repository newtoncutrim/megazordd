<template>
        <li v-if="filteredItems.length > 0 && !loading" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs" slot="toggle">
                    Administrando: <b>{{ currentEvent.name }}</b>
                    <span class="caret"></span>
                </span>
            </a>
            <ul class="dropdown-menu">
                <li v-for="(item, index) in filteredItems" >
                    <a v-on:click="setCurrent(index)">
                        <i class="fa fa-flag"></i> {{item.text}}
                    </a>
                </li>
            </ul>
        </li>

        <li v-else-if="filteredItems.length == 0 && !loading">
          <a>
            <span class="hidden-xs" slot="toggle">
                Administrando: <b>{{ currentEvent.name }}</b>
            </span>
          </a>
        </li>

        <li v-else-if="loading">
          <a>
            <span class="hidden-xs" slot="toggle">
                Carregando...
            </span>
          </a>
        </li>
    
</template>

<script>
    export default {
        props: ['route', 'items','currentId', 'token'],
        data: function(){
            return{
                currentEvent : [],
                filteredItems : [],
                loading : true,
            }
        },
        mounted: function(){
          this.currentEvent.id = this.currentId;
          this.setItems();
        },
        methods: {
          setItems: function(){
            if(this.items.length == 0){
              this.currentEvent.name = 'Selecione';
              this.currentEvent.id = 0;
              
              this.filteredItems = [];
            }else if(this.currentEvent.id == 0){
              this.currentEvent.name = 'Selecione';
              this.currentEvent.id = this.currentId;
              
              this.filteredItems = this.items;
            }

            var filteredItems = this.items.filter(item => {
              if(item.id == this.currentEvent.id){
                this.currentEvent.name = item.text;
              }

              return item.id != this.currentEvent.id;
            });

            this.loading = false;
            this.filteredItems = filteredItems;
          },
          
          setCurrent : function(indexNew){
                var _this = this;
                this.loading = true;

                axios({
                  method: 'PUT',
                  url: this.route,
                  data: {
                    _token: this.token,
                    current_event_id: this.filteredItems[indexNew].id
                  }
                })
                .then(function(response) {
                  if(!response.data.errors){
                    _this.currentEvent.id = _this.filteredItems[indexNew].id;
                    _this.setItems();
                  }
                })
                .catch(function(response) {
                  console.error(response);
                });
            }
        }
    }
</script>
