<template>
    <div class="menubar">

        <h1 class="menubar__title">Laravel-Vue_Developer</h1>
        <section class="menubar__nav">
            <nav class="nav__links">
                <router-link to="/" exact>Home</router-link> |
                <router-link to="/shop" exact>On-line Shop</router-link>|
                <router-link to="/blog" exact>Blog</router-link>|
                <router-link to="/product-forum" exact>Product-Forum</router-link>|
                <router-link to="/auth" exact>Auth</router-link>|
                <router-link to="/contact" exact>Contact</router-link>
            </nav>
            <div class="nav__adoptive">
                <HamburgerMenu/>
            </div>
            <div class="nav__logout">
                <button @click="log_out" >Logout</button>
            </div>
        </section>
    </div>
</template>

<script>
import HamburgerMenu from "./HamburgerMenu";


export default {
    name: "NaviBar",
    components:{
        HamburgerMenu
    },
    methods:{
        log_out(){
            axios.post('/api/logout').then((response)=>{
                console.log(response.data)
                this.$router.push({name: 'Auth'});
            }).catch((error)=>{
                console.log(error)
            })
        }
    }
}
</script>

<style lang="scss" scoped>
@import "./resources/css/content_colors";
.menubar{
    display: flex;
    align-items: center;
    justify-content: space-between;
    &__title{
        width: 300px;
        white-space: nowrap;
        font-size: 25px;
        color: gray;
        text-align: center;
    }
    &__nav{
        width:100%;
        display:flex;
        justify-content: space-between;
        .nav__links{
            flex: 1;
            min-width:500px;
            max-width:800px;
            margin: auto;
            display: flex;
            justify-content: space-evenly;
            a{
                text-decoration: none;
                color: gray;
                font-size: 1rem;
                font-weight: bold;
                border-bottom-width: 0;
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
            .router-link-active{
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
        .nav__adoptive{
            display: none;
            width: 50px;
            height: 30px;
        }
        .nav__logout{

            button{
                border:1px solid gray;
                outline: none;
                width: 80px;
                height: 20px;
                border-radius: 2px;
                background-color:gray;
                color:white;
                font-size: 15px;

            }
            button:hover{
                cursor: pointer;
                background-color: transparent;
                border-radius: 2px;

                border:1px solid black;
                color: black;

            }
        }
    }

}

@media screen and (max-width:900px){

    .menubar{
        flex-direction: column;
        justify-content:center;

        .menubar__nav{
            .nav__links{
                display: none;
            }
            .nav__adoptive{
                display: block;
            }
        }
    }
}
</style>
