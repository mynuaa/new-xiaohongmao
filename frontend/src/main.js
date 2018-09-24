import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueCarousel from 'vue-carousel'
import echarts from 'echarts'
import axios from 'axios'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
Vue.use(VueCarousel);
Vue.prototype.$echarts = echarts 
Vue.config.productionTip = false

Vue.prototype.axios = axios

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
