<template>
    <div class="contact_page">
        <section class="contact">
            <div class="contact__menu">
                <nav>
                    <a v-on:click="info_form= true;email_form = false;chat_form = false;"
                       v-bind:class="{active: info_form}">Info
                    </a>
                    <a v-on:click="email_form = true;info_form = false;chat_form = false;"
                        v-bind:class="{active: email_form}">Send Mail
                    </a>
                    <a v-on:click="chat_form = true;email_form = false;info_form = false;"
                       v-bind:class="{active: chat_form}">Chat
                    </a>
                </nav>
            </div>
            <div class="contact__content">
                <InfoForm v-if="info_form"/>
                <EmailForm v-if="email_form"/>
                <ChatForm v-if="chat_form" />
            </div>
        </section>
    </div>

</template>

<script>
import InfoForm from "../components/Contact_page_components/InfoForm";
import EmailForm from "../components/Contact_page_components/EmailForm";
import ChatForm from "../components/Contact_page_components/ChatForm";
export default {
    name: "Contact",
    components: { InfoForm,EmailForm,ChatForm},
    data(){
        return{
            info_form:false,
            email_form:false,
            chat_form:true
        }
    }
}
</script>

<style lang="scss" scoped>
.contact_page{
    height: 90vh;
    display: flex;
    justify-content: space-around;
    align-items: center;
    .contact{
        background-image: url("../../css/images/contact_daan.jpg");
        background-position: top;
        background-size:cover;
        background-repeat: no-repeat;
        box-shadow: 0px 1px 18px -3px rgba(0,0,0,0.75);
        width: 1150px;
        height: 500px;
        display: flex;
        &__menu{
            width: 100%;
            nav{
                background-color: white;
                opacity: 0.9;
                width: 130px;
                height: 500px;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                a{
                    color: gray;
                    font-size: 1.5rem;
                    font-weight: bold;
                    padding: 5px;
                    &:after{
                        content: '';
                        display: block;
                        border-bottom: 2px solid #24bc83;
                        width: 0;
                        -webkit-transition: 0.5s ease;
                        transition: 0.5s ease;
                    }
                    &:hover:after { width: 100%; }
                }
                a:hover{
                    cursor: pointer;
                }
            }
            .active{
                &:after{
                    content: '';
                    display: block;
                    border-bottom: 2px solid #24bc83;
                    width: 100%;
                    -webkit-transition: 0.5s ease;
                    transition: 0.5s ease;
                }
            }
        }
        &__content{
            height:500px;
        }

    }

}


</style>
