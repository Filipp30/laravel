<template>
    <div class="menubar">
        <h1>Laravel-Vue_Developer</h1>
        <nav>
            <router-link to="/" exact>Home</router-link> |
            <router-link to="/shop" exact>On-line Shop</router-link>|
            <router-link to="/blog" exact>Blog</router-link>|
            <router-link to="/product-forum" exact>Product-Forum</router-link>|
            <router-link to="/auth" exact>Auth</router-link>|
            <router-link to="/contact" exact>Contact</router-link>
        </nav>
        <button @click="log_out" >Logout</button>
    </div>
</template>

<script>
export default {
    name: "NaviBar",
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
@mixin  center(){
    display: flex;
    justify-content: center;
    align-items: center;
}
.menubar {
    @include center();
    justify-content: space-evenly;
    width: 100%;
    z-index: 1000;
    height: 10vh;


    h1{
        width: 25%;
        font-size: 25px;
        color: gray;
    }
    nav{
        width: 65%;
        @include center();
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
                border-bottom: 2px solid blue;
                width: 0;
                -webkit-transition: 0.5s ease;
                transition: 0.5s ease;
            }
            &:hover:after { width: 100%; }
        }
    }
    button{
        border:none;
        outline: none;
        width: 80px;
        border-radius: 2px;
        background-color:gray;
        color:white;
        font-size: 20px;
    }
    button:hover{
        cursor: pointer;
        background-color: transparent;
        border-radius: 2px;
        border: 1px solid black;
        color: black;
    }
    .router-link-active{
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
