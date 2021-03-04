<template>

    <div>
        <h1>Home</h1>
        <h1 v-if="auth_error">Auth : {{auth_error}}</h1>
        <h1 v-else>Welcome <span><h2 style="color: red">{{auth_user.name}}</h2></span></h1>
    </div>

</template>

<script>
export default {
name: "Home",
    data(){
        return{
            auth_user:'',
            auth_error:''
        }
    },

    beforeMount() {
        axios.get('/api/user').then((response)=>{
            this.auth_user = response.data;
        }).catch((error)=>{
            this.auth_error = error.response.data.message;
        })
    }
}
</script>

<style scoped>

</style>
