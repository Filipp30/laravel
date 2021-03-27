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
@import "./resources/css/content_colors";
.auth{
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;

    &__content{
        box-shadow: 0px 1px 18px -3px rgba(0,0,0,0.75);
        display: flex;
        width: 1000px;

        &__cover{
            flex: 1;
            min-width: 250px;
            max-width: 800px;
            height: 500px;
            color: white;
            background-image: url("../../css/images/auth_content_3.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            h1{
                text-align: center;
                margin-top: 50px;
                color: gray;
            }
        }
        &__container{
            width: 350px;
            height: 500px;
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
                        border-bottom: 2px solid $lines_color;
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
            border-bottom: 2px solid $lines_color;
            width: 100%;
            -webkit-transition: 0.5s ease;
            transition: 0.5s ease;
        }
    }
}

@media screen and (max-width:600px){
    .auth{

        &__content{

            &__cover{
                display: none;
            }
            &__container{
                margin: auto;
                nav{

                }
                footer{

                }
            }

        }

    }
}
</style>
