<template>
    <form @submit.prevent="onSignSubmit" class="sign_form">
        <label for="email">E-Mail</label>
        <input type="email" placeholder="email" id="email">
        <label for="password">Password</label>
        <input type="password" placeholder="password" id="password">
        <label for="checkbox"><input type="checkbox" id="checkbox"> Remember me</label>
        <button>sign-in</button>
    </form>

</template>

<script>
export default {
    name: "SignForm",
    methods:{
        onSignSubmit(){

        }
    }
}
</script>

<style lang="scss" scoped>
.sign_form{
    color: black;
    border: 1px solid black;
    width: 300px;
    height: 60%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

}
</style>
