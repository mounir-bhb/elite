<template>
    <div>
        <div class="back-progress bg-[#eee]">
            <div class="progress" :style="{backgroundColor: progress}"></div>
            
        </div>
    </div>
</template>

<script>
    export default {
        props: ['progress'],
        data(){
            return {
                prog: this.progress+ '%'
            }
        },
        
    }
</script>

<style lang="scss" scoped>
    .back-progress{
        position: relative;
        height: 20px;
        width: 500px;
    }
    .progress{
        position: absolute;
        height: 100%;
        width: v-bind(prog);
        background: #eab308;
        transition-duration: 0.7;
    }
</style>