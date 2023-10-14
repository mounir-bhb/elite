<template>
    <div>
        <div class="flex">
            <div @click="type='quiz'">Quiz</div>
            <div @click="type==='map'">Map</div>
        </div>
        <h2>Niveau {{ level }}</h2>
        <CreateQuiz v-if="type==='quiz'" parent="test" :level="level"></CreateQuiz>
    </div>
</template>

<script>
import CreateQuiz from './CreateQuiz.vue';

    export default {
    props: ['level'],
    data() {
        return {
            type: 'quiz'
        };
    },
    components: { CreateQuiz }
}
</script>

<style lang="scss" scoped>

</style>