<template>
    <form @submit.prevent="onRegSubmit" class="reg_form" autocomplete="off">
        <div class="reg_form__inputs">

            <div>
                <label for="username">Username</label>
                <input v-model="reg_form.name"
                       v-bind:style="{'border-bottom':input_error.empty_username===true? input_error.input_border_red:input_error.input_border_black}"
                       type="text" placeholder="username" id="username">
            </div>

            <div>
                <label for="email">E-Mail</label>
                <input v-model="reg_form.email"
                       v-bind:style="{'border-bottom':input_error.empty_email===true? input_error.input_border_red:input_error.input_border_black}"
                       type="email" placeholder="email" id="email">
            </div>

            <div>
                <label for="password">Password</label>
                <input v-model="reg_form.password"
                       v-bind:style="{'border-bottom':input_error.empty_password===true? input_error.input_border_red:input_error.input_border_black}"
                       type="password" placeholder="password" id="password">
            </div>

        </div>

        <div class="reg_form__btn">
            <button type="submit" >Register</button>
        </div>

        <div class="reg_form__error">
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
    name: "RegForm",
    components: {Spinner},
    comments:{
        Spinner
    },
    data(){
        return{
            reg_form:{
                name:'',
                email:'',
                password:'',
            },
            spinner:false,
            response:'',
            input_error:{
                empty_username:false,
                empty_email:false,
                empty_password:false,
                input_border_black:'1px solid black',
                input_border_red:'1px solid red'
            }
        }
    },
    reg_form: { deep:true, handler(){
            this.input_error.empty_username = false;
            this.input_error.empty_email = false;
            this.input_error.empty_password = false;
            this.response = '';
        }
    },
    watch:{
        reg_form: { deep:true, handler(){
                this.input_error.empty_username=false,
                this.input_error.empty_email = false;
                this.input_error.empty_password = false;
                if (this.response !== 'Registration successfully'){
                    this.response = '';
                }
            }
        },
    },
    methods:{
        onRegSubmit(){
            this.check_inputs();
            if (this.input_error.empty_username || this.input_error.empty_email || this.input_error.empty_password){
                this.response = 'Fields empty';
            }else{
                this.response = '';
                this.spinner = true;
                axios.post('/api/register',this.reg_form).then((response)=>{
                    this.spinner = false;
                    this.response = 'Registration successfully';
                    this.reg_form.name = '';
                    this.reg_form.email = '';
                    this.reg_form.password = '';
                }).catch((error)=>{
                    this.spinner = false;
                    this.response = error.response.data.errors.email[0];
                })
            }
        },
        check_inputs(){
            if (this.reg_form.name === ''){
                this.input_error.empty_username = true;
            }
            if (this.reg_form.email === ''){
                this.input_error.empty_email = true;
            }
            if (this.reg_form.password === ''){
                this.input_error.empty_password = true;
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .reg_form{
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
