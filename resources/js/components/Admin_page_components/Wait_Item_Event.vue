<template>
<div v-if="!active" class="on_event">
    <div class="new_message">
        <p v-if="new_message" >new message !</p>
    </div>
    <div class="typing">
        <p v-if="typing" >typing...</p>
    </div>
</div>
</template>

<script>
import {debounce} from "lodash";

export default {
    name: "Wait_Item_Event",
    props:['session','bool'],
    data(){
        return{
            new_message:false,
            typing:false,
            reset_typing:debounce(function () {this.typing = false}, 2000),
            active:false
        }
    },
    mounted() {
        let _this = this;
        Echo.private("my-channel")

        .listenForWhisper('typing', function(response){
            if (response.session === _this.session){
                _this.typing = true;
                _this.reset_typing();
            }
        })
        .listen("NewMessage", function (response){
            if (response.session === _this.session){
                _this.new_message = true;
            }
        })
    },
    watch:{
        'bool':function (){
            this.new_message = false;
            this.active = true;
        }
    }
}
</script>

<style lang="scss" scoped>

.on_event{
    width: 300px;
    height: 25px;
    display: flex;
    justify-content: space-between;
    .new_message{
        width: 150px;
        font-weight: bold;
    }
    .typing{
        width: 150px;
        font-weight: bold;
    }
}

</style>
