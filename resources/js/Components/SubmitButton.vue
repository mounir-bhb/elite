<template>
    <button class="btn shadow-md" as="button">
        <slot/>
    </button>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>
    .btn{
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        background-color: rgb(4, 14, 158);
        color: white;
        font-size: larger;
        font-weight: bold;
        width: fit-content;
        padding: 5px 12px;
        transition-duration: 0.7s;
        cursor: pointer;
    }
    .btn:hover{
        background-color: rgb(0, 132, 255);
        transform: translateY(-2px);
    }
</style>