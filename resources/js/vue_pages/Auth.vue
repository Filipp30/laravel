<template>
    <section class="auth">

        <div class="auth__title">
        <h1>Company Name</h1>
    </div>
        <div class="auth__container">



            <div class="auth__container__form">
                <nav>
                    <a v-on:click="sign_form_show = true" class="sign">Log-in</a>
                    <a v-on:click="sign_form_show = false" class="reg">Registration</a>
                </nav>

                <article>
                    <SignForm v-if="sign_form_show" />
                    <RegForm v-else/>
                </article>

<!--                <footer>-->
<!--                    <h3>footer</h3>-->
<!--                </footer>-->

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
@mixin  center(){
    display: flex;
    justify-content: center;
align-items: center;
}
.auth{
    height: 90vh;
   @include center();
    justify-content: space-evenly;
    width: 100%;

    margin: auto;
    background-image: url('../../css/images/photo_2021-02-26_16-00-55.jpg');
    background-position: center;
    background-size: contain;
    &__title{
        color: black;
        margin: auto;
        @include center();

    }
    &__container{
        background: rgb(150, 174, 233);
        padding: 2rem 0;
        width: 20%;
        margin: auto;
        @include center();
        justify-content: space-evenly;

        &__form{
            background-color:transparent ;
            border-radius: 5px;
            height: 400px;

            nav{
                width:100%;
                font-size: 1.5rem;
                color: black;
                @include center();
                justify-content: space-between;
                text-align: left;
                margin-bottom: 2rem;

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

                width: 280px;
                height:100%;

            }
        }
    }



}
</style>
