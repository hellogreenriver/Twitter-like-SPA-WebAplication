import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);


import indexMain from "./components/indexMain.vue";
import nologinTimeline from "./components/noLoginTimeline.vue";
import personalTweet from "./components/personalTweet.vue";
import login from "./components/login.vue";
import register from "./components/register.vue";
import account from "./components/account.vue";
import timeline from "./components/timeline.vue";
import search from "./components/search.vue";



 
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            
            path: "/tomotter",
            name: "indexMain",
            component: indexMain,
            meta: { guest: true },
            children: [
                { path: '',
                 name:"noLoginTimeline",
                 component: nologinTimeline }
              ]
        },
        {
            path: "/tomotter/individual",
            name: "account",
            component: account,
            meta: { requiresAuth: true },
            children: [{
                path: "/tomotter/personaltweet",
                name: "personalTweet",
                meta: { requiresAuth: true },
                component: personalTweet
                },
                {
                    path: "/tomotter/timeline",
                    name: "timeline",
                    meta: { requiresAuth: true },
                    component: timeline,
                },
                {
                    path: "/tomotter/search",
                    name: "search",
                    meta: {requiresAuth: true},
                    component: search,
                },

            ]
           
        },
        {
            path: "/tomotter/login",
            name: "login",
            component: login,
            meta: { guest: true }
        },
        {
            path: "/tomotter/register",
            name: "register",
            component: register,
            meta: { guest: true }
            
        },
        
       
    ]
});

function loggedIn(){
    return localStorage.getItem("auth")
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!loggedIn()) {
        next({
          path: '/tomotter',
          query: { redirect: to.fullPath }
        })
      } else {
        next();
      }
    } else  if (to.matched.some(record => record.meta.guest))
        if (loggedIn()) {
            next({
              path: '/tomotter/individual',
              query: { redirect: to.fullPath }
            })
    }
    else{
        next();
    }
});

export default router;