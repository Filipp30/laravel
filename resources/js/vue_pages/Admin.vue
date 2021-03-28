<template>

    <div>
        <h1>Admin</h1>
        <nav>
            <button v-on:click="chat = !chat;">Chat</button>
            <button v-on:click="product_items = !product_items;">Product-Items</button>
        </nav>
        <section>
            <Chat v-if="chat"/>
            <Product_Items v-if="product_items"/>
        </section>
    </div>

</template>

<script>
import Chat from "../components/Admin_page_components/Chat";
import Product_Items from "../components/Admin_page_components/Product_Items";
export default {
    name: "Admin",
    components:{Chat,Product_Items},
    data(){
        return{
            chat:true,
            product_items:false
        }
    },



}
</script>

<style scoped>

</style>
