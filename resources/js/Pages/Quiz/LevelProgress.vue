<template>
    <div>
        <div class="flex divide-x w-full bg-slate-100 rounded-xl shadow-xl relative " >
            <div class="absolute top-0 left-0 w-full h-full">
                <div class=" rounded-xl overflow-hidden w-full relative h-full">
                    <div class="progress-color" :style="{'width': progression+'%'}">
                    </div>
                    
                </div>
            </div>
            
            
            <div v-for="i in len" :style="{'width': width+'%'}" class="z-10 h-5 relative" @click="toLevel(i)"
                    :class="[i<= this.submitted_len+1? 'cursor-pointer': '']"
                >
                   <!--  {{ i }} -->
                    <!-- <div class="current" v-if="i==current">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24"><path d="M12 8L18 14H6L12 8Z"></path></svg>
                    </div> -->
                    <div class="current" v-if="i==current">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24"><path d="M12 16L6 10H18L12 16Z"></path></svg>

                    </div>
                </div>
            
        </div>
        
    </div>
</template>

<script>
    export default {
        props:['len', 'submitted_len', 'current'],
        data(){
            return {
                width: 100/this.len,
                progress: (this.submitted_len*100)/this.len,
                //current_prog: (this.current*100)/(2*this.len)
                progression: 0,
                duration: 200, // in milliseconds
                intervalId: null
            }
        },
        mounted(){
            //this.progress=(this.submitted_len*100)/this.len
            this.intervalId = setInterval(() => {
                if (this.progression < this.progress) {
                    this.progression += 1;
                } else {
                    clearInterval(this.intervalId);
                }
            }, this.duration / 10);
        },
        watch:{
            progress(newValue){
                this.intervalId = setInterval(() => {
                if (this.progression < this.progress) {
                    this.progression += 1;
                } else {
                    clearInterval(this.intervalId);
                }
                }, this.duration / 10);
            },
            submitted_len(newValue){
                this.progress= (this.submitted_len*100)/this.len
            }
        },
        methods: {
            toLevel(i){
                
                if(i<= this.submitted_len+1){
                    this.current_prog= (i*100)/(this.len)
                    //console.log(i);
                    this.$emit('level',i)
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .progress-color{
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        background-color: blue;
    }
    /* .current{
        position: absolute;
        top: 70%;
        left: 50%;
        //z-index: 30;
        transform: translateX(-50%);
    } */
    .current{
        position: absolute;
        bottom: 70%;
        left: 50%;
        //z-index: 30;
        transform: translateX(-50%);
    }
</style>