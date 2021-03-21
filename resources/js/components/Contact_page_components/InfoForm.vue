<template>
    <div class="info">
        <h1 class="info__title">
            About us
        </h1>
        <div class="info__content">
            <h5>Content</h5>
        </div>
    </div>

</template>

<script>
export default {
    name: "InfoForm"
}
</script>

<style lang="scss" scoped>
@import "./resources/css/content_colors";
.info{
    width: 600px;
    &__title{
        background-color: $lines_color;
        padding: 5px;
    }




}

</style>
