<template>
<div class="chat_template">
    <header class="header">
        options
    </header>
    <section class="messages">
        <p>Filipp : Hello </p>
        <p>Jefry : somme answer</p>
        <p>Filipp : dftgert eryery </p>
        <p>Jefry : rtyrty rtyrtr</p>
        <p>Filipp :rtyrty message </p>
        <p>Jefry : somme answer</p>
        <p>Filipp : rtyrtyre message </p>
        <p>Jefry : somme rtyrtyr</p>
        <p>Filipp : somme message </p>
        <p>Jefry : rtyrty answer</p>
        <p>Filipp : rtyrtyry ssage </p>
        <p>Jefry : somme artyrtrytr</p>
    </section>
    <form class="inp_form">
        <input type="text" class="input" placeholder="Enter your message...">
        <button type="submit" class="btn">Send</button>
    </form>
</div>
</template>

<script>
export default {
name: "ChatTemplate"
}
</script>

<style lang="scss" scoped>
.chat_template{
    border: 1px solid red;
    height: 500px;
    width: 450px;
    display: grid;
    grid-template-rows: 2fr 400px 2fr;
    grid-row-gap: 10px;



    .header{
        border: 1px solid red;
    }
    .messages{
        border: 1px solid red;
        overflow-y: auto;
        padding: 10px;

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
        padding: 10px;
        display: flex;

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
            background: rgb(0, 180, 50);
        }
    }





}
</style>
