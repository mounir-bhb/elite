<template>
    <MainLayout>
        <div class="mt-20">
            <div class="flex justify-center my-5">
                <div class="types">
                    <div @click="changeType('active')" class="type" :class="{'bg-orange-300' : (type=='active')}"
                        data-aos="fade-right"
                        data-aos-offset="0"
                        data-aos-delay="500"
                        data-aos-duration="700"
                        data-aos-easing="ease-in-out"
                        data-aos-mirror="false"
                        data-aos-once="false"
                    >Formations actives</div>
                    <div @click="changeType('inactive')" class="type" :class="{'bg-orange-300' : (type=='inactive')}"
                        data-aos="fade-down"
                        data-aos-offset="0"
                        data-aos-delay="500"
                        data-aos-duration="700"
                        data-aos-easing="ease-in-out"
                        data-aos-mirror="false"
                        data-aos-once="false"
                    >Formations inactives</div>
                    <div @click="changeType('paiement')" class="type" :class="{'bg-orange-300' : (type=='paiement')}"
                        data-aos="fade-left"
                        data-aos-offset="0"
                        data-aos-delay="500"
                        data-aos-duration="700"
                        data-aos-easing="ease-in-out"
                        data-aos-mirror="false"
                        data-aos-once="false"
                    >Paiements</div>
                </div>
            </div>
            
            <div class="formations flex flex-wrap gap-8 mx-20 mb-10" v-if="type=='active'">
                <div v-for="formation in formations">
                    <CardTeacherFormation :formation="formation"></CardTeacherFormation>
                </div>
            </div>
            <div class="formations flex flex-wrap gap-8 mx-20 mb-10" v-else-if="type=='inactive'">
                <div v-for="formation in invalid_formations">
                    <FormationCard :formation="formation"></FormationCard>
                </div>
            </div>
            <div v-else-if="type=='paiement'" class="mb-10">
                <TeacherPaiements :paiements="paiements" :nombre_inscri="nombre_inscri" :total-price-paid="totalPricePaid" :total-price-unpaid="totalPriceUnpaid"/>
            </div>
        </div>

        
    </MainLayout>
    
</template>

<script>
    import CardTeacherFormation from '../Formation/CardTeacherFormation.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    import FormationCard from '../Formation/FormationCard.vue';
import TeacherPaiements from './TeacherPaiements.vue';
    export default {
        components: { CardTeacherFormation, MainLayout, FormationCard, TeacherPaiements },
        props: ['formations', 'nombre_inscri', 'totalPriceUnpaid', 'totalPricePaid', 'invalid_formations', 'paiements'],
        data(){
            return {
                type: 'active'
            }
        },
        methods: {
            changeType(type){
                this.type= type
            }
        }
    
    }
</script>

<style lang="scss" scoped>
    
    .types{
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 20px;
        background: #fff;
        width: fit-content;
        overflow: hidden;
    }
    .type{
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: large;
        font-weight: bold;
        cursor: pointer;
        transition: all;
        transition-duration: 0.7s;
    }
    .type:hover{
        background-color: beige;
    }
</style>