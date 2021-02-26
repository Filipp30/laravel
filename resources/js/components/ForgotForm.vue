<template>
    <section>
        <form @submit.prevent="onForgotSubmit" class="forgot_form" autocomplete="off">
            <label for="email">Enter your mail</label>
            <input v-model="form.email" required="required" type="email" id="email">
            <button type="submit">Send request for new password</button>
        </form>

        <h3>Check your mail-box for reset your password</h3>
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
section{
    display: flex;
    flex-direction: column;
    justify-content: space-around;


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

}
</style>
