<template>
    <div class="chat_template">
        <header class="header">
            <h1>Chat</h1>
            <p v-if="name_typing">{{name_typing.name}} typing...</p>
            <button>Close</button>
        </header>
        <section v-chat-scroll class="messages" id="mess">
            <div  v-if="messages" v-for="item in messages" v-bind:key="messages.id" >
                <p>{{item.time | getTime}} - {{item.name}} :</p>
                <p>{{item.message}}</p>
                <hr>
            </div>
        </section>
        <form @submit.prevent="post_message" class="inp_form">
            <input v-model="form.input_message" type="text" class="input" placeholder="Enter your message...">
            <button type="submit" class="btn">Send</button>
        </form>
    </div>
</template>

<script>
import {debounce} from "lodash";
export default {
    name: "ChatTemplate",
    props:['user'],
    data(){
        return{
            messages:[],
            name_typing:'',
            form:{
                input_message:'',
                name: this.user.name,
            },
        }
    },
    mounted() {
        let _this = this;
        axios.get('api/chat/get_all_messages').then((response)=>{
            _.forEach(response.data,function(item){
                _this.messages.push(item);
            });
        }).catch((error)=>{
            console.log(error)
        })

        Echo.private("my-channel")
        .listen("NewMessage", function (response){
            _this.add_message_to_local_data(response);
        })
        .listenForWhisper('typing', function(response){
                _this.name_typing = response;
                _this.typing_active();
        });
    },
    methods:{
        typing_active:debounce(function () {
            let _this = this;
            _this.name_typing ='';
        }, 1000),
        post_message:function(){
            axios.post('api/chat/add_message',this.form).then((response)=>{
                console.log(response)
            }).catch((error)=>{
                console.log(error)
            });
        },
        add_message_to_local_data:function(data){
            this.messages.push({
                name: data.name,
                time:data.time,
                message: data.message,
            });
            this.form.input_message='';
        }
    },
    watch:{

        'form.input_message': function(){
            Echo.private(`my-channel`).whisper('typing', {
                    name: this.user.name
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
    width: 450px;
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





}
</style>
