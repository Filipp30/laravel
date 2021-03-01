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

            <button type="submit" >Register</button>

        </div>
    </form>
</template>

<script>
export default {
    name: "RegForm",
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

        &__inputs{
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
                align-items: center;
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
