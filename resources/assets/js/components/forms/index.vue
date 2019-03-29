<template>
  <div>
       <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                <form v-on:submit.prevent="EnviaDados"> 
                    <div class="form-group">                       
                        <div class="col-md-12 align">
                            <div class="col-md-2">
                                 <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter username" ref="username">
                            </div>
                             <div class="col-md-2">
                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter profile" ref="perfil">
                             </div>
                             <div class="col-md-2">
                                     <button type="submit" class="btn btn-primary">Profile</button>   
                            </div>
                            <div class="col-md-3 containerr" style="    width: 300px;">
                                   <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="buscar..." v-model="search">
                                   &nbsp;&nbsp;&nbsp;
                                   <button type="button" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
  </div>
</template>


<script>
export default {
    data(){
        return {
            
        }
    }
}

</script>


<style>

</style>