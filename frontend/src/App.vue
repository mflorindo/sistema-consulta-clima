<template>
  <div id="app" class="container">
    
      <banner />
      <apresentacao />
      <rodape />
    
  </div>
</template>

<script>
import Banner from "./components/Banner";
import Rodape from "./components/Rodape";
import Apresentacao from "./components/Apresentacao";
export default {
  name: "App",
  components: {
    Banner,
    Apresentacao,
    Rodape,
  },
 
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
