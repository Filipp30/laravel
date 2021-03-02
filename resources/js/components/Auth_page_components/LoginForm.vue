<template>

    <form @submit.prevent="onSignSubmit" class="login_form" autocomplete="off">
        <div class="login_form__inputs">
            <div>
                <label for="email">E-Mail</label>
                <input v-model="form.email" type="email" placeholder="email" id="email" autocomplete="off" >
            </div>
            <div>
                <label for="password">Password</label>
                <input v-model="form.password"  type="password" placeholder="password" id="password" autocomplete="off">
            </div>
        </div>

        <div class="login_form__btn">
            <button>Login</button>
            <a v-on:click="$emit('show_forgot_form')" >I forgot my password</a>
        </div>

        <div class="login_form__error">
            <Spinner/>
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
        }
    },
    methods:{
        onSignSubmit(){
            axios.post('/api/login',this.form).then((response)=>{
                console.log(response)
            }).catch((error)=>{
                console.log(error);
            })
        },
    },
}
</script>

<style lang="scss" scoped>
    .login_form{
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
                    border-bottom: 2px solid blue;
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
