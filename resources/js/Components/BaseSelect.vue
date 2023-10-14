<template>
    <select @input="$emit('update:value', $event.target.value)" :value="value">
        <option value="" disabled >-- {{ placeholder }} --</option>
        <option v-for="(option, index) in options" :key="index" :value="option">{{ option }}</option>
    </select>
</template>

<script>
    export default {
        props:['options','placeholder','value','opt'],
        emits:['update:value'],
        methods:{
            /* newOption(e){
                this.$emit('update:value', e.target.value)
                console.log(e.target.value);
            } */
        }
    }
</script>

<style lang="scss" scoped>
    select{
        border-color: #d1d5db;
        border-radius: 6px;
    }
    select:focus {
        border-color: rgb(99 102 241);
    }

</style>