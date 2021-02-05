import Vue from 'vue'
import App from './App.vue'
import vSelect from 'vue-select'
import axios from 'axios'
import VueAxios from 'vue-axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api'
Vue.use(VueAxios, axios)

Vue.config.productionTip = false
Vue.component('v-select', vSelect)
new Vue({
  render: h => h(App),
}).$mount('#app')
