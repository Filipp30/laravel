<template>
    <form @submit.prevent="onSignSubmit" class="sign_form" autocomplete="off">

        <div class="sign_form__inputs">
            <label for="email">E-Mail</label>
            <input v-model="form.email" type="email" placeholder="email" id="email">
            <label for="password">Password</label>
            <input v-model="form.password"  type="password" placeholder="password" id="password">
            <span>
                <input type="checkbox" id="checkbox"><label for="checkbox">Remember me</label>
            </span>
        </div>
        <button>Login</button>

        <a href="">I forgot my password</a>


    </form>

</template>

<script>
export default {
    name: "SignForm",
    data(){
        return{
            form:{
                email:'',
                password:''
            }

        }
    },
    methods:{
        onSignSubmit(){
            axios.post('/api/login',this.form).then((response)=>{
                console.log(response)
            }).catch((error)=>{
                console.log(error);
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .sign_form{

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
