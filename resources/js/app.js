import Vue from 'vue'
import { App, plugin } from '@inertiajs/inertia-vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(plugin)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const el = document.getElementById('app')

new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => import(`./Pages/${name}`).then(module => module.default)
        },
    }),
}).$mount(el)
