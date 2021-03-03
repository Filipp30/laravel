<template>
        <form @submit.prevent="onForgotSubmit"  autocomplete="off" class="forgot_form">
            <div class="forgot_form__inputs">

                    <label for="email">Enter your mail for reset your password</label>
                    <input v-model="form.email"
                           v-bind:style="{'border-bottom':empty_email===true? input_border_red:input_border_black}"
                           type="email" id="email" placeholder="email">
            </div>

            <div class="forgot_form__btn">
                <button type="submit">Reset</button>
            </div>

            <div class="forgot_form__error">
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
    name: "ForgotForm",
    components: {Spinner},
    comments:{
        Spinner
    },
    data(){
        return{
            form:{
                email:'',
            },
            spinner:false,
            response:'',
            empty_email:false,
            input_border_black:'1px solid black',
            input_border_red:'1px solid red'
        }
    },
    watch:{
        form: { deep:true, handler(){
                this.empty_email = false;
            }
        },
    },
    methods:{
        onForgotSubmit(){
            if (this.form.email === ''){
                this.empty_email = true;
            }else{
                this.response = '';
                this.spinner = true;
                axios.post('/api/password/email',this.form).then((response)=>{
                    this.spinner = false;
                    this.form.email = '';
                    this.response =response.data.message;
                }).catch((error)=>{
                    this.spinner = false;
                    this.response = error.response.data.errors.email[0];
                })
            }

        }
    }
}
</script>

<style lang="scss" scoped>
    .forgot_form{
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
            label{
                width: 200px;
            }
            input{
                outline: none;
                width: 200px;
                height: 30px;
                border:none;
                border-bottom: 1px solid black;
                background-color: transparent;
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
