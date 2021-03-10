<template>
    <div class="chat">
        <h1 class="chat__title">
            You can now Live chat with us ...
        </h1>
        <div class="chat__content">


            <div v-if="authenticated" class="chat">
                <div class="chat__connect">
                    <p>Welcome {{auth.name}}</p>
                    <a v-on:click="chat_connection">Connect to Live-Chat</a>
                </div>
                <div v-if="connected" class="chat__template">
                    <ChatTemplate/>
                </div>

            </div>
            <div v-if="unauthenticated" class="auth">
                <p>You are unauthenticated ! Pleas first log in...</p>
                <RouterLink to="/auth">Go to Auth page</RouterLink>
            </div>
            <Spinner v-if="spinner"/>
        </div>
    </div>
</template>

<script>
import Spinner from "../Spinner";
import ChatTemplate from "./ChatTemplate";
export default {
    name: "ChatForm",
    components: {Spinner,ChatTemplate},

    data(){
        return{
            auth:'',
            unauthenticated:false,
            authenticated:false,
            spinner:true,
            connected:false
        }
    },
    methods:{
        chat_connection(){
        this.spinner = true;
        setTimeout(()=>{
            this.spinner = false;
            this.connected = true;
            },1500)
        }

    },mounted() {
        this.spinner = true;
        axios.get('/api/user').then((response)=>{
            this.auth = response.data;
            this.authenticated = true;
            this.spinner = false;
        }).catch((error)=>{
            this.unauthenticated = true;
            this.spinner = false;
            this.auth = error.response.data.message;
        })
    }
}
</script>

<style lang="scss" scoped>
.chat{
    width: 600px;
    &__title{
        background-color: #24bc83;
        padding: 5px;
    }
    &__content{

        .auth{
            a{
                text-decoration: none;
                color: gray;
                font-size: 1rem;
                font-weight: bold;
                &:after{
                    content: '';
                    display: block;
                    border-bottom: 2px solid #24bc83;
                    width: 0;
                    -webkit-transition: 0.5s ease;
                    transition: 0.5s ease;
                }
                &:hover:after { width: 30%; }
            }
            a:hover{
                cursor: pointer;
            }
        }
    }







}
</style>
