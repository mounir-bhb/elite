<template>
    <MainLayout>
        <div class=" justify-around mx-20 mt-20">
            <!-- <div class="flex flex-col items-center gap-4 shadow-md">
                <div>Cycle</div>
                <div>Filièrer</div>
                <div>Année</div>
                <div>Matière</div>
            </div> -->
                <div class="flex justify-center gap-4">
                    <div v-for="(l, index) in levels" >
                        <div class="   w-fit  cursor-pointer" 
                                @click="level_selected=l"
                                
                            >
                                Niveau {{ l.niveau }}
                            </div>
                        <!-- {{ levels }} -->
                    </div>
                    <div class="w-fit cursor-pointer" @click="level_selected='new'">
                        Nouveau niveau
                    </div>
                </div>
                <!-- <EditQuiz></EditQuiz> -->
                <div class="flex justify-center">
                    <CreateLevel v-if="level_selected=='new'" :id="test.id" :level="level"></CreateLevel>
                    <!-- <CreateQuiz :id="test.id" parent="test" :level="level" class="" v-if="level_selected=='new'"></CreateQuiz> -->
                    <div v-else v-for="l in levels">
                        <div v-if="l == level_selected">
                            <EditQuizMap :quiz="level_selected" v-if="l.quiz_maps.length"></EditQuizMap>
                            <EditQuiz :quiz="level_selected" v-else></EditQuiz>
                            
                        </div>
                        
                        
                    </div>
                    
                </div>
                
                
            
        </div>
        
    </MainLayout>
    
</template>

<script>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import CreateQuiz from './CreateQuiz.vue';
    import EditQuiz from './EditQuiz.vue';
    import CreateLevel from './CreateLevel.vue';
    import EditQuizMap from './EditQuizMap.vue';

    export default {
        components: { CreateQuiz, MainLayout, EditQuiz, CreateLevel, EditQuizMap },
        props: ['test'],
        data(){
            return {
                levels: this.test.quizzes,
                level: this.test.quizzes.length + 1,
                level_selected: 'new'
            }
        }
    
}
</script>

<style lang="scss" scoped>

</style>