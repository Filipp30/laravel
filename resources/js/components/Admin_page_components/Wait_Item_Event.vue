<template>
<div class="on_event">
    <p v-if="new_message" class="new_message">new message !</p>
    <p v-if="typing" class="typing">typing...</p>
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
        }
    }
}
</script>

<style lang="scss" scoped>

.on_event{
    display: flex;
    justify-content: space-around;
    .new_message{
        font-weight: bold;
    }
    .typing{
        font-weight: bold;
    }
}

</style>
