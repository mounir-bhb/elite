<template>
    <div class="progress bg-white rounded-full">
        <div class="outer">
            <div class="inner">
                <div id="number" >
                    {{ progression }} %
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
            <defs>
                <linearGradient id="GradientColor">
                    <stop offset="0%" stop-color="rgb(4, 14, 158)" />
                    <stop offset="100%" stop-color="rgb(0, 132, 255)" />
                </linearGradient>
            </defs>
            <circle 
                :stroke-dasharray="circumference"
                :stroke-dashoffset="dashOffset"
                :r="radius"
                cx="50%"
                cy="50%" 
                stroke-linecap="round" />
        </svg>
    </div>
</template>

<script>
    export default {
        props:['progression'],
        data(){
            return {
                /* progression:70, */
                progress: 0,
                radius: 70,
                /* circumference: 2 * Math.PI * 50, */
                circumference: 450,
                duration: 200, // in milliseconds
                intervalId: null
            }
        },
        computed: {
            dashOffset() {
                return this.circumference * (1 - this.progress / 100);
            }
        },
        mounted() {
            this.intervalId = setInterval(() => {
                if (this.progress < this.progression) {
                    this.progress += 1;
                } else {
                    clearInterval(this.intervalId);
                }
            }, this.duration / 10);
        },
        watch:{
            progression(newValue){
                this.intervalId = setInterval(() => {
                    if (this.progress < this.progression) {
                        this.progress += 1;
                    } else {
                        clearInterval(this.intervalId);
                    }
                }, this.duration / 10);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .progress{
        width: 160px;
        height: 160px;
        position: relative;
    }
    .outer{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        box-shadow: 6px 6px 10px -1px rgba(0, 0, 0, 0.15),
                    -6px -6px 10px -1px rgba(225, 225, 225, 0.7);
    }
    .inner{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
                    inset -4px -4px 6px -1px rgba(225, 225, 225, 0.7),
                    -0.5px -0.5px 0px rgba(225, 225, 225, 1),
                    -0.5px -0.5px 0px rgba(0, 0, 0, 0.15),
                    0px 12px 10px -10px rgba(0, 0, 0, 0.05);
    }
    #number{
        font-weight: 1000;
        color: #555;
    }
    circle{
        fill: none;
        stroke: url(#GradientColor);
        stroke-width: 20px;
    }
    svg{
        position: absolute;
        top: 0;
        left: 0;
    }
    
</style>