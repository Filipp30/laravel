<template>
    <section class="auth">

        <div class="auth__content">
            <div class="auth__content__title">
                <h1>Laravel -Vue_Developer</h1>

            </div>

            <div class="auth__content__container">

                <nav>
                    <a v-on:click="sign_form_show = true" class="sign">Log-in</a>
                    <a v-on:click="sign_form_show = false" class="reg">Create Account</a>
                </nav>

                <section class="auth__content__form">
                    <SignForm v-if="sign_form_show" />
                    <RegForm v-else/>
                </section>
                <footer>
                    <hr>
                    <div>
                        © 2021 Laravel -Vue_Developer.
                    </div>
                </footer>
            </div>



        </div>

    </section>
</template>

<script>
import SignForm from "../components/Auth_page_components/LoginForm";
import RegForm from "../components/Auth_page_components/RegForm";
export default {
    name: "Auth",
    components: {RegForm, SignForm},
    data(){
        return{
            sign_form_show:true
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

        &__title{
            h1{
                text-align: center;
                margin-top: 100px;
            }
            width: 700px;
            height: 500px;
            color: white;
            background-image: url("../../css/images/auth_content.jpg");
            background-position: center;
            background-size: cover;

            background-repeat: no-repeat;
        }
        &__container{
            width: 400px;
            height: 500px;
            //border: 2px solid black;
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
                        border-bottom: 3px solid blue;
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




}
</style>
