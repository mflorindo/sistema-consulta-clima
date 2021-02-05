<template>
  <div>
    <div class="row mt-4">
      <div class="col-md-12">
        <v-select
          :options="lista"
          @search="fetchOptions"
          placeholder="Digite o nome da cidade para pesquisa"
          label="nome"
          v-model="cidadeEscolhida"
        >
          <template slot="no-options">
            Aguardando a busca de cidades
          </template>
        </v-select>
      </div>
    </div>

    <div class="row mt-3" v-if="previsoes.length">
      <div class="col-md-12 text-center">
        <span
          >Clima para os próximos 7 dias para a cidade de {{ nomeCidade }}</span
        >
      </div>
    </div>

    <div class="row seven-cols" v-if="previsoes.length">
      <div class="col-md-1" v-for="item in previsoes" :key="item.data_previsao">
        <div class="card">
          <div
            class="card-header"
            style="padding: 0px 0px 0px 10px ;font-size:12px"
          >
            {{ formatarData(item.data_previsao) }}<br />
            {{ obterDiaSemana(item.data_previsao) }}
          </div>
          <div
            class="card-body"
            style="font-size:12px;padding: 10px 0px 10px 10px ;"
          >
        <div>{{ item.clima }} <i :class="`fas ${obterImagem(item.clima)}`"></i></div>
            <div>Minima: {{ item.temperatura_minima }}ºC</div>
            <div>Máxima: {{ item.temperatura_maxima }}ºC</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
@media (min-width: 768px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 100%;
    *width: 100%;
    max-width: none;
    flex: none;
    padding: 0;
  }
}

@media (min-width: 992px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
    max-width: none;
    flex: none;
  }
}

/**
 *  The following is not really needed in this case
 *  Only to demonstrate the usage of @media for large screens
 */
@media (min-width: 1200px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
    max-width: none;
    flex: none;
  }
}
</style>
<script>
import "vue-select/dist/vue-select.css";
export default {
  components: {},
  data() {
    return {
      lista: [],
      previsoes: [],
      cidadeEscolhida: [],
      nomeCidade: null,
    };
  },
  methods: {
    async fetchOptions(search, loading) {
      if (search.length) {
        loading(true);

        const response = await this.$http.post("obter-cidades", {
          termo: search,
        });
        this.lista = response.data;
        loading(false);
      }
    },
    obterDiaSemana(data) {
      let a = new Date(data);
      let weekdays = new Array(7);
      weekdays[0] = "Domingo";
      weekdays[1] = "Segunda";
      weekdays[2] = "Terça";
      weekdays[3] = "Quarta";
      weekdays[4] = "Quinta";
      weekdays[5] = "Sexta";
      weekdays[6] = "Sábado";
      return weekdays[a.getDay()];
    },
    formatarData(data){
        const d = data.split("-");
        return d[2]+'/'+d[1]+'/'+d[0]
    },
    obterImagem(clima){
        let retorno = ''
        switch (clima) {
            case 'nublado':
                retorno = 'fa-cloud';
                break;
            case 'instavel':
                retorno =  'fa-umbrella';
                break;
            case 'tempestuoso':
                retorno =  'fa-poo-storm';
                break;
            case 'ensolarado':
                retorno =  'fa-sun';
                break; 
            case 'chuvoso':
                retorno =  'fa-cloud-showers-heavy';
                break;           
            default:
                retorno = ''
        }
        console.log(retorno)
        return retorno

    }
  },
  watch: {
    async cidadeEscolhida(newValue) {
      if (newValue != null) {
        this.nomeCidade = newValue["nome"];
        const response = await this.$http.get(
          `obter-previsao/${newValue["id"]}`
        );
        this.previsoes = response.data;
      } else {
        this.previsoes = [];
      }
    },
  },
};
</script>
