<template>
    <div>
        <form @submit.prevent="submit" class="shadow-md p-4">
            <div class="flex justify-center gap-2">
                <h2 class="text-center">Cycles</h2>
                <div @click="addCycle" class="flex items-end font-bold text-xl cursor-pointer">+</div>
            </div>
            <div class="divide-y">
                <div v-for="(cycle, index) in form.old_cycles" :key="index" class="relative p-4">
                    <!-- <div v-if="index > 0" @click="delCycle(index) && !cycle.id" class="absolute top-4 right-4 text-lg cursor-pointer">X</div> -->
                    <!-- <div @click="delCycle" v-if="index > 0">Supprimer cycle</div> -->
                    <InputLabel>Nom</InputLabel>
                    <TextInput v-model="cycle.nom" type="text" required></TextInput>
                    <div class="flex gap-8">
                        <!-- Filieres -->
                        <div>
                            <div class="flex justify-center gap-2 pt-6">
                                <h3 class="text-center">Filières</h3>
                                <div @click="addOldFiliere(index)" class="flex items-end font-bold text-xl cursor-pointer">
                                    +
                                </div>
                            </div>
                            
                            <div v-for="(filiere, findex) in cycle.filieres" :key="findex">
                                
                                <div class="flex gap-2">
                                    
                                    <div class="mt-3">
                                        <InputLabel>Nom</InputLabel>
                                        <div class="flex gap-2 items-center">
                                            <TextInput v-model="filiere.nom" type="text"></TextInput>
                                            <div @click="delOldFiliere(index, findex)" v-if="findex > 0 && !filiere.id" class="text-2xl text-red-600 cursor-pointer">
                                                x
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Années -->
                        <div>
                            <div class="flex justify-center gap-2 pt-6">
                                <h3 class="text-center">Années</h3>
                                <div @click="addOldAnnee(index)" class="flex items-end font-bold text-xl cursor-pointer">
                                    +
                                </div>
                            </div>
                            
                            <div v-for="(annee, aindex) in cycle.annees" :key="aindex">
                                <div class="flex gap-2">
                                    
                                    <div class="mt-3">
                                        <InputLabel>Nom</InputLabel>
                                        <div class="flex gap-2 items-center">
                                            <TextInput v-model="annee.nom" type="text"></TextInput>
                                            <div @click="delOldAnnee(index, aindex)" v-if="aindex > 0" class="text-2xl text-red-600 cursor-pointer">
                                                x
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div v-for="(cycle, index) in form.cycles" :key="index" class="relative p-4">
                    <div v-if="index > 0" @click="delCycle(index)" class="absolute top-4 right-4 text-lg cursor-pointer">X</div>
                    <!-- <div @click="delCycle" v-if="index > 0">Supprimer cycle</div> -->
                    <InputLabel>Nom</InputLabel>
                    <TextInput v-model="cycle.nom" type="text" required></TextInput>
                    <div class="flex gap-8">
                        <!-- Filieres -->
                        <div>
                            <div class="flex justify-center gap-2 pt-6">
                                <h3 class="text-center">Filières</h3>
                                <div @click="addFiliere(index)" class="flex items-end font-bold text-xl cursor-pointer">
                                    +
                                </div>
                            </div>
                            
                            <div v-for="(filiere, findex) in cycle.filieres" :key="findex">
                                
                                <div class="flex gap-2">
                                    
                                    <div class="mt-3">
                                        <InputLabel>Nom</InputLabel>
                                        <div class="flex gap-2 items-center">
                                            <TextInput v-model="filiere.nom" type="text"></TextInput>
                                            <div @click="delFiliere(index, findex)" v-if="findex > 0" class="text-2xl text-red-600 cursor-pointer">
                                                x
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Années -->
                        <div>
                            <div class="flex justify-center gap-2 pt-6">
                                <h3 class="text-center">Années</h3>
                                <div @click="addAnnee(index)" class="flex items-end font-bold text-xl cursor-pointer">
                                    +
                                </div>
                            </div>
                            
                            <div v-for="(annee, aindex) in cycle.annees" :key="aindex">
                                <div class="flex gap-2">
                                    
                                    <div class="mt-3">
                                        <InputLabel>Nom</InputLabel>
                                        <div class="flex gap-2 items-center">
                                            <TextInput v-model="annee.nom" type="text"></TextInput>
                                            <div @click="delAnnee(index, aindex)" v-if="aindex > 0" class="text-2xl text-red-600 cursor-pointer">
                                                x
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            

            <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Enregistrer
                </SubmitButton>
            </div>
            
        </form>
    </div>
</template>

<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import SubmitButton from '@/Components/SubmitButton.vue';
    export default {
        components:{TextInput, InputLabel, SubmitButton},
        props: ['cycles'],
        data(){
            return {
                form: this.$inertia.form({
                    old_cycles: this.cycles,
                    cycles: [{
                        nom: '',
                        filieres: [{
                            nom: ''
                        }],
                        annees: [{
                            nom: ''
                        }] 
                    }]
                    
                })
            }
        },
        methods:{

            addCycle(){
                this.form.cycles.push({
                    nom: '',
                    filieres: [{
                        nom: ''
                    }],
                    annees: [{
                        nom: ''
                    }] 
                })
            },
            delCycle(index){
                if(this.form.cycles.length > 1)
                    this.form.cycles.splice(index, 1)
            },
            addFiliere(index){
                this.form.cycles[index].filieres.push({nom: ''})
            },
            addOldFiliere(index){
                this.form.old_cycles[index].filieres.push({nom: ''})
            },
            delFiliere(index, findex){
                if(this.form.cycles[index].filieres.length > 1)
                    this.form.cycles[index].filieres.splice(findex,1)
            },
            delOldFiliere(index, findex){
                if(this.form.old_cycles[index].filieres.length > 1)
                    this.form.old_cycles[index].filieres.splice(findex,1)
            },
            addAnnee(index){
                this.form.cycles[index].annees.push({nom: ''})
            },
            addOldAnnee(index){
                this.form.old_cycles[index].annees.push({nom: ''})
            },
            delAnnee(index, aindex){
                if(this.form.cycles[index].annees.length > 1)
                    this.form.cycles[index].annees.splice(aindex,1)
            },
            delOldAnnee(index, aindex){
                if(this.form.old_cycles[index].annees.length > 1)
                    this.form.old_cycles[index].annees.splice(aindex,1)
            },

            submit(){
                this.form.post(route('cycle.store'),{
                    preserveScroll: true, 
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>