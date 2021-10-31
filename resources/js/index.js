import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        deleteShow : false,
        user: "",
        timeLimit: 60* 60 * 2,
        snackbar: false,
    },
    mutations: {
        booleanShow(state, boolean){
            state.deleteShow = boolean
        },
        setUser(state, userInformation){
            state.user = userInformation
        },
        resetUser(state){
            state.user = null
        },
        setSnackbar(state, boolean){
            state.snackbar = boolean
        },
    },
    getters:{
        getShow(state){
            return state.deleteShow
        },
        getUser(state){
            return state.user
        },
        getTimeLimit(state){
            return state.timeLimit
        },
        getSnackbar(state){
            return state.snackbar
        }
    },
    actions:{
        importUserInformation({ commit }){
            axios.get("/api/user").then(response => {
                commit('setUser',response.data)
            })
        },
        setDeleteShow({ commit }, bool){
            commit('booleanShow', bool)
        },
        resetUser({ commit }){
            commit('resetUser')
        },
        setSnackbar({ commit },bool){
            commit('setSnackbar', bool)
        }
    }
});
export default store;