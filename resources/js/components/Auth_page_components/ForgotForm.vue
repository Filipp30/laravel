<template>
    <section class="forgot_form">
        <form @submit.prevent="onForgotSubmit"  autocomplete="off" class="forgot_form__inputs">
            <div>
                <label for="email">Enter your mail</label>
                <input v-model="form.email" required="required" type="email" id="email">
            </div>
            <button type="submit">Send request for new password</button>
        </form>
        <button v-on:click="$emit('forgotForm')">Back to Log in </button>
    </section>


</template>

<script>
export default {
    name: "ForgotForm",
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

        &__inputs{
            height: 150px;
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
            }
            div{
                display: flex;
                justify-content: space-between;


            }
            button{
                align-content: center;
                border:none;
                outline: none;
                width: 100%;
                padding: 2px;
                border-radius: 5px;
                background-color:#4694A8;
                color: black;
                font-size: 15px;

            }
            button:hover{
                cursor: pointer;
                background-color: #4ac7e3;
                border: #1a202c;
                color: #1a202c;
            }
        }

    }
</style>
