<template>
    <div class="container">
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                <form v-on:submit.prevent="EnviaDados"> 
                    <div class="form-group">                       
                        <div class="col-md-12 align">
                            <div class="col-md-3">
                                 <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter username" ref="username">
                            </div>
                             <div class="col-md-3">
                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter profile" ref="perfil">
                             </div>
                             <div class="col-md-3">
                                     <button type="submit" class="btn btn-primary">Profile</button>   
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="row" v-if="this.$store.getters.getterAllProfiles.length > 0">
             <Table :profiles="profiles[0]"></Table>
        </div>
       
    </div>
    
</template>

<script>
import Table from '../Table/index'
import { mapGetters }  from 'vuex';
import { mapActions } from 'vuex';
    export default {
        components: {
            Table,
        },
        data(){
            return {
                foo: '',
                search: '',
                profiles:[],          
            }
        },
        mounted() {this.getMount();},
        computed:{
            ...mapGetters(['getterAllProfiles']),
                 filteredList() {
                    return this.profiles.filter(post => {
                        return post.username.toLowerCase().includes(this.search.toLowerCase())
                    })
                 }
             },
        methods: {
             ...mapActions(['actionGetAllProfiles','actionPostProfiles']),
            getData(...params){ const references  = this.profiles; references.push(...params);},          
            getMount(){ this.actionGetAllProfiles(); this.profiles.push( this.$store.state.profiles);},           
            EnviaDados(){const data = {username: this.$refs.username.value,perfil: this.$refs.perfil.value}; this.actionPostProfiles(data);},
            

        }
    }
</script>

<style scoped>
  
</style>


