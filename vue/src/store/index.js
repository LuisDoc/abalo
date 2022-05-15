import {createStore} from "vuex";

const store = createStore({
    state:{
        user:{
            data: {
                id :1
            },
            token:null
        }
    },
    getters:{},
    actions:{},
    mutations:{},
    modules:{}
})

export default store;