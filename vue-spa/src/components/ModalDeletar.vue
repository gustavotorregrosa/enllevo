<template>
  <div>
    <div id="modal4" class="modal">
      <div class="modal-content">
        <h4>Deletar equipamento</h4>
        <p>Deseja realmente deletar o equipamento {{equipamento.nome}}?</p>
      </div>
      <div class="modal-footer">
        <a @click.prevent="deletar" class="btn-small waves-effect waves-light right red">Deletar</a>
      </div>
    </div>
  </div>
</template>

<script>
import M from "materialize-css";
import { pJwtFetch } from "../suporte/helpers-jwt";
let elem;
document.addEventListener("DOMContentLoaded", function() {
  elem = document.querySelector("#modal4");
  let instances = M.Modal.init(elem, {});
});
export default {
  name: "ModalDeletar",
  data() {
    return {
      equipamento: {}
    };
  },
  methods: {
    abrir: function(equipTemp) {
      this.equipamento = equipTemp;
      M.Modal.getInstance(elem).open();
    },
    deletar: function() {
      let opcoes = {
        url: this.apiurl + "equipamento-deletar/" + this.equipamento.id,
        method: "delete",
        // body: JSON.stringify(this.equipamento)
      };

      pJwtFetch(opcoes).then(mensagem => {
        M.toast({ html: mensagem });
        M.Modal.getInstance(elem).close();
        this.$emit("recarregar");
      });
    },
  },
  props: ["apiurl"]
};
</script>

<style>
</style>