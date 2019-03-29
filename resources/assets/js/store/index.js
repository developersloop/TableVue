import Vuex from "vuex";
import Axios from "axios";
const GET_ALL_USERS = 'GET_ALL_USERS';
const GET_ALL_PROFILES = 'GET_ALL_PROFILES';
const ADD_ALL_PROFILES = 'ADD_ALL_PROFILES';
const UPDATE_PROFILLES = 'UPDATE_PROFILLES';
const DELETED_PROFILLES = 'DELETED_PROFILLES';
export default function getStore(){
    return new Vuex.Store({
        state:{
            profiles:[],
            edit_profiles:[],
            teste:''
        },
        mutations: {
            [GET_ALL_USERS](state, ...params){
              state.teste = params
            },

            [ADD_ALL_PROFILES](state,...params){
                state.profiles.push({
                    id:params[0].id,
                    username:params[0].username,
                    perfil:params[0].perfil
                })
            },

            [GET_ALL_PROFILES](state,...params){    
                const numero = params[0].length;          
                 for (let index = 0; index < numero; index++) {
                     state.profiles.push({
                        id:params[0][index].id,
                        username:params[0][index].username,
                        perfil:params[0][index].perfil
                    })
                 }
                
            },

            [UPDATE_PROFILLES](state,...params){  
                const {profiles} = this.state;     
                const id = params[0].id;  
                const profiles_index = profiles.findIndex(obj => obj.id == id);
                localStorage.setItem('index_profile',profiles_index);
                profiles[profiles_index].username = params[0].username;
                profiles[profiles_index].perfil = params[0].perfil;
            },

            [DELETED_PROFILLES](state,index){
                this.state.profiles.splice(index,1);
            }
            
        },
        
        actions:{
           actionGetAllProfiles({commit}){
            axios.get('http://localhost:8001/profile')
            .then(data =>{commit(GET_ALL_PROFILES,data.data);})
            .catch(err => console.log(err))
            },
            actionPostProfiles({commit},data){
             
                const Headers = {
                     'X-CSRF-TOKEN':localStorage.getItem('CSRF_TOKEN'),
                     'Content-Type':'application/json'
                }
                 axios.post('http://localhost:8001/profile/store',{username:data.username,perfil:data.perfil},Headers)
                    .then(data =>{
                        axios.get(`http://localhost:8001/profile/${data.data}`)
                        .then(last_id =>  commit(ADD_ALL_PROFILES,last_id.data))
                        .catch(err => console.log(err))
                    })
                    .catch(err => console.log(err))
            },
            actionUpdateProfiles({commit},data){
                const username= data.username;
                const perfil = data.perfil;
                
                const Headers = {
                     'X-CSRF-TOKEN':localStorage.getItem('CSRF_TOKEN'),
                     'Content-Type':'application/json'
                }
                const objeto = {
                    id:data.id,
                    username,
                    perfil,
                }
                 axios.put(`http://localhost:8001/profile/${data.id}`,objeto,Headers)
                    .then(data => commit(UPDATE_PROFILLES,data.data) )
                    .catch(err => console.log(err))
            },
            actionDeleteProfiles({commit},data){                
                 axios.get(`http://localhost:8001/profile/delete/${data.id}`)
                    .then(dt => commit(DELETED_PROFILLES,data.index))
                    .catch(err => console.log(err))
            }
        },
        getters: {
            getterAllProfiles: state => state.profiles
        }
    })

   
}