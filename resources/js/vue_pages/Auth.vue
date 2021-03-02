<template>
    <section class="auth">
        <div class="auth__content">

            <div class="auth__content__cover">
                <h1>Laravel -Vue_Developer</h1>
            </div>

            <div class="auth__content__container">
                <nav>
                    <a v-on:click="sign_form= true;reg_form = false;forgot_form = false;"
                       class="sign" v-bind:class="{active: sign_form}">Log-in
                    </a>
                    <a v-on:click="reg_form = true;sign_form = false;forgot_form = false;"
                       class="reg" v-bind:class="{active: reg_form}">Create Account
                    </a>
                </nav>

                <section class="auth__content__form">
                    <ForgotForm v-if="forgot_form" />
                    <SignForm v-if="sign_form" v-on:show_forgot_form="forgot_form=true;sign_form= false;reg_form = false;"/>
                    <RegForm v-if="reg_form"/>
                </section>

                <footer>
                    <hr>
                    <div>© 2021 Laravel -Vue_Developer.</div>
                </footer>
            </div>

        </div>
    </section>
</template>

<script>
import SignForm from "../components/Auth_page_components/LoginForm";
import RegForm from "../components/Auth_page_components/RegForm";
import ForgotForm from "../components/Auth_page_components/ForgotForm";
export default {
    name: "Auth",
    components: { SignForm,RegForm,ForgotForm},
    data(){
        return{
            sign_form:true,
            forgot_form:false,
            reg_form:false
        }
    },
}
</script>

<style lang="scss" scoped>
.auth{
    height: 90vh;
    display: flex;
    justify-content: space-around;
    align-items: center;

    &__content{
        box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.44);
        display: flex;
        justify-content: center;
        align-items: center;

        &__cover{
            h1{
                text-align: center;
                margin-top: 100px;
            }
            width: 800px;
            height: 500px;
            color: white;
            background-image: url("../../css/images/auth_content.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            border-bottom: 1px solid black;
        }
        &__container{
            width: 350px;
            height: 500px;
            border-top: 1px solid black;
            color: black;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            nav{
                display: flex;
                justify-content: space-around;
                a{
                    color: gray;
                    font-size: 1rem;
                    font-weight: bold;
                    &:after{
                        content: '';
                        display: block;
                        border-bottom: 2px solid blue;
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
            footer{

                hr{
                    width: 80%;
                }
                div{
                    text-align: center;
                }
            }
        }

    }
    .active{
        &:after{
            content: '';
            display: block;
            border-bottom: 2px solid blue;
            width: 100%;
            -webkit-transition: 0.5s ease;
            transition: 0.5s ease;
        }
    }
}
</style>
