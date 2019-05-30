"use strict";var HomePage=Vue.component("page-home",{template:"<div> oi</div>",data:function(){return{}},methods:{},mounted:function(){console.log("oi")}}),routes=[{path:"/",name:"home",component:HomePage,public:!0}],router=new VueRouter({mode:"history",routes:routes}),app=new Vue({router:router}).$mount("#app");
//# sourceMappingURL=app.js.map
