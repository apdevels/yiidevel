import Vue from 'vue'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

import App from './App.vue'
import router from './router'
import store from './store'

Vue.use(ElementUI);
Vue.config.productionTip = false



new Vue({
    router,
    store,
//   render: function (h) { return h(App) }
    render: h => h(App)
}).$mount('#app')


// new Vue({
//     el: '#app',
//     router,
//     store,
//     template: '<App/>',
//     components: { App }
// })
