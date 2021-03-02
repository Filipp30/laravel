<template>
    <form @submit.prevent="onRegSubmit" class="reg_form" autocomplete="off">
        <div class="reg_form__inputs">

            <div>
                <label for="username">Username</label>
                <input v-model="reg_form.name" type="text" placeholder="username" id="username">
            </div>

            <div>
                <label for="email">E-Mail</label>
                <input v-model="reg_form.email" type="email" placeholder="email" id="email">
            </div>

            <div>
                <label for="password">Password</label>
                <input v-model="reg_form.password"  type="password" placeholder="password" id="password">
            </div>

        </div>

        <div class="reg_form__btn">
            <button type="submit" >Register</button>
        </div>

        <div class="reg_form__error">
            <Spinner/>
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
            }
        }
    },
    methods:{
        onRegSubmit(){
            axios.post('/api/register',this.reg_form).then((response)=>{
                console.log(response.data)
            }).catch((error)=>{
                console.log(error.data)
            })
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
