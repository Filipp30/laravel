<template>
        <form @submit.prevent="onForgotSubmit"  autocomplete="off" class="forgot_form">
            <div class="forgot_form__inputs">

                    <label for="email">Enter your mail for reset your password</label>
                    <input v-model="form.email" required="required" type="email" id="email" placeholder="email">
            </div>

            <div class="forgot_form__btn">
                <button type="submit">Reset</button>
            </div>

            <div class="forgot_form__error">
                <Spinner/>
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
            }
        }
    },
    methods:{
        onForgotSubmit(){
            console.log(this.form)
            axios.post('/api/password/email',this.form).then((response)=>{
                console.log(response)
            }).catch((error)=>{
                console.log(error)
            })
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
