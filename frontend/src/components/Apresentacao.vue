<template>
    <div class="card text-left mt-4">
      <div class="card-body">
          <div class="row">
              <div class="col-md-6">
                  <cidade titulo="Cidades mais quentes hoje" :lista="maximas" />
              </div>

              <div class="col-md-6">
                  <cidade titulo="Cidades mais frias hoje" :lista="minimas"/>
              </div>
          </div>

                  <visor-temperaturas />

          </div>
      </div>
</template>

<script>
import Cidade from '../components/Cidade'
import VisorTemperaturas from '../components/VisorTemperaturas'
export default {
    components: {
        Cidade,
        VisorTemperaturas      
    },
    data() {
        return {
            maximas:[],
            minimas:[],
        }
    },

    mounted () {
        this.$http.get('/inicializacao').then(response=>{
            this.maximas = response.data.maximas
            this.minimas = response.data.minimas
        })
    },
}
</script>