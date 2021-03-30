<template>
    <div class="chat_template">
        <header class="header">
            <h1>Chat</h1>
            <p v-if="name_typing">{{name_typing.name}} typing...</p>
            <button v-on:click="remove_chat_session">Close</button>
        </header>
        <Spinner v-if="spinner"/>
        <section v-chat-scroll class="messages" id="mess">
            <div  v-if="messages" v-for="item in messages" v-bind:key="messages.id" >
                <p>{{item.created_at | getTime}} - {{item.user.name}} :</p>
                <p>{{item.message}}</p>
                <hr>
            </div>
        </section>
        <form @submit.prevent="post_message" class="inp_form">
            <input v-model="form.input_message" type="text" class="input" placeholder="Enter your message...">
            <button type="submit" class="btn">Send</button>
        </form>
        <p v-if="errors.info" class="info_bottom">{{errors.info}}</p>
    </div>
</template>

<script>
import {debounce} from "lodash";
import Spinner from "../Spinner";
export default {
    name: "ChatTemplate",
    props:['user'],
    components:{Spinner},
    data(){
        return{
            messages:[],
            name_typing:'',
            form:{
                input_message:'',
                name: this.user.name,
                chat_session: this.$session.get('chat_session')
            },
            spinner:false,
            errors:{
                info:''
            }
        }
    },
    mounted() {
        let _this = this;
        this.spinner = true;
        let chat_session = this.$session.get('chat_session');
        axios.get('api/chat/get_all_messages',{params:{chat_session: chat_session }}).then((response)=>{
            this.messages = response.data;
            this.spinner = false;
        }).catch((error)=>{
            this.errors.info =error;
        })

        Echo.private("my-channel")
        .listen("NewMessage", function (response){
            if (_this.form.chat_session === response.session){
              _this.add_message_to_local_data(response);
            }
        })
        .listenForWhisper('typing', function(response){
            if (response.session === _this.form.chat_session){
                _this.name_typing = response;
                _this.typing_active();
            }
        });
    },
    methods:{
        typing_active:debounce(function () {
            let _this = this;
            _this.name_typing ='';
        }, 1000),
        post_message:function(){
            this.errors.info = 'shipment...';
            axios.post('api/chat/add_message',this.form).then((response)=>{
                this.form.input_message='';
                this.errors.info = 'send';
                setTimeout(()=>{
                    this.errors.info = '';
                },1500)
            }).catch((error)=>{
                this.errors.info = error;
            });
        },
        add_message_to_local_data:function(data){
            this.messages.push({
                created_at:data.time,
                message: data.message,
                user: {name:data.name}
            });
        },
        remove_chat_session(){
            this.spinner = true;
            axios.post('api/chat/remove_chat_session',this.form).then((response)=>{
                this.$session.remove('chat_session');
                this.form.chat_session = '';
                this.$router.push({name: 'Home'});
            }).catch((error)=>{
                this.errors.info =error;
            });
        }
    },
    watch:{
        'form.input_message': function(){
            Echo.private(`my-channel`).whisper('typing', {
                    name: this.user.name,
                    session:this.form.chat_session
            });
        },
    },
    filters:{
        getTime: function (value){
            return value.substr(11, 8);
        }
    },
}
</script>

<style lang="scss" scoped>
@import "./resources/css/content_colors";
.chat_template{
    box-shadow: 0px 1px 18px -3px rgba(0,0,0,0.75);
    height: 520px;
    max-width: 450px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;



    .header{
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding:0 10px 0 10px;
        border-bottom: 1px solid #1a202c;
        button{
            outline: none;
            border: 1px solid white;
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
    .messages{
        height: 400px;
        overflow-y: auto;
        padding: 1px 10px;
    }
    .messages::-webkit-scrollbar {
        width: 6px;
    }
    .messages::-webkit-scrollbar-track {
        background: #ddd;
    }
    .messages::-webkit-scrollbar-thumb {
        background: #bdbdbd;
    }

    .inp_form {
        border-top: 1px solid #1a202c;
        margin-bottom: 0;
        flex: 1;
        display: flex;
        padding: 10px;

        .input {
            border-radius: 3px;
            font-size: 17px;
            flex:8;
            background: #ddd;
            height: 40px;
        }
        .btn {
            border-radius: 3px;
            flex:1;
            margin-left: 10px;
            background: $lines_color;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.23s;
        }
        .btn:hover {
            background: $lines_color;
        }
    }
    .info_bottom{
        margin:0 110px;
        font-size: 15px;
        height: 0px;
    }




}
</style>
