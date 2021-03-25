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
                            <input v-model="form.name" type="text" id="name" required="required">
                        </div>
                        <div>
                            <label for="email">E-Mail</label>
                            <input v-model="form.email" type="email" id="email" required="required">
                        </div>
                    </div>

                    <div class="inp_2">
                        <label for="subject">Subject</label>
                        <input v-model="form.subject" type="text" id="subject" required="required">
                    </div>
                    <div class="inp_2">
                        <label for="message">Message</label>
                        <textarea v-model="form.user_message" id="message" cols="30" rows="10" required="required" />
                    </div>
            </div>

            <div class="email__form__btn">
                <button type="submit">Send</button>
                <div class="spinner_error">
                    <Spinner v-if="spinner"/>
                    <h3 v-else>{{response}}</h3>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
import Spinner from "../Spinner";
export default {
    name: "EmailForm",
    components: {Spinner},
    data(){
        return{
            form:{
                name:'',
                email:'',
                subject:'',
                user_message:''
            },
            spinner:false,
            response:''
        }
    },
    methods:{
        on_mail_send_submit(){
            this.spinner = true;
            axios.post('/api/contact',this.form).then((response)=>{
                if (response.data === 1){
                    this.spinner = false;
                    this.response = "Email sent successfully";
                    this.reset_email_form();
                }else{
                    this.spinner = false;
                    this.response = 'Error';
                }

            }).catch((error)=>{
                this.spinner = false;
                this.response = 'Error';
            })
        },
        reset_email_form(){
            this.form.name = '';
            this.form.email = '';
            this.form.subject = '';
            this.form.user_message = '';
            setTimeout(()=>{
                this.response = '';
            },8000);
        }
    }
}
</script>

<style lang="scss" scoped>
@import "./resources/css/content_colors";
    .email{
        &__title{
            background-color: $lines_color;
            padding: 5px;
        }
        &__form{
            margin:50px 0px;
            height: 450px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-right: 40px;
            padding-left: 5px;
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
                height: 400px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-content: center;
                input{
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
                    display: flex;
                    justify-content: space-between;
                    div{
                        display: flex;
                        flex-direction: column;
                    }
                }
                .inp_2{
                    display: flex;
                    flex-direction: column;
                    input{
                        width:173px;
                    }
                }
            }
            &__btn{
                //width: 500px;
                height: 100px;
                button{
                    margin-top: 10px;
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
                .spinner_error{
                    height:80px;
                }
            }
        }
    }
@media screen and (max-width:700px){
    .email{
        .email__form__inputs{
            .inp_1{
                flex-direction: column;
                align-items: self-start;
                height: 105px;
            }
        }
    }
}
@media screen and (max-width:540px){
    .email{

        .email__title{
            font-size: 15px;
        }
    }
}
</style>
