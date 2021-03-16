<template>
<div class="chat_template">
    <header class="header">
        <h1>Chat</h1>
        <p>Typing...</p>
        <button>Close</button>
    </header>
    <section class="messages" id="mess">
        <div v-for="item in data" v-bind:key="data.id" >
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

export default {
name: "ChatTemplate",
    data(){
        return{
            data:[],
            form:{
                input_message:''
            }
        }
    },
    filters:{
        getTime: function (value){
            return value.substr(11, 8);
        }
    },
    beforeMount() {
        axios.get('api/chat/get_all_messages').then((response)=>{
            this.data = response.data;
        }).catch((error)=>{
            console.log(error)
        })
    },
    created(){
        Echo.channel('my-channel')
            .listen('my-event', (e) => {
                console.log(e);
            });
    },

    methods:{
        post_message(){
            this.add_message_to_data(this.form.input_message);
            axios.post('api/chat/add_message',this.form).then((response)=>{
                this.add_message_to_data(this.form.input_message);
                console.log(response)
            }).catch((error)=>{
                console.log(error)
            })
        },
        add_message_to_data(value){
            this.data.push({
                name: this.user.name,
                time:'0000-00-00 00:00:00',
                message: value,
            })
        },


    },
    props:['user'],
    watch:{
        input_message: function(){
            console.log('Typing...')
        },

    }
}
</script>

<style lang="scss" scoped>
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
            background: rgb(0, 196, 65);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.23s;
        }
        .btn:hover {
            background: #24bc83;
        }
    }





}
</style>
