<template>

    <form @submit.prevent="onSignSubmit" class="login_form" autocomplete="off">
        <div class="login_form__inputs">
            <div>
                <label for="email">E-Mail</label>
                <input v-model="form.email"
                       v-bind:style="{'border-bottom':input_error.empty_email===true? input_error.input_border_red:input_error.input_border_black}"
                       type="email" placeholder="email" id="email" autocomplete="off" >
            </div>
            <div>
                <label for="password">Password</label>
                <input v-model="form.password"
                       v-bind:style="{'border-bottom':input_error.empty_password===true? input_error.input_border_red:input_error.input_border_black}"
                       type="password" placeholder="password" id="password" autocomplete="off">
            </div>
        </div>

        <div class="login_form__btn">
            <button>Login</button>
            <a v-on:click="$emit('show_forgot_form')" >I forgot my password</a>
        </div>

        <div class="login_form__error">
            <Spinner v-if="spinner"/>
            <div v-if="response">
                <h4>{{response}}</h4>
            </div>
        </div>

    </form>

</template>

<script>
import Spinner from "../Spinner";
export default {
    name: "SignForm",
    components: {Spinner},
    comments:{
        Spinner
    },
    data(){
        return{
            form:{
                email:'',
                password:''
            },
            spinner:false,
            response:'',
            input_error:{
                empty_email:false,
                empty_password:false,
                input_border_black:'1px solid black',
                input_border_red:'1px solid red'
            }
        }
    },
    watch:{
        form: { deep:true, handler(){
                this.input_error.empty_email = false;
                this.input_error.empty_password = false;
                if (this.response !== 'Login successfully'){
                    this.response = '';
                }
            }
        },
    },
    methods:{
        onSignSubmit(){
            this.check_inputs();
            if (this.input_error.empty_email || this.input_error.empty_password){
                this.response = 'Fields empty';
            }else{
                this.response = '';
                this.spinner = true;
                axios.post('/api/login',this.form).then((response)=>{
                    this.spinner = false;
                    this.form.email = '';
                    this.form.password = '';
                    this.response = 'Login successfully';
                }).catch((error)=>{
                    this.spinner = false;
                    this.response = error.response.data.errors.email[0];
                })
            }
        },
        check_inputs(){
            if (this.form.email === ''){
                this.input_error.empty_email = true;
            }
            if (this.form.password === ''){
                this.input_error.empty_password = true;
            }
        }
    },
}
</script>

<style lang="scss" scoped>
@import "./resources/css/content_colors";
    .login_form{
        margin: auto;
        width: 300px;
        height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        &__inputs{

            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus,
            input:-webkit-autofill:active,
            input:-webkit-autofill:valid,
            select:-webkit-autofill,
            select:-webkit-autofill:hover,
            select:-webkit-autofill:focus
            {
                -webkit-transition-delay: 99999s;
                -webkit-text-fill-color: black;
                transition-delay: 9999s;

            }

            width: 300px;
            height:150px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;

            div{
            display: flex;
            justify-content: space-between;
            align-items: center;

                input{
                    outline: none;
                    width: 200px;
                    height: 30px;
                    border:none;
                    border-bottom: 1px solid black;
                    background-color: transparent;
                }

            }
        }
        &__btn{

            width: 300px;
            height:40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            button{
                border:none;
                outline: none;
                width: 120px;
                border-radius: 2px;
                background-color:gray;
                color:white;
                font-size: 20px;
            }
            button:hover{
                cursor: pointer;
                background-color: transparent;
                border-radius: 2px;
                border: 1px solid black;
                color: black;
            }
            a{
                color: gray;
                font-size: 1rem;
                font-weight: bold;
                &:after{
                    content: '';
                    display: block;
                    border-bottom: 2px solid $lines_color;
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

        &__error{
            align-items: center;
            width: 300px;
            height:100px;
            display: flex;
            justify-content: center;
        }
    }
</style>
