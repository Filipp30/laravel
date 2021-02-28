<template>

    <ForgotForm v-if="forgot_form" v-on:forgotForm="forgot_form = false" />

    <form v-else @submit.prevent="onSignSubmit" class="login_form" autocomplete="off">
        <div class="login_form__inputs">
            <div>
                <label for="email">E-Mail</label>
                <input v-model="form.email" type="email" placeholder="email" id="email" autocomplete="off" >
            </div>
            <div>
                <label for="password">Password</label>
                <input v-model="form.password"  type="password" placeholder="password" id="password" autocomplete="off">
            </div>
            <div class="form__btn">
                <button>Login</button>
                <a v-on:click="forgot_form = true">I forgot my password</a>
            </div>
        </div>



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
    .login_form{
        margin: auto;
        width: 300px;

        &__inputs{
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

            input{
            outline: none;
            width: 200px;
            height: 30px;
            border:none;
            border-bottom: 1px solid black;
            }
            div{
            display: flex;
            justify-content: space-between;
            align-items: center;

            }
            button{
                border:none;
                outline: none;
                width: 110px;
                border-radius: 5px;
                background-color:#4694A8;
                color: black;
                font-size: 20px;
            }
            button:hover{
                cursor: pointer;
                background-color: #4ac7e3;
                border: #1a202c;
                color: #1a202c;
            }
            a{
            color: gray;
            font-size: 1rem;
            font-weight: bold;
            &:after{
                content: '';
                display: block;
                border-bottom: 3px solid blue;
                width: 0;
                -webkit-transition: 0.5s ease;
                transition: 0.5s ease;
            }
            &:hover:after { width: 100%; }
            }
            a:hover{
                cursor: pointer;
            }
        }
    }
</style>
