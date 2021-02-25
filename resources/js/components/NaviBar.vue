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
        <button v-on:click="log_out" >log out</button>
    </div>
</template>

<script>
export default {
    name: "NaviBar",
    methods:{
        log_out(){
            axios.post('/logout').then((response)=>{
                console.log(response.data)
            }).catch((error)=>{
                console.log(error)
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.menubar {
    width: 100%;
    background-color: #1a202c;
    z-index: 1000;
    height: 10vh;
    //margin: auto;
    display: flex;
    justify-content:space-evenly;
    align-items:center;

    h1{
        width: 25%;
        font-size: 25px;
        color: white;
    }
    nav{
        width: 65%;
        display: flex;
        justify-content: space-evenly;
        a{
            text-decoration: none;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            border-bottom-width: 0;
            display: inline-block;
            &:after{
                content: '';
                display: block;
                border-bottom: 2px solid white;
                width: 0;
                -webkit-transition: 0.5s ease;
                transition: 0.5s ease;
            }
            &:hover:after { width: 100%; }
        }
    }
    button{
        margin-right: 5px;
    }
}

</style>
