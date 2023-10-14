<template>
    <div class="flex justify-center pt-6 mx-10">
        <table>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Formation</th>
                <th>Pris</th>
                <th>durée</th>
            </tr>
            <tr v-for="(new_inscription, index) in new_inscriptions" @click="openValidation(new_inscription, index)">
                <td>
                    <img :src="'/storage/'+new_inscription.student.photo_url" alt="" class="w-12 rounded-lg">
                </td>
                <td>{{ new_inscription.student.user.nom }}</td>
                <td>{{ new_inscription.student.user.prenom }}</td>
                <td>{{ new_inscription.student.user.email }}</td>
                <td>{{ new_inscription.student.tel }}</td>
                <td>{{ new_inscription.formation.title }}</td>
                <td>{{ new_inscription.price.price }}</td>
                <td>{{ new_inscription.price.type }}</td>
            </tr>
        </table>
        <Modal :show="is_open" @close="is_open=false">
            
            <form @submit.prevent="submit" class="flex flex-col items-center justify-center p-4">
                <img :src="'/storage/'+form.inscription.ccps[len_ccps-1].image_url" alt="" class="mb-2">
                <textarea name="" id="" cols="30" rows="5" placeholder="dites pourquoi l'abonnement est refusé" v-model="form.wrong_msg"></textarea>
                <div class="flex justify-center mt-4">
                    <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" v-if="!form.wrong_msg">
                        Valider
                    </SubmitButton>
                    <button class="m-2 p-2 rounded-lg bg-red-700 text-lg text-white cursor-pointer transition duration-700 hover:bg-red-600"
                        :class="{ 'opacity-25': form.processing }" 
                        :disabled="form.processing" 
                        type="submit" 
                        v-else-if="form.wrong_msg"
                    >
                        Refuser
                    </button>
                </div>
            </form>
            <!-- <form @submit.prevent="refuser" class="flex flex-col items-center justify-center p-4">
                <textarea name="" id="" cols="30" rows="10"></textarea>
                <div class="flex justify-center mt-4">
                    <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                        Refuser
                    </SubmitButton>
                </div>
            </form> -->
        </Modal>
    </div>
</template>

<script>
    import Modal from '@/Components/Modal.vue'
    import SubmitButton from '@/Components/SubmitButton.vue';
    export default {
        components: { Modal, SubmitButton },
        props:['inscriptions'],
        data(){
            return{
                new_inscriptions: this.inscriptions,
                inscription: null,
                is_open:false,
                len_ccps:null,
                index: null,
                form: this.$inertia.form({
                    inscription: null,
                    wrong_msg: null
                })
            }
        },
        methods: {
            openValidation(inscription, index){
                this.form.inscription=inscription

                this.len_ccps=inscription.ccps.length
                this.is_open=true
                this.index= index
            },
            submit(){
                if(this.form.wrong_msg){
                    this.form.post(route('inscription.refus'), {
                        preserveScroll: true
                    })
                }
                else {
                    this.form.post(route('inscription.validation'), {
                        preserveScroll: true
                    })
                }
                
                this.is_open= false
                this.new_inscriptions.splice(this.index,1)
            }
        }
    }
</script>

<style lang="scss" scoped>
    td, th{
        padding: 2px;
        font-size: large;
        text-align: center;
    }
    td{
        cursor: pointer;
    }
</style>