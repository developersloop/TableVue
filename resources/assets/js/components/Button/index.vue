<template>
 <button v-bind:class="verify_status == 'Editar' ? 'btn btn-warning' : 'btn btn-danger'"  @click="show()">{{this.msg}}</button>
</template>


<script>
 export default {
     props:['msg','id','index'],
     data(){
         return {
             verify_status: this.msg,
         }
     },
     methods: {
          show(){
                localStorage.setItem('id',this.id);
                localStorage.setItem('index',this.index);
                var username = '';
                var perfil = '';
                const  modal = this.$modal;
                const data = JSON.parse(localStorage.getItem('user_edit'));
                   modal.show('hello-world',{
                            username,
                            perfil,
                     }); 
            },
             hide () {
                this.$modal.hide('hello-world');
            },
            
     }
 }

</script>

<style scoped>
    
</style>