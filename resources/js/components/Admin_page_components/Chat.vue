<template>
<div class="chat">
    <section class="chat__wait">
        <p class="title">Users-List</p>
        <div class="spinner">
            <Spinner/>
        </div>
        <div class="wait_container">
            <article class="item">
                <p>session : <span>1616963895</span></p>
                <p>create_at : <span>22:38:15</span></p>
            </article>
        </div>
    </section>
    <section class="chat__template">
            <header class="header">
                <h1>Chat</h1>
                <p v-if="name_typing">User typing...</p>
                <button>Close</button>
            </header>
            <Spinner v-if="spinner"/>
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
            <p v-if="errors.info" class="info_bottom">{{errors.info}}</p>
    </section>
</div>
</template>

<script>
import Spinner from "../Spinner";
export default {
    name: "Chat",
    components:{Spinner},
    data(){
        return{
            form:{
                input_message:'',
                name: '',
            },
        }
    },
    mounted() {

    }
}
</script>

<style lang="scss" scoped>
@import "./resources/css/content_colors";
.chat{
    display: flex;


   &__wait{
       border: 1px solid red;
       height: 520px;
       width: 100px;

        .title{
            margin:0;
            border: 1px solid green;
            height: 20px;
        }

       .spinner{
           border: 1px solid blue;
           margin: auto;
           height: 80px;
           width: 80px;
       }
       .wait_container{
           .item{
               border: 1px solid black;
               background-color: yellow;
               width: 100px;
               height: 80px;

               p{
                   margin: 0;
               }
           }
       }
   }

    &__template{
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
}



</style>
