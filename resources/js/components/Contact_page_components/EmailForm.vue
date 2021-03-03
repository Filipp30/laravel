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
                            <input type="text" id="name" required="required">
                        </div>
                        <div>
                            <label for="email">E-Mail</label>
                            <input type="email" id="email" required="required">
                        </div>
                    </div>

                    <div class="inp_2">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" required="required">
                    </div>
                    <div class="inp_2">
                        <label for="message">Message</label>
                        <textarea id="message" cols="30" rows="10" required="required" />
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
        form:{
            name:'',
            email:'',
            subject:'',
            message:''
        }
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
            height: 90%;
            display: flex;
            flex-direction: column;
            justify-content: center;

            &__inputs{
                input:-webkit-autofill,
                input:-webkit-autofill:hover,
                input:-webkit-autofill:focus,
                input:-webkit-autofill:active,
                input:-webkit-autofill:valid,
                select:-webkit-autofill,
                select:-webkit-autofill:hover,
                select:-webkit-autofill:focus
                {
                    -webkit-transition-delay: 99999s;
                    -webkit-text-fill-color: black;
                    transition-delay: 9999s;

                }


                width: 90%;
                height: 70%;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                align-content: center;
                input{
                    width: 260px;
                    background-color: transparent;
                    outline: none;
                    border:none;
                    border-bottom: 1px solid black;
                }
                textarea{
                    height: 120px;
                    background-color: transparent;
                    outline: none;
                    border:none;
                    border-bottom: 1px solid black;
                }

                .inp_1{
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                }
                .inp_2{
                    display: flex;
                    flex-direction: column
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
