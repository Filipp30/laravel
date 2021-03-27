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

                    <div v-if="connected === false">
                        <h1 v-if="user_wait_for_connection === false">maak connetctie met medewerker</h1>
                        <p v-if="user_wait_for_connection">Er wordt connectie gemaak met Admin even gedult aub</p>
                        <button v-on:click="chat_connection">connect</button>
                    </div>


                <div v-if="connected" class="chat__template">
                    <ChatTemplate
                        v-bind:user="auth"/>
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
            connected:false,
            show_chat_connected:false,
            user_wait_for_connection:false,
            chat_session: this.$session.get('chat_session')

        }
    },
    methods:{
        chat_connection() {
            this.spinner = true;
            this.user_wait_for_connection = true;
            axios.get('/api/chat/call_admin_for_chat').then((response) => {
                this.$session.start();
                this.$session.set('chat_session', response.data);
                this.chat_session = response.data;
                this.spinner = false;
                this.connected = true;
                this.show_chat_connected = false;
                this.user_wait_for_connection = false;
            }).catch((error) => {
                console.log(error)
            });

        }
    },mounted() {
        this.spinner = true;
        axios.get('/api/user').then((response)=>{
            this.auth = response.data;
            this.authenticated = true;
            this.spinner = false;
            this.connected = !!this.$session.get('chat_session');
        }).catch((error)=>{
            this.unauthenticated = true;
            this.spinner = false;
            this.auth = error.response.data.message;
        });
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
    //width: 600px;
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
@media screen and (max-width:540px){
    .chat{
        .title{
            font-size: 15px;
        }
    }
}
</style>
