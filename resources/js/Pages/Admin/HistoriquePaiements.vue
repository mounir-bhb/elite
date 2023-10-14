<template>
    <div class="flex justify-center pt-6">
        <table>
            <tr>
                <th></th>
                <th>Enseignant</th>
                <th>Email</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Heure</th>
            </tr>
            <tr v-for="(paiement, index) in paiements">
                <td>
                    <img :src="'/storage/'+paiement.teacher.photo_url" alt="" class="w-12 rounded-lg">
                </td>
                <td>{{ paiement.teacher.user.nom }} {{ paiement.teacher.user.prenom }}</td>
                <td>{{ paiement.teacher.user.email }}</td>
                <td>{{ paiement.montant }} DA</td>
                <td>{{ getDate(paiement.created_at) }}</td>
                <td>{{ getTime(paiement.created_at) }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['paiements'],
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
        }
    }
</script>

<style lang="scss" scoped>
    td, th{
        padding: 2px 8px;
        font-size: large;
    }
</style>