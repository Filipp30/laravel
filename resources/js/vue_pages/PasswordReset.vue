<template>

    <form @submit.prevent="onRegSubmit" class="reg_form" autocomplete="off">
        <div class="reg_form__inputs">
            <label for="email">E-Mail</label>
            <input  type="email" placeholder="email" id="email">
            <label for="password">New Password</label>
            <input   type="password" placeholder="password" id="password">
            <label for="password">Confirm Password</label>
            <input   type="password" placeholder="password" id="password">
        </div>
        <button type="submit" >Save password</button>
    </form>

</template>

<script>
export default {
name: "PasswordReset"
}
</script>

<style lang="scss" scoped>
@mixin  center(){
    display: flex;
    justify-content: center;
    align-items: center;
}
.reg_form{
    margin: auto;
    height: 300px;
    width: 20%;
    padding-top: 200px;

    &__inputs{

        font-size: 15px;
        @include center();
        flex-direction: column;
        margin-bottom: 2rem;
        label{
            margin-right:auto;
            margin-bottom: 1rem;

        }
        input{
            height: 30px;
            width: 100%;
            margin-bottom: 1rem;
        }

    }




}
</style>
