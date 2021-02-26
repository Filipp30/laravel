<template>
    <ForgotForm v-if="forgot_form" v-on:forgotForm="forgot_form = false" />
    <form v-else @submit.prevent="onSignSubmit" class="sign_form" autocomplete="off">
        <div class="sign_form__inputs">
            <label for="email">E-Mail</label>
            <input v-model="form.email" type="email" placeholder="email" id="email">
            <label for="password">Password</label>
            <input v-model="form.password"  type="password" placeholder="password" id="password">
            <span>
                <input type="checkbox" id="checkbox"><label for="checkbox">Remember me</label>
            </span>
        </div>
       <div class="passwordForget"><button>Login</button>
           <a v-on:click="forgot_form = true">I forgot my password</a></div>
    </form>

</template>

<script>
import ForgotForm from "./ForgotForm";
export default {
    name: "SignForm",
    components: {ForgotForm},
    comments:{
        ForgotForm
    },
    data(){
        return{
            form:{
                email:'',
                password:''
            },
            forgot_form:false

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
    @mixin  center(){
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .sign_form{
        width: 100%;
        height: 300px;



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
            span{
                @include center();
                width: 100%;
                input{
                    width: 20px;
                    margin: auto 0.5rem auto auto;

                    background: lightpink;

                }
                label{
                    margin:  auto auto auto 0 ;
                }
            }
        }
        .passwordForget{
            @include center();
            width: 100%;
            button{
                width: 30%;
                height: 20px;
                background: #fcfafa;
                border:none;

            }
            a{
                text-decoration: underline;
                padding: 0.5rem;                cursor: pointer;

            }
            a:hover{
                color: #b1b1b1;
            }
        }





    }
</style>
