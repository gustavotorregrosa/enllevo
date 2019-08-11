<template>
  <div>
    <div v-if="estaLogado" class="espacado">
      <a @click.prevent="abrirForm()" class="modal-trigger btn-floating btn-large waves-effect waves-light red btn-small pulse right">
        <i class="material-icons">add</i>
      </a>
      <table>
        <thead>
          <th>Nome</th>
          <th>Botões</th>
        </thead>
        <tbody>
          <tr v-bind:key="equipamento.id" v-for="(equipamento, index) in equipamentos">
            <td>{{equipamento.nome}}</td>
            <td>
              <a class="waves-effect waves-light btn-small red darken-1" @click.prevent="deletar(index)"><i class="material-icons">delete</i></a>
              &nbsp; &nbsp; &nbsp;
              <a class="waves-effect waves-light btn-small" @click.prevent="abrirForm(index)"><i class="material-icons">edit</i></a> 
            </td>
          </tr>
        </tbody>
      </table>
      <ValorTotal :valortotal="valortotal"/>

    </div>



    <FormSalvaEquipamento @recarregar="listaitens()" :apiurl="apiurl" ref="form"/>
    <ModalDeletar @recarregar="listaitens()" :apiurl="apiurl" ref="deletar"/>
  </div>
</template>

<script>
import { pJwtFetch } from "../suporte/helpers-jwt";
import FormSalvaEquipamento from "./FormSalvaEquipamento.vue";
import ModalDeletar from "./ModalDeletar.vue";
import ValorTotal from "./ValorTotal.vue";
export default {
  name: "ListagemItens",
  data() {
    return {
      equipamentos: []
    };
  },

  computed: {
    valortotal: function(){
      let valor = 0
      this.equipamentos.forEach(element => {
          valor += element.quantidade * parseFloat(element.valor)
      });
      return valor
      
    }
  },

  methods: {
    deletar: function(i){
      let equipamentoTemp = {}
      if(i !== null){
        equipamentoTemp = this.equipamentos[i]
      }
      this.$refs.deletar.abrir(equipamentoTemp)
    },
    abrirForm: function(i = null){
      let equipamentoTemp = {}
      if(i !== null){
        equipamentoTemp = this.equipamentos[i]
      }
      this.$refs.form.abrir(equipamentoTemp)
    },
    listaitens: function() {
      let opcoes = {
        url: this.apiurl + "lista-equipamentos",
        method: "get"
      };

      pJwtFetch(opcoes)
        .then(resultado => {
          this.equipamentos = resultado
        })
        .catch(codigo => {
          if (this.estaLogado) {
            this.$emit("abrirmodallogin");
          }
        });
    }
  },

  mounted: function() {
    this.listaitens();
  },
  props: ["estaLogado", "apiurl"],
  watch: {
    estaLogado: function(newVal, oldVal) {
      this.listaitens();
    }
  },
  components: {
    FormSalvaEquipamento,
    ModalDeletar,
    ValorTotal
  }
};
</script>


<style scoped>
.espacado {
  margin-top: 5em;
}
</style>

