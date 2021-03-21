<template>
    <div class="navigation">
        <div
            class="hamburger"
            @click="activate()">
            <div></div>
            <div></div>
            <div></div>
        </div>


        <transition name="fade" >
            <div  v-if="side_nav" class="sidenav" v-on:click="activate()">
                <router-link to="/" exact >Home</router-link>
                <router-link to="/shop" exact>On-line Shop</router-link>
                <router-link to="/blog" exact>Blog</router-link>
                <router-link to="/product-forum" exact>Product-Forum</router-link>
                <router-link to="/auth" exact>Auth</router-link>
                <router-link to="/contact" exact>Contact</router-link>
            </div>
        </transition>
    </div>
</template>


<script>
export default {
    name: "Hamburger_menu",
    data() {
        return {
            side_nav:false
        };
    },
    methods: {
        activate(){
            this.side_nav = !this.side_nav;
        }
    },
};
</script>

<style lang="scss" scoped>
@import "./resources/css/content_colors";
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to{
    opacity: 0;
}


.sidenav {
    z-index: 9999;
    position:relative;
    background-color:rgba(128, 128, 128, 0.95);
    box-shadow: 0px 1px 18px -3px rgba(0,0,0,0.75);
    height: 50vh;
    width: 90vw;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;

    a{

        text-decoration: none;
        color: white;
        font-size: 25px;
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

}


.hamburger {
    cursor: pointer;
    height: 50px;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    div {
        width: 35px;
        height: 5px;
        &:nth-child(1) {
            background: $lines_color;
        }
        &:nth-child(2) {
            background: $lines_color;
        }
        &:nth-child(3) {
            background: $lines_color;
        }
    }
}
.hide {
    display: none;
    transition: 0.7s;
}
</style>
