<template>
    <div class="shadow-md p-6">
        <h2 class="text-center mb-4">Niveau {{ level }}</h2>
        <div class="flex justify-around border-b">
            <div @click="type='quiz'" class="text-lg cursor-pointer hover:font-bold">Quiz</div>
            <div @click="type='map'" class="text-lg cursor-pointer hover:font-bold">Map</div>
        </div>
        <CreateQuiz v-if="type==='quiz'" parent="test" :level="level" :id="id"></CreateQuiz>
        <CreateQuizMap v-else-if="type==='map'" :level="level" :id="id"></CreateQuizMap>
    </div>
</template>

<script>
import CreateQuiz from './CreateQuiz.vue';
import CreateQuizMap from './CreateQuizMap.vue';

    export default {
    props: ['level', 'id'],
    data() {
        return {
            type: 'quiz'
        };
    },
    components: { CreateQuiz, CreateQuizMap }
}
</script>

<style lang="scss" scoped>

</style>