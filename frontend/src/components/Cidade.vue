<template>
  <div class="card border">
    <div class="card-body">
      <div class="card-header">{{ titulo }}</div>    
      <ul class="list-group list-group-flush fonte-cidade">        
        <li v-for="item in lista" :key="item.nome" class="list-group-item">
            {{item.nome}}/{{item.uf}} <span class="float-right">Máx {{item.temperatura_maxima}}ºC</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: ["titulo","lista"],
};
</script>

<style>
    .fonte-cidade {
        font-size : 12px;

    }
</style>
