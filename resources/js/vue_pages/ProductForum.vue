<template>
<h1>Product Forum --- Vue component -- only when authenticated</h1>
</template>

<script>
export default {
    name: "ProductForum",
    mounted() {
        axios.get('/api/user').then((response)=>{
            console.log(response)
        }).catch((error)=>{
            console.log(error);
        })
    }
}
</script>

<style scoped>

</style>
