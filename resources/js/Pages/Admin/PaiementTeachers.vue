<template>
    <div class="flex justify-center pt-6">
        <table>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Code RIB</th>
                <th>Montant<br> a payer</th>
                <th>Montant<br> deja payer</th>
                <th></th>
            </tr>
            <tr v-for="(teacher, index) in teachers">
                <td>
                    <img :src="'/storage/'+teacher.photo_url" alt="" class="w-12 rounded-lg">
                </td>
                <td class="text-center">{{ teacher.user.nom }}</td>
                <td class="text-center">{{ teacher.user.prenom }}</td>
                <td class="text-center">{{ teacher.user.email }}</td>
                <td class="text-center">{{ teacher.tel }}</td>
                <td class="text-center">{{ teacher.rib }}</td>
                <td class="text-center">{{ teacher.totalPriceUnpaid }}</td>
                <td class="text-center">{{ teacher.totalPricePaid }}</td>
                <td>
                    <div class="m-2 p-2 rounded-lg bg-red-700 text-lg text-white cursor-pointer transition duration-700 hover:bg-red-600" @click="openPaiement(teacher.id, index, teacher.totalPriceUnpaid)" v-if="teacher.totalPriceUnpaid>0">
                        payer
                    </div>
                </td>
            </tr>
        </table>
        <Modal :show="open_p" @close="open_p=false">
            <form @submit.prevent="submit" class="p-4">
                <div class="flex justify-center mt-4">
                    <NewCcp v-model:value="form.ccp"></NewCcp>
                </div>
                <div class="flex justify-center mt-4">
                    <SubmitButton :class="{ 'opacity-25': form.processing || !form.ccp }" :disabled="form.processing || !form.ccp" type="submit">
                        valider
                    </SubmitButton>
                </div>
            </form>
        </Modal>
    </div>
</template>

<script>
import Modal from '@/Components/Modal.vue';
import NewCcp from '@/Components/NewCcp.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import axios from 'axios';

    export default {
        components: { Modal, NewCcp, SubmitButton },
        props: ['teachers'],
        data() {
            return {
                new_teachers: this.teachers,
                form: this.$inertia.form({
                    teacher: null,
                    montant: null,
                    ccp: null,
                }),
                open_p: false,
                i: null
            };
        },
        methods: {
            openPaiement(teacher, index, montant){
                this.form.teacher= teacher
                this.form.montant= montant
                this.open_p= true
                this.i= index
            },

            submit() {
                this.form.post(route('paiement'),{
                    preserveScroll: true
                })
                this.new_teachers[index].totalPricePaid += this.new_teachers[index].totalPriceUnpaid;
                this.new_teachers[index].totalPriceUnpaid = 0;
                this.teacher= null
                this.montant= null
                this.open_p= false
                this.i= null
                /* try {
                    const response = await axios.put('paiement', { teacher, montant });
                    
                }
                catch (error) {
                    console.log(error);
                } */
            }
        },
    
}
</script>

<style lang="scss" scoped>
    td, th{
        padding: 2px 8px;
        font-size: large;
    }
</style>