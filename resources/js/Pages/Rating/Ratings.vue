<template>
    <div>
        <div class="flex items-center gap-4 mt-5">
            <div class="">
                <div class="flex">
                    <div v-for="i in stars">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-10 h-10 transition duration-700" v-if="i - variance >0 && i - variance < 1">
                            <defs>
                                <linearGradient id="grad">
                                    <stop offset="0%" stop-color="#eab308"/>
                                    <stop :offset="(variance - (i-1)) * 100 +'%'" stop-color="#eab308"/>
                                    <stop :offset="(variance - (i-1)) * 100 +'%'" stop-color="transparent"/>
                                    <stop offset="100%" stop-color="transparent"/>
                                </linearGradient>
                            </defs>
                            <path fill="url(#grad)" stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-8 h-8 fill-none transition duration-700" :class="i<= variance ? 'fill-yellow-500 stroke-none': '' " v-else>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                </div>
                <div class="variance">{{ variance.toFixed(1) }}</div>
                <div class="note">Notes</div>
                
            </div>
            <div class="flex flex-col gap-2 ">
                <div class="flex items-center gap-2">
                    <ProgressBar :progress="progress_5_stars"></ProgressBar>
                    <div v-if="progress_5_stars>1">{{ progress_5_stars.toFixed(1) }} %</div>
                    <div v-else>{{ progress_5_stars }} %</div>
                    <div class="flex">
                        <div v-for="i in stars">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 5 ? 'fill-yellow-500 stroke-none': '' ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                    </div>
                    
                </div>
                <div class="flex items-center gap-2">
                    <ProgressBar :progress="progress_4_stars"></ProgressBar>
                    <div v-if="progress_4_stars>1">{{ progress_4_stars.toFixed(1) }} %</div>
                    <div v-else>{{ progress_4_stars }} %</div>
                    <div class="flex">
                        <div v-for="i in stars">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 4 ? 'fill-yellow-500 stroke-none': '' ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                    </div>
                    
                </div>
                <div class="flex items-center gap-2">
                    <ProgressBar :progress="progress_3_stars"></ProgressBar>
                    <div v-if="progress_3_stars>1">{{ progress_3_stars.toFixed(1) }} %</div>
                    <div v-else>{{ progress_3_stars }} %</div>
                    <div class="flex">
                        <div v-for="i in stars">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 3 ? 'fill-yellow-500 stroke-none': '' ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                    </div>
                    
                </div>
                <div class="flex items-center gap-2">
                    <ProgressBar :progress="progress_2_stars"></ProgressBar>
                    <div v-if="progress_2_stars>1">{{ progress_2_stars.toFixed(1) }} %</div>
                    <div v-else>{{ progress_2_stars }} %</div>
                    <div class="flex">
                        <div v-for="i in stars">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 2 ? 'fill-yellow-500 stroke-none': '' ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                    </div>
                    
                </div>
                <div class="flex items-center gap-2">
                    <ProgressBar :progress="progress_1_stars"></ProgressBar>
                    <div v-if="progress_1_stars>1">{{ progress_1_stars.toFixed(1) }} %</div>
                    <div v-else>{{ progress_1_stars }} %</div>
                    <div class="flex">
                        <div v-for="i in stars">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 1 ? 'fill-yellow-500 stroke-none': '' ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="mx-20 mt-5">
            <div v-for="star in stars5">
                <div v-if="star.commentaire">
                    <div class="flex items-center gap-2">
                        <img :src="'/storage/'+star.user.roleable.photo_url" class="w-10 h-10 rounded-full object-cover" v-if="$page.props.auth.user.roleable.photo_url">
                        <img src="/images/boy.jpg" class="w-10 rounded-full" v-else-if="star.user.roleable.sex=='Homme'">
                        <img src="/images/girl.jpg" class="w-10 rounded-full" v-else-if="star.user.roleable.sex=='Femme'">
                        
                        <div>
                            <div class="text-lg">{{ star.user.nom }} {{ star.user.prenom }}</div>
                            <!-- <div class="text-xs">{{ getTime(question.created_at) }}</div> -->
                            <div class="text-xs ml-2">{{ getDate(star.commentaire.created_at) }}</div>
                        </div>
                    </div>
                    <div class="ml-6">
                        <div class="flex">
                            <div v-for="i in stars">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 5 ? 'fill-yellow-500 stroke-none': '' ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="ml-6">{{ star.commentaire.contenu }}</div>
                    
                </div>
            </div>
            <div v-for="star in stars4">
                <div v-if="star.commentaire">
                    <div class="flex items-center gap-2">
                        <img src="/images/boy.jpg" alt="" class="w-10 h-10 rounded-full">
                        <div>
                            <div class="text-lg">{{ star.user.nom }} {{ star.user.prenom }}</div>
                            <!-- <div class="text-xs">{{ getTime(question.created_at) }}</div> -->
                            <div class="text-xs ml-2">{{ getDate(star.commentaire.created_at) }}</div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex gap-2">
                            <div v-for="i in stars">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 4 ? 'fill-yellow-500 stroke-none': '' ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>{{ star.commentaire.contenu }}</div>
                </div>
            </div>
            <div v-for="star in stars3">
                <div v-if="star.commentaire">
                    <div class="flex items-center gap-2">
                        <img src="/images/boy.jpg" alt="" class="w-10 h-10 rounded-full">
                        <div>
                            <div class="text-lg">{{ star.user.nom }} {{ star.user.prenom }}</div>
                            <!-- <div class="text-xs">{{ getTime(question.created_at) }}</div> -->
                            <div class="text-xs ml-2">{{ getDate(star.commentaire.created_at) }}</div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex gap-2">
                            <div v-for="i in stars">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 3 ? 'fill-yellow-500 stroke-none': '' ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>{{ star.commentaire.contenu }}</div>
                </div>
            </div>
            <div v-for="star in stars2">
                <div v-if="star.commentaire">
                    <div class="flex items-center gap-2">
                        <img src="/images/boy.jpg" alt="" class="w-10 h-10 rounded-full">
                        <div>
                            <div class="text-lg">{{ star.user.nom }} {{ star.user.prenom }}</div>
                            <!-- <div class="text-xs">{{ getTime(question.created_at) }}</div> -->
                            <div class="text-xs ml-2">{{ getDate(star.commentaire.created_at) }}</div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex gap-2">
                            <div v-for="i in stars">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 2 ? 'fill-yellow-500 stroke-none': '' ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>{{ star.commentaire.contenu }}</div>
                </div>
            </div>
            <div v-for="star in stars1">
                <div v-if="star.commentaire">
                    <div class="flex items-center gap-2">
                        <img src="/images/boy.jpg" alt="" class="w-10 h-10 rounded-full">
                        <div>
                            <div class="text-lg">{{ star.user.nom }} {{ star.user.prenom }}</div>
                            <!-- <div class="text-xs">{{ getTime(question.created_at) }}</div> -->
                            <div class="text-xs ml-2">{{ getDate(star.commentaire.created_at) }}</div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex gap-2">
                            <div v-for="i in stars">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eab308" class="w-6 h-6 fill-none transition duration-700" :class="i<= 1 ? 'fill-yellow-500 stroke-none': '' ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>{{ star.commentaire.contenu }}</div>
                </div>
            </div>
        </div>
        
        
    </div>
