<template>
<div class="chat">
    <section class="chat__wait">
        <p class="title">Users-List</p>
        <div class="spinner_wait_list">
            <Spinner v-if="spinner_wait_list"/>
        </div>
        <div v-for="item in sessions" v-bind:key="sessions.id" v-bind:id="item.session"   class="wait_container">
            <article v-on:click="on_session_clicked(item.session)"   class="item">
                <h5>Session : <span>{{item.session}}</span></h5>
                <p>Time start:<span>{{item.created_at | getTime}}</span></p>
                <p>User name : <span>{{item.user.name}}</span></p>
                <p>User email : <span>{{item.user.email}}</span></p>
                <p>Registration date : <span>{{item.user.created_at | getDatum}}</span></p>
                <p class="wait_list_new_message">new message ...</p>
            </article>
        </div>
    </section>
    <section class="chat__template">
            <header class="header">
                <h1>Chat</h1>
                <p v-if="name_typing">{{name_typing.name}} typing...</p>
                <button>Close</button>
            </header>
            <Spinner v-if="spinner_chat"/>
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
    </section>
</div>
</template>

<script>
import Spinner from "../Spinner";
import {debounce} from "lodash";
export default {
    name: "Chat",
    components:{Spinner},
    data(){
        return{
            messages:[],
            sessions:[],
            admin_session:'',
            admin_name:'',
            name_typing:'',
            reset_typing:debounce(function () {this.name_typing =''}, 1000),
            form:{
                input_message:'',
                name: '',
                chat_session: ''
            },
            errors:{
                info:''
            },
            spinner_wait_list:false,
            spinner_chat:false,
            session_active:'',

        }
    },
    mounted() {

        this.spinner_wait_list = true;

        axios.get('api/admin/chat/chat_waiting_list').then((response)=>{
            // console.log(response.data[0].user);
            this.sessions=response.data;
            this.spinner_wait_list = false;
        }).catch((error)=>{
            this.errors.info = error;
        });
        axios.get('/api/user').then((response)=>{
            this.admin_name = response.data.name;
        })
        let _this = this;
        Echo.private("my-channel")

            .listenForWhisper('typing', function(response){
                if (response.session === _this.admin_session){
                    _this.name_typing = response;
                    _this.reset_typing();
                }
            })
            .listen("NewMessage", function (response){
                if (_this.form.chat_session === response.session){
                    _this.add_message_to_local_data(response);
                }
            })
            .listen("CallAdmin",function(response){
                _this.get_chat_session_to_local_wait_list(response.session);
            })
            .listen("RemoveChatSession",function(response){
                _this.remove_chat_session_from_local_wait_list(response.session);
            })
    },
    methods:{
        on_session_clicked:function(session){
            this.admin_session = session;
            this.form.chat_session = session;
            this.spinner_chat = true;
            document.getElementById(session).classList.add('active');
            axios.get('api/chat/get_all_messages',{params:{chat_session: this.admin_session }}).then((response)=>{
                this.messages = response.data;
                this.spinner_chat = false;
            }).catch((error)=>{
                this.errors.info = error;
            })
        },

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
        get_chat_session_to_local_wait_list:function (session){
            axios.get('api/admin/chat/get_chat',{params:{chat_session: session }}).then((response)=>{
                this.sessions.push(response.data[0]);
            }).catch((error)=>{
                console.log(error)
            });
        },
        remove_chat_session_from_local_wait_list:function(session){
            for( let i = 0; i < this.sessions.length; i++){
                if ( this.sessions[i].session === session) {
                    this.sessions.splice(i, 1);
                }
            }
        }
    },
    watch:{
        'form.input_message': function(){
            Echo.private(`my-channel`).whisper('typing', {
                name: this.admin_name,
                session: this.admin_session
            });
        },
    },
    filters:{
        getTime: function (value){
            return value.substr(11, 8);
        },
        getDatum: function (value){
            return value.substr(0, 10);
        }
    },
}
</script>

<style lang="scss" scoped>
@import "./resources/css/content_colors";
.chat{
    display: flex;

   &__wait{
       height: 520px;
       //overflow-y:scroll;
        .title{
            margin:0;
            height: 20px;
        }
       .spinner{
           margin: auto;
           height: 80px;
           width: 80px;
       }
       .wait_container{

           padding: 10px;
           .item{
               background-color:$lines_color;
               width: 300px;
               height: 160px;
               line-height: 1.4;
               display: flex;
               flex-direction: column;
               justify-content: center;
               padding-left: 10px;
               box-shadow: 0px 0px 3px 2px rgba(0,0,0,0.75);
               .wait_list_new_message{
                   text-align: center;
                   font-weight: bold;
               }

           }
           .item:hover{
               box-shadow: 0px 0px 0px 3px rgba(0,0,0,0.75);
           }
       }
       .active{
           border: 1px solid  rgba(245,5,17,1);
       }
   }

    &__template{
        box-shadow: 0px 1px 18px -3px rgba(0,0,0,0.75);
        height: 520px;
        max-width: 450px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-left: 20px;

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
}



</style>
