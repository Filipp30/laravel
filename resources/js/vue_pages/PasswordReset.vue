<template>
    <div class="password_reset_page">
        <h1>Reset Password Page</h1>
        <form @submit.prevent="on_Reset_Password_Submit" class="reset_form" autocomplete="off">
            <div class="reset_form__inputs">
                <div>
                    <label for="email">E-Mail</label>
                    <input  type="email" required="required" placeholder="email" id="email" v-bind:value="form.email">
                </div>
                <div>
                    <label for="password">New Password</label>
                    <input   type="password" required="required" placeholder="password" id="password" v-model="form.password" >
                </div>
                <div>
                    <label for="confirm_password">Password Confirmation</label>
                    <input   type="password" required="required" placeholder="password" id="confirm_password" v-model="form.password_confirmation" >
                </div>

            </div>

            <div class="reset_form__btn">
                <button type="submit" >Save password</button>
                <Spinner v-if="spinner" />
            </div>

            <div class="reset_form__error">
                <div v-if="response">
                    <h4>{{response}}</h4>
                </div>
            </div>
        </form>
    </div>


</template>

<script>
import Spinner from "../components/Spinner";
export default {
name: "PasswordReset",
    components: {Spinner},
    comments:{
    Spinner
    },
    data(){
        return{
            form:{
                email:this.$route.query.email,
                password:'',
                password_confirmation:'',
                token:this.$route.path.substr(20),
            },
            spinner:false,
            response:''
        }
    },
    filters:{
        url_token(value){
            return value.substr(20);
        }
    },
    mounted() {
        console.log(this.token)
    },

    methods:{
        on_Reset_Password_Submit(){
            this.spinner = true;
            axios.post('/api/password/reset',this.form).then((response)=>{
                this.spinner = false;
                this.response = response.data.message
                this.form.email = '';
                this.form.password = '';
                this.form.password_confirmation = '';
            }).catch((error)=>{
                this.spinner = false;
                this.response = error.response.data.errors;
            });
        }
    }
}
</script>

<style lang="scss" scoped>
.password_reset_page{
    background-color: #d2dce5;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    .reset_form{
        margin: auto;
        width: 500px;
        height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        &__inputs{
            width: 450px;
            height:150px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            input{
                outline: none;
                width: 200px;
                height: 30px;
                border:none;
                border-bottom: 1px solid black;
                background-color: transparent;
            }
            div{
                display: flex;
                justify-content: space-between;
                align-items: center;
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
                width: 150px;
                border-radius: 2px;
                background-color:gray;
                color:white;
                font-size: 20px;
            }
            button:hover{
                width: 150px;
                border-radius: 2px;
                font-size: 20px;
                cursor: pointer;
                background-color: transparent;
                outline: 1px solid black;
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
}
</style>