</template>

<script>
    import ProgressBar from '@/Components/ProgressBar.vue'
    export default {
        components: {ProgressBar},
        props: ['stars5', 'stars4', 'stars3', 'stars2', 'stars1',],
        data(){
            return {
                stars: [1, 2, 3, 4, 5],
                progress_5_stars: null,
                progress_4_stars: null,
                progress_3_stars: null,
                progress_2_stars: null,
                progress_1_stars: null,
                len_stars: null,
                variance: null
            }
        },
        created(){
            this.len_stars= this.stars1.length + this.stars2.length + this.stars3.length + this.stars4.length + this.stars5.length
            if(this.len_stars==0){
                this.progress_1_stars=0
                this.progress_2_stars=0
                this.progress_3_stars=0
                this.progress_4_stars=0
                this.progress_5_stars=0
                this.variance=0
            }
            else{
                this.progress_1_stars= (this.stars1.length * 100) / this.len_stars
                this.progress_2_stars= (this.stars2.length * 100) / this.len_stars
                this.progress_3_stars= (this.stars3.length * 100) / this.len_stars
                this.progress_4_stars= (this.stars4.length * 100) / this.len_stars
                this.progress_5_stars= (this.stars5.length * 100) / this.len_stars
                
                this.variance= (this.stars1.length + this.stars2.length * 2 + this.stars3.length * 3 + this.stars4.length * 4 + this.stars5.length * 5) / this.len_stars
            }
            
        },
        methods: {
            getDate(dateTimeString) {
                const dateObject = new Date(dateTimeString);
                return dateObject.toISOString().slice(0, 10);
            },
        }
    }
</script>

<style lang="scss" scoped>
    .variance{
        font-size : 60px;
        font-weight: bold;
        text-align: center;
        color: #eab308;
        padding: 0;
    }
    .note{
        font-size : 30px;
        font-weight: bolder;
        text-align: center;
        color: #eab308;
        padding: 0;
    }
</style>