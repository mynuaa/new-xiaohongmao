import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueCarousel from 'vue-carousel'
import echarts from 'echarts'
 
Vue.use(VueCarousel);
Vue.prototype.$echarts = echarts 
Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
