<template>

    <form @submit.prevent="on_Reset_Password_Submit" class="reg_form" autocomplete="off">
        <div class="reg_form__inputs">
            <label for="email">E-Mail</label>
            <input  type="email" placeholder="email" id="email" v-bind:value="form.email">
            <label for="password">New Password</label>
            <input   type="password" placeholder="password" id="password" v-model="form.password" >
            <label for="confirm_password">Password Confirmation</label>
            <input   type="password" placeholder="password" id="confirm_password" v-model="form.password_confirmation" >
        </div>
        <button type="submit" >Save password</button>
    </form>

</template>

<script>
export default {
name: "PasswordReset",
    data(){
        return{
            form:{
                email:this.$route.query.email,
                password:'',
                password_confirmation:'',
                token:this.$route.path.substr(20),
            }
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
            axios.post('/api/password/reset',this.form).then((response)=>{
                console.log(response.data)
            }).catch((error)=>{
                console.log(error)
            });
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
.reg_form{
    margin: auto;
    height: 300px;
    width: 20%;
    padding-top: 200px;

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
            margin-bottom: 1rem;
        }
    }




}
</style>
