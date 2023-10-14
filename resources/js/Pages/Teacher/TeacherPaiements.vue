<template>
    <div>
        <div class="flex justify-center mx-20"
                data-aos="fade-right"
                data-aos-offset="0"
                data-aos-delay="500"
                data-aos-duration="700"
                data-aos-easing="ease-in-out"
                data-aos-mirror="false"
                data-aos-once="false"
            >
                <div class="p-2 shadow-md rounded-lg  w-fit">
                    <div class="text-lg">Nombre d'inscriptions: {{ nombre_inscri }}</div>
                    <div class="text-lg">Montant reçu: {{ totalPricePaid }} DA</div>
                    <div class="text-lg">Le reste: {{ totalPriceUnpaid }} DA</div>
                </div>
            </div>
        <div class="flex justify-center pt-6">
            
            <table>
                <tr>
                    <th></th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
                <tr v-for="(paiement, index) in paiements" @click="open_ccp(index)">
                    <td>
                        <img :src="'/storage/'+paiement.ccps[0].image_url" alt="" class="w-12">
                    </td>
                    <td>{{ paiement.montant }} DA</td>
                    <td>{{ getDate(paiement.created_at) }}</td>
                    <td>{{ getTime(paiement.created_at) }}</td>
                </tr>
            </table>
            <Modal :show="is_open" @close="is_open=false">
                <img :src="image_ccp" alt="">
            </Modal>
        </div>
    </div>
    
</template>

<script>
import Modal from '@/Components/Modal.vue';

    export default {
    props: ['paiements', 'nombre_inscri', 'totalPriceUnpaid', 'totalPricePaid'],
    data(){
        return {
            is_open: false,
            image_ccp: null
        }
    },
    methods: {
        getDate(dateTimeString) {
            const dateObject = new Date(dateTimeString);
            return dateObject.toISOString().slice(0, 10);
        },
        getTime(dateTimeString) {
            const dateObject = new Date(dateTimeString);
            const hours = dateObject.getUTCHours().toString().padStart(2, "0");
            const minutes = dateObject.getUTCMinutes().toString().padStart(2, "0");
            return `${hours}:${minutes}`;
            //return dateObject.toISOString().slice(11, 19);
        },
        open_ccp(index){
            this.image_ccp='/storage/'+this.paiements[index].ccps[0].image_url
            this.is_open= true
        }
    },
    components: { Modal }
}
</script>

<style lang="scss" scoped>
    td, th{
        padding: 2px 8px;
        font-size: large;
    }
</style>