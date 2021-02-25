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
                password:''
            }
        }
    },
    methods:{
        onRegSubmit(){
            axios.post('/register',this.reg_form).then((respons)=>{
                console.log(respons.data)
            }).catch((error)=>{
                console.log(error.data)
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.reg_form{

    display: flex;
    flex-direction: column;


    &__inputs{
        font-size: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        input{
            height: 30px;
        }
        span{
            input{
                width: 20px;

            }
        }
    }
    button{
        width: 50%;
        height: 30px;
        align-items: center;
        justify-content: center;
    }




}
</style>
