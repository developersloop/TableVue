<template>
     <div class="col-md-8 col-md-offset-2">
        
           <div class="col-md-6">
                    <v-select label="id" :filterable="false" :options="options" @search="onSearch">
                    <template slot="no-options">
                      nenhum registro encontrado!!!
                    </template>
                    <template slot="option" slot-scope="option">
                    <div class="d-center">
                    
                        {{ option.username }}
                        </div>
                    </template>
                    <template slot="selected-option" slot-scope="option">
                    <div class="selected d-center" ref="select-username">
                    
                        {{ option.username }}
                    </div>
                    </template>
            </v-select>
         
           </div>
           <div class="col-md-6">
               <input type="text" v-model="searchh" ref="search">
           </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">username</th>
                        <th scope="col">perfil</th>
                        <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(profile,index) in filteredList" :key="profile.id">                      
                        <td>{{profile.username}}</td>
                        <td>{{profile.perfil}}</td>
                         <td>                            
                             <Button :status="status" :msg="btn_editar" @click="$emit('show')" :id="profile.id" :index="index"></Button>
                             <button type="button" class="btn btn-danger" v-on:click="onDelete(profile.id,index)">Excluir</button>
                         </td>
                        </tr>
                    </tbody>
                    </table>
                         <modal name="hello-world" @before-open="beforeOpen">
                             <div class="title">
                                 <h3> {{ $store.getters.getterAllUsers }}</h3>
                             </div>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 ">
                                    <form v-on:submit.prevent="EditData">                                        
                                        <div class="form-group">                       
                                            <div class="col-md-12 align">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter username" ref="username" v-model="username">
                                                    <br/>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter profile" ref="perfil" v-model="perfil">
                                                    <br/>
                                                </div>
                                                <div class="col-md-12">
                                                        <button type="submit" class="btn  btn-primary btn-lg btn-block">Profile</button>                                                              
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                             </div>
                             
                        </modal>                    
              </div>
        
</template>
<script>
import Button from '../Button/index';
import { mapActions } from 'vuex';
import _ from 'lodash';
    export default {
        props: ['profiles'],
        components: {
            Button,
        },  
        data(){
            return{
                profi: this.profiles,
                status: '1',
                btn_editar :  'Editar',
                btn_delete :  'Delete',
                username: '',
                perfil: '',
                searchh:'',
                options:[],
            }
        },   

        computed: {
            filteredList() {
                return this.profi.filter(post => {
                    return post.username.toLowerCase().includes(this.searchh.toLowerCase()) || post.username.toLowerCase().includes(this.searchh.toLowerCase());                })
            }
        },

        methods: {  
            teste(){
                console.log('adad');
            }, 
             onSearch(search, loading) {
            loading(true);
            this.search(loading, search, this);
         },
            search: _.debounce((loading, search, vm) => {

                //  axios.get(`http://localhost:8001/profile/search/vitor`)
                // .then(objeto => {
                //     vm.options = objeto.data.map(function (x) { return { label: x.username, value: x.id }; });
                // })
                //.catch(err => console.log(err))
                fetch(
                    `http://localhost:8001/profile/search/${escape(search)}`
                ).then(res => {
                    res.json().
                    then(json => {vm.options = json; console.log(json)});
                    loading(false);
                });
            }, 350)
        ,     
        ...mapActions(['actionUpdateProfiles','actionDeleteProfiles']),    
             beforeOpen(event){
               const id = localStorage.getItem('id');
                 axios.get(`http://localhost:8001/profile/${id}`)
                .then(data => 
                   {
                       this.username = data.data.username;
                       this.perfil = data.data.perfil;
                       teste = data.data.perfil;
                    
                    })   
                .catch(err => console.log(err));
                const data = {
                    username: this.username,
                    perfil: this.perfil
                }

            },
            onDelete(id,index){const data = {id,index}; if(index!=null){this.actionDeleteProfiles(data);}},
            EditData(){const id = localStorage.getItem('id');const data = {id,username:this.username,perfil:this.perfil,};this.actionUpdateProfiles(data); this.$modal.hide('hello-world');}
        }
      
    }
</script>
<style scoped>
    .title{
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }
     .containerr{
       display: flex;
       flex-flow: row nowrap;
       justify-content: center;
       align-content: center;
       align-items: center;
   }
   img {
  height: auto;
  max-width: 2.5rem;
  margin-right: 1rem;
}

.d-center {
  display: flex;
  align-items: center;
}

.selected img {
  width: auto;
  max-height: 23px;
  margin-right: 0.5rem;
}

.v-select .dropdown li {
  border-bottom: 1px solid rgba(112, 128, 144, 0.1);
}

.v-select .dropdown li:last-child {
  border-bottom: none;
}

.v-select .dropdown li a {
  padding: 10px 20px;
  width: 100%;
  font-size: 1.25em;
  color: #3c3c3c;
}

.v-select .dropdown-menu .active > a {
  color: #fff;
}


</style>