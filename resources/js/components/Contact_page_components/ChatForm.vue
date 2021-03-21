<template>
    <div class="chat">
        <h1 class="title">
            You can now Live chat with us ...
        </h1>
        <div class="chat__content">
            <div v-if="authenticated" class="authenticated">
                <div v-if="show_chat_connected" class="chat_connect">
                    <p>Welcome {{auth.name}}</p>
                    <a v-on:click="chat_connection">Connect to Live-Chat</a>
                </div>
                <div v-if="connected" class="chat__template">
                    <ChatTemplate v-bind:user="auth" />
                </div>

            </div>
            <div v-if="unauthenticated" class="unauthenticated">
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
            spinner:false,
            connected:true,
            show_chat_connected:false
        }
    },
    methods:{
        chat_connection(){
        this.spinner = true;
        setTimeout(()=>{
            this.spinner = false;
            this.connected = true;
            this.show_chat_connected = false;
            },1000)
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
@import "./resources/css/content_colors";

@mixin a_link{
    a{
        text-decoration: none;
        color: gray;
        font-size: 1rem;
        font-weight: bold;
        &:after{
            content: '';
            display: block;
            border-bottom: 2px solid $lines_color;
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
.chat{
    width: 600px;
    .title{
        background-color: $lines_color;
        padding: 5px;
    }

    &__content{
        .authenticated{
            .chat_connect{
                @include a_link;
            }

        }
        .unauthenticated{
            @include a_link;
        }
    }
}
</style>
