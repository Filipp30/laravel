<template>
<section class="auth">
    <div class="auth__container">

        <div class="auth__container__title">
            <h1>Company Name</h1>
        </div>

        <div class="auth__container__form">
            <nav>
                <a v-on:click="sign_form_show = true" class="sign">Sign-in</a>
                <a v-on:click="sign_form_show = false" class="reg">Registration</a>
            </nav>

            <article>
                <SignForm v-if="sign_form_show" />
                <RegForm v-else/>
            </article>

            <footer>
                <h3>footer</h3>
            </footer>
        </div>


    </div>


</section>
</template>

<script>
import SignForm from "../components/SignForm";
import RegForm from "../components/RegForm";
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
    justify-content: space-evenly;
    width: 100%;
    margin: auto;
    background-image: url('../../css/images/auth-page-background.jpg');
    background-size:cover;
    background-position: center;
    background-repeat: no-repeat;

    &__container{
        width: 90%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        &__title{
            color: white;
            width: 350px;
            height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        &__form{
            background-color:white ;
            width: 350px;
            height: 500px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;

            nav{
                width:300px ;
                font-size: 25px;
                color: black;
                display: flex;
                justify-content: space-between;
                margin-top: 5px;

                .sign{
                    text-decoration: none;
                    color: black;
                    font-size: 1.5rem;
                    font-weight: bold;
                    border-bottom-width: 0;
                    display: inline-block;
                    &:after{
                        content: '';
                        display: block;
                        border-bottom: 2px solid black;
                        width: 0;
                        -webkit-transition: 0.5s ease;
                        transition: 0.5s ease;
                    }
                    &:hover:after { width: 100%; }
                }
                .reg{
                    text-decoration: none;
                    color: black;
                    font-size: 1.5rem;
                    font-weight: bold;
                    border-bottom-width: 0;
                    display: inline-block;
                    &:after{
                        content: '';
                        display: block;
                        border-bottom: 2px solid black;
                        width: 0;
                        -webkit-transition: 0.5s ease;
                        transition: 0.5s ease;
                    }
                    &:hover:after {
                        width: 100%;

                    }
                }


            }
            article{
                height: 400px;
                width: 300px;
            }



        }
    }



}
</style>
