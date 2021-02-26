<template>
    <form @submit.prevent="onRegSubmit" class="reg_form" autocomplete="off">

        <div class="reg_form__inputs">
            <label for="username">Username</label>
            <input v-model="reg_form.name" type="text" placeholder="username" id="username">
            <label for="email">E-Mail</label>
            <input v-model="reg_form.email" type="email" placeholder="email" id="email">
            <label for="password">Password</label>
            <input v-model="reg_form.password"  type="password" placeholder="password" id="password">
        </div>
        <button type="submit" >Register</button>
    </form>

</template>

<script>
export default {
    name: "RegForm",
    data(){
        return{
            reg_form:{
                name:'',
                email:'',
                password:'',
            }
        }
    },
    methods:{
        onRegSubmit(){
            axios.post('/api/register',this.reg_form).then((response)=>{
                console.log(response.data)
            }).catch((error)=>{
                console.log(error.data)
            })
        }
    }
}
</script>

<style lang="scss" scoped>
@mixin  center(){
    display: flex;
    justify-content: center;
    align-items: center;
}
.reg_form{
    width: 100%;



    &__inputs{

        font-size: 15px;
        @include center();
        flex-direction: column;
        margin-bottom: 2rem;
        label{
            margin-right:auto;
            margin-bottom: 1rem;

        }
        input{
            height: 30px;
            width: 100%;
            margin-bottom: 3rem;
        }

    }




}
</style>
