<template>
    <div class="m-8 p-4 sm:p-8 bg-white shadow rounded-lg">
        <h2 class="text-center pb-6 text-lg font-medium text-gray-900">Modifier information enseignant</h2>
        <form @submit.prevent="submit">
            <div class="form">
                <div class="avatar-input">
                    <!--  -->
                    <!-- <input type="file" name="" id="" ref="profil"> -->
                    <Avatar v-model:value="form.photo_url" :image="image"></Avatar>
                    <InputLabel for="">Photo de profil</InputLabel>
                </div>
                <div class="inputs">
                    <div class="input mt-4">
                        <InputLabel for="date_naissance">Date de naissance</InputLabel>
                        <TextInput type="date" v-model="form.date_naissance"/>
                    </div>
                    <div class="mt-3">
                        <InputLabel for="sex">Sex</InputLabel>
                        <base-select :options="options" placeholder="select" v-model:value="form.sex" @change="changeImg"></base-select>
                    </div>
                    <div class="mt-3">
                        <InputLabel for="tlf" value="Numero de téléphone" />
                    
                        <TextInput
                            id="tlf"
                            type="tel"
                            class="mt-1 block "
                            v-model="form.tel"
                            required
                            autofocus
                            autocomplete="tlf"
                        />
                    
                        <InputError class="mt-2" :message="form.errors.tel" />
                    </div>
                    
                    
                </div>
                <div>
                    <InputLabel>RIB edahabiya</InputLabel>
                    <TextInput type="text" v-model="form.rib" placeholder="xxxx xxxx xxxx xxxx"></TextInput>
                </div>
                <div class="mt-3">
                    <div class="mt-3">
                        <InputLabel for="">A propos de vous</InputLabel>
                        <textarea cols="30" rows="10" v-model="form.description"></textarea>
                    </div>
                </div>
            </div>
            <div class="flex justify-center pt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    save
                </SubmitButton>
            </div>
            
        </form>
    </div>
</template>

<script>
import TextInput from '@/Components/TextInput.vue';
import Avatar from '@/Components/Avatar.vue';
import BaseSelect from '@/Components/BaseSelect.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
    export default {
    components: { TextInput, Avatar, BaseSelect, SubmitButton, InputLabel, InputError },
    props:['teacher'],
    data() {
        return {
            form: this.$inertia.form({
                _method: 'put',
                date_naissance: this.teacher.date_naissance,
                sex: this.teacher.sex,
                tel: this.teacher.tel,
                matiere: this.teacher.matiere,
                rib: this.teacher.rib,
                diplom: this.teacher.diplom,
                description: this.teacher.description,
                photo_url: null,
            }),
            options: ['Homme','Femme'],
            image: '/storage/'+this.teacher.photo_url
        };
    },
    mounted(){
        
        if (this.form.sex=="Homme" && this.image != "/images/girl.jpg" && !this.teacher.photo_url) {
                this.image="/images/boy.jpg"
            }
            else if(this.form.sex=="Femme" && this.image != "/images/boy.jpg" && !this.teacher.photo_url){
                this.image="/images/girl.jpg"
            }
    },
    methods:{
        changeImg(){
            if (this.form.sex=="Homme" && this.image != "/images/girl.jpg" && !this.teacher.photo_url) {
                this.image="/images/boy.jpg"
               
            }
            else if(this.form.sex=="Femme" && this.image != "/images/boy.jpg" && !this.teacher.photo_url){
                this.image="/images/girl.jpg"
                
            }
        },
        submit() {
            this.form.post(route('teacher.update', this.teacher.id),{
                preserveScroll: true,                   
            })
        },
    }
}
</script>

<style lang="css" scoped>
    .form{
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    @media (max-width: 767px){
        .form{
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    }
    .avatar-input{
        display: flex;
        flex-direction: column;
        align-items: center;
        /* width: fit-content; */
    }
    @media (max-width: 767px){
        /* .inputs{
            display: flex;
            flex-direction: column;
            align-items: center;
        } */
    }
</style>