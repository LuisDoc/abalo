import {createStore} from "vuex";
import axiosClient from "../axios"

const store = createStore({
    state:{
        user:{
            data:{
                id: sessionStorage.getItem("USER_ID"),
            },
            token:sessionStorage.getItem("TOKEN")
        }
    },
    getters:{},
    actions:{
        register({commit}, user){
            return axiosClient.post("/register", user)
           .then(({data})=>{
               commit('setUser', data);
               return data;
           })
        },
        login({commit}, user){
           return axiosClient.post("/login", user)
           .then(({data})=>{
               commit('setUser', data);
               return data;
           })
        },
        logout({commit}){
           return axiosClient.post("/logout")
           .then((response)=>{
               commit('logout');
               return response;
           });
        },
         
    },
    mutations:{
        logout:state=>{
            state.user.data = {};
            state.user.token = null;
            sessionStorage.clear();
        },
        setUser:(state, userData)=>{
            state.user.token = userData.token;
            state.user.data = userData.user;
            sessionStorage.setItem('TOKEN', userData.token);
            sessionStorage.setItem('USER_ID', userData.user.id);
            sessionStorage.setItem('USER_AB_MAIL', userData.user.ab_mail);
            sessionStorage.setItem('USER_AB_NAME', userData.user.ab_name);
        }
    },
    modules:{}
})

export default store;