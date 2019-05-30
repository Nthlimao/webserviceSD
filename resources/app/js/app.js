//=require routes.js

const router = new VueRouter({ mode: 'history', routes });

const app = new Vue({
    router
}).$mount('#app')
