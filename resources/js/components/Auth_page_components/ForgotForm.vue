<template>
        <form @submit.prevent="onForgotSubmit"  autocomplete="off" class="forgot_form">
            <div class="forgot_form__inputs">
                <div>
                    <label for="email">Enter your mail</label>
                    <input v-model="form.email" required="required" type="email" id="email" placeholder="email">
                </div>
                <button type="submit">Reset</button>
            </div>
        </form>
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
            justify-content: space-between;
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
                border:none;
                outline: none;
                width: 120px;
                border-radius: 2px;
                background-color:#07181B;
                color:#EBF4F3;
                font-size: 20px;
            }
            button:hover{
                cursor: pointer;
                background-color: gray;
                border: #1a202c;
                color: #1a202c;
            }
        }
    }
</style>
