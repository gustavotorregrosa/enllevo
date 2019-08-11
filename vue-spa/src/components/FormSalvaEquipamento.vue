<template>
  <div>
    <div id="modal3" class="modal">
      <form id="form-salvar">
        <div class="row">
          <div class="input-field col s6">
            <input v-model="equipamento.nome" id="nome" type="text" class="validate" />
            <label for="nome">Nome</label>
          </div>
          <div class="input-field col s6">
            <textarea v-model="equipamento.descricao" id="descricao" class="materialize-textarea"></textarea>
            <label for="descricao">Descricao</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input v-model="equipamento.valor" id="valor" type="text" class="validate" />
            <label for="valor">Valor</label>
          </div>
          <div class="input-field col s6">
            <input v-model="equipamento.quantidade" id="quantidade" type="number" class="validate" />
            <label for="quantidade">Quantidade</label>
          </div>
        </div>

        <button @click.prevent="salvar" class="btn waves-effect waves-light right" name="action">
          Submit
          <i class="material-icons right">send</i>
        </button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.modal.open {
  min-width: 90%;
  min-height: 80%;
}
#form-salvar {
  padding: 2em;
}
</style>

<script>
import M from "materialize-css";
import { pJwtFetch } from "../suporte/helpers-jwt";
let elem;
document.addEventListener("DOMContentLoaded", function() {
  elem = document.querySelector("#modal3");
  let instances = M.Modal.init(elem, {});
});
function ativarLabels() {
  let labels = document.querySelectorAll("label");
  labels.forEach((lb, i) => {
    lb.classList.add("active");
  });
}
function desativarLabels() {
  let labels = document.querySelectorAll("label");
  labels.forEach((lb, i) => {
    lb.classList.remove("active");
  });
}
export default {
  name: "FormSalvaEquipamento",
  data() {
    return {
      equipamento: {
        id: "",
        nome: "",
        descricao: "",
        valor: "",
        quantidade: ""
      }
    };
  },
  methods: {
    salvar: function() {
      let opcoes = {
        url: this.apiurl + "equipamento-salvar",
        method: "post",
        body: JSON.stringify(this.equipamento)
      };

      pJwtFetch(opcoes).then(mensagem => {
        M.toast({ html: mensagem });
        M.Modal.getInstance(elem).close();
        this.$emit("recarregar");
      });
    },
    abrir: function(equipTemp) {
      this.equipamento = equipTemp;
      M.Modal.getInstance(elem).open();
      desativarLabels();
      if (this.equipamento.id) {
        ativarLabels();
      }
    }
  },
  props: ["apiurl"]
};
</script>

