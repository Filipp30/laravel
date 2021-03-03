<template>
    <div class="email">
        <h1 class="email__title">
            Contact us with email
        </h1>
        <form @submit.prevent="on_mail_send_submit"  class="email__form">
            <div class="email__form__inputs">
                    <div class="inp_1">
                        <div>
                            <label for="name">Full Name</label>
                            <input type="text" id="name">
                        </div>
                        <div>
                            <label for="email">E-Mail</label>
                            <input type="email" id="email">
                        </div>
                    </div>

                    <div class="inp_2">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject">
                    </div>
                    <div class="inp_2">
                        <label for="message">Message</label>
                        <textarea id="message" cols="30" rows="10" />
                    </div>
            </div>

            <div class="email__form__btn">
                <button>Send</button>
                <div>
                    <h3>Error</h3>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    name: "EmailForm",
    data(){
        return{

        }
    },
    methods:{
        on_mail_send_submit(){

        }
    }
}
</script>

<style lang="scss" scoped>
    .email{
        width: 600px;
        &__title{

            background-color: #24bc83;
            padding: 5px;
        }
        &__form{
            height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

            &__inputs{

                input{
                    width: 260px;
                    background-color: transparent;
                    outline: none;
                    border:none;
                    border-bottom: 1px solid black;

                }
                textarea{
                    background-color: transparent;
                    outline: none;
                    border:none;
                    border-bottom: 1px solid black;

                }

                width: 90%;
                margin-right: auto;
                height: 70%;
                display: flex;
                flex-direction: column;
                justify-content: space-around;

                .inp_1{
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                }
                .inp_2{
                    display: flex;
                    flex-direction: column;
                }
            }
            &__btn{
                width: 90%;
                margin-right: auto;
                button{
                    border:none;
                    outline: none;
                    width: 150px;
                    border-radius: 2px;
                    background-color:gray;
                    color:white;
                    font-size: 20px;
                }
                button:hover{
                    width: 150px;
                    border-radius: 2px;
                    font-size: 20px;
                    cursor: pointer;
                    background-color: transparent;
                    outline: 1px solid black;
                    color: black;
                }
            }


        }
    }

</style>
