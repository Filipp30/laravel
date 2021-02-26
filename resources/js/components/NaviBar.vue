<template>
    <div class="menubar">
        <h1>Laravel-Vue_Developer</h1>
        <nav>
            <router-link to="/">Home</router-link> |
            <router-link to="/">On-line Shop</router-link>|
            <router-link to="">Blog</router-link>|
            <router-link to="/product-forum">Product-Forum</router-link>|
            <router-link to="/auth">Auth</router-link>|
            <router-link to="/contact">Contact</router-link>
        </nav>
        <button @click="log_out" >log out</button>
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
    //margin: auto;


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
            display: inline-block;
            &:after{
                content: '';
                display: block;
                border-bottom: 2px solid #fafa88;
                width: 0;
                -webkit-transition: 0.5s ease;
                transition: 0.5s ease;
            }
            &:hover:after { width: 100%; }
        }
    }
    button{
        margin-right: 5px;
        height: 50px;
        width: 50px;
        border-radius: 100px;
        background: #99d8e3;
        border: none;
        font-size: 0.7rem;
    }
}

</style>
