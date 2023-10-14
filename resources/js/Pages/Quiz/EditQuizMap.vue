<template>
    <div>
        <form @submit.prevent="submit" class="shadow-md p-4 w-fit">
            <h2 class="text-center mb-4">Niveau {{ form.niveau }}</h2>
            <div @click="addQuestion" class="cursor-pointer text-lg text-center underline">Ajouter une autre question</div>
            <div class="flex gap-4 flex-wrap">
                <div v-for="(question, index) in form.questions" class="relative shadow-md p-6">
                    <div v-if="index > 0" @click="delQuestion(index)" class="absolute top-4 right-4 text-lg cursor-pointer">X</div>
                    <div>
                        <InputLabel>Question</InputLabel>
                        <TextInput v-model="form.questions[index].question" type="text"></TextInput>
                    </div>
                    <div class="mt-3">
                        <InputLabel>Réponse</InputLabel>
                        <div class="w-72">
                            <Listbox v-model="country" @click="addCountry(index)">
                                <div class="relative mt-1">
                                    <ListboxButton 
                                    class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                                        >
                                            <ChevronUpDownIcon
                                            class="h-5 w-5 text-gray-400"
                                            aria-hidden="true"
                                            />
                                        </span>
                                    </ListboxButton>
                                
                                    <transition
                                    leave-active-class="transition duration-100 ease-in"
                                    leave-from-class="opacity-100"
                                    leave-to-class="opacity-0"
                                    >
                                        <ListboxOptions
                                            class="absolute list mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                        >
                                            <ListboxOption
                                            v-slot="{ active, selected }"
                                            v-for="c in countries"
                                            
                                            :value="c.name"
                                            as="template"
                                            >
                                                <li
                                                :class="[
                                                    active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                                                    'relative cursor-default select-none py-2 pl-10 pr-4',
                                                ]"
                                                >
                                                    <span
                                                    :class="[
                                                        selected ? 'font-medium' : 'font-normal',
                                                        'block truncate',
                                                    ]"
                                                    >{{ c.name }}</span
                                                    >
                                                    <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                                    >
                                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                    </span>
                                                </li>
                                            </ListboxOption>
                                        </ListboxOptions>
                                    </transition>
                                </div>
                            </Listbox>
                        </div>
                        <div class="flex gap-2  my-4 ">
                            <div v-for="(c, i) in form.questions[index].reponse" class="flex gap-2 p-2 rounded-xl w-fit bg-slate-200 text-xs">
                                <div>{{ c }}</div>
                                <div @click="delCountry(index,i)" class="cursor-pointer">x</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-for="(question, index) in form.new_questions" class="relative shadow-md p-6">
                    <div v-if="index > 0" @click="delQuestion(index)" class="absolute top-4 right-4 text-lg cursor-pointer">X</div>
                    <div>
                        <InputLabel>Question</InputLabel>
                        <TextInput v-model="form.new_questions[index].question" type="text"></TextInput>
                    </div>
                    <div class="mt-3">
                        <InputLabel>Réponse</InputLabel>
                        <div class="w-72">
                            <Listbox v-model="country" @click="addNewCountry(index)">
                                <div class="relative mt-1">
                                    <ListboxButton 
                                    class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                    >
                                        <span
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                                        >
                                            <ChevronUpDownIcon
                                            class="h-5 w-5 text-gray-400"
                                            aria-hidden="true"
                                            />
                                        </span>
                                    </ListboxButton>
                                
                                    <transition
                                    leave-active-class="transition duration-100 ease-in"
                                    leave-from-class="opacity-100"
                                    leave-to-class="opacity-0"
                                    >
                                        <ListboxOptions
                                            class="absolute list mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                        >
                                            <ListboxOption
                                            v-slot="{ active, selected }"
                                            v-for="c in countries"
                                            
                                            :value="c.name"
                                            as="template"
                                            >
                                                <li
                                                :class="[
                                                    active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                                                    'relative cursor-default select-none py-2 pl-10 pr-4',
                                                ]"
                                                >
                                                    <span
                                                    :class="[
                                                        selected ? 'font-medium' : 'font-normal',
                                                        'block truncate',
                                                    ]"
                                                    >{{ c.name }}</span
                                                    >
                                                    <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                                    >
                                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                    </span>
                                                </li>
                                            </ListboxOption>
                                        </ListboxOptions>
                                    </transition>
                                </div>
                            </Listbox>
                        </div>
                        <div class="flex gap-2  my-4 ">
                            <div v-for="(c, i) in form.new_questions[index].countries" class="flex gap-2 p-2 rounded-xl w-fit bg-slate-200 text-xs">
                                <div>{{ c }}</div>
                                <div @click="delNewCountry(index,i)" class="cursor-pointer">x</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="flex justify-center mt-4">
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Modifier
                </SubmitButton>
            </div>
        </form>
    </div>
</template>

<script>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import axios from 'axios';
import SubmitButton from '@/Components/SubmitButton.vue';
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import { ref } from 'vue';
import {
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    } from '@headlessui/vue'

    
    export default {
        components: { InputLabel, TextInput, Combobox,
            ComboboxInput,
            ComboboxButton,
            ComboboxOptions,
            ComboboxOption,
            TransitionRoot,
            CheckIcon, 
            ChevronUpDownIcon,
            Listbox,
            ListboxLabel,
            ListboxButton,
            ListboxOptions,
            ListboxOption,
            SubmitButton
        },
        props:['level', 'id', 'quiz'],
        data() {
            return {
                form: this.$inertia.form({
                    niveau: this.quiz.niveau,
                    questions: this.quiz.quiz_maps,
                    new_questions:[]
                    
                }),
                can_submit: false,
                country: null,
                countries: [
                    {"name": "Afghanistan", "code": "AF"},
                    {"name": "Åland Islands", "code": "AX"},
                    {"name": "Albania", "code": "AL"},
                    {"name": "Algeria", "code": "DZ"},
                    {"name": "American Samoa", "code": "AS"},
                    {"name": "AndorrA", "code": "AD"},
                    {"name": "Angola", "code": "AO"},
                    {"name": "Anguilla", "code": "AI"},
                    {"name": "Antarctica", "code": "AQ"},
                    {"name": "Antigua and Barbuda", "code": "AG"},
                    {"name": "Argentina", "code": "AR"},
                    {"name": "Armenia", "code": "AM"},
                    {"name": "Aruba", "code": "AW"},
                    {"name": "Australia", "code": "AU"},
                    {"name": "Austria", "code": "AT"},
                    {"name": "Azerbaijan", "code": "AZ"},
                    {"name": "Bahamas", "code": "BS"},
                    {"name": "Bahrain", "code": "BH"},
                    {"name": "Bangladesh", "code": "BD"},
                    {"name": "Barbados", "code": "BB"},
                    {"name": "Belarus", "code": "BY"},
                    {"name": "Belgium", "code": "BE"},
                    {"name": "Belize", "code": "BZ"},
                    {"name": "Benin", "code": "BJ"},
                    {"name": "Bermuda", "code": "BM"},
                    {"name": "Bhutan", "code": "BT"},
                    {"name": "Bolivia", "code": "BO"},
                    {"name": "Bosnia and Herzegovina", "code": "BA"},
                    {"name": "Botswana", "code": "BW"},
                    {"name": "Bouvet Island", "code": "BV"},
                    {"name": "Brazil", "code": "BR"},
                    {"name": "British Indian Ocean Territory", "code": "IO"},
                    {"name": "Brunei Darussalam", "code": "BN"},
                    {"name": "Bulgaria", "code": "BG"},
                    {"name": "Burkina Faso", "code": "BF"},
                    {"name": "Burundi", "code": "BI"},
                    {"name": "Cambodia", "code": "KH"},
                    {"name": "Cameroon", "code": "CM"},
                    {"name": "Canada", "code": "CA"},
                    {"name": "Cape Verde", "code": "CV"},
                    {"name": "Cayman Islands", "code": "KY"},
                    {"name": "Central African Republic", "code": "CF"},
                    {"name": "Chad", "code": "TD"},
                    {"name": "Chile", "code": "CL"},
                    {"name": "China", "code": "CN"},
                    {"name": "Christmas Island", "code": "CX"},
                    {"name": "Cocos (Keeling) Islands", "code": "CC"},
                    {"name": "Colombia", "code": "CO"},
                    {"name": "Comoros", "code": "KM"},
                    {"name": "Congo", "code": "CG"},
                    {"name": "Congo, The Democratic Republic of the", "code": "CD"},
                    {"name": "Cook Islands", "code": "CK"},
                    {"name": "Costa Rica", "code": "CR"},
                    {"name": "Croatia", "code": "HR"},
                    {"name": "Cuba", "code": "CU"},
                    {"name": "Cyprus", "code": "CY"},
                    {"name": "Czech Republic", "code": "CZ"},
                    {"name": "Denmark", "code": "DK"},
                    {"name": "Djibouti", "code": "DJ"},
                    {"name": "Dominica", "code": "DM"},
                    {"name": "Dominican Republic", "code": "DO"},
                    {"name": "Ecuador", "code": "EC"},
                    {"name": "Egypt", "code": "EG"},
                    {"name": "El Salvador", "code": "SV"},
                    {"name": "Equatorial Guinea", "code": "GQ"},
                    {"name": "Eritrea", "code": "ER"},
                    {"name": "Estonia", "code": "EE"},
                    {"name": "Ethiopia", "code": "ET"},
                    {"name": "Falkland Islands (Malvinas)", "code": "FK"},
                    {"name": "Faroe Islands", "code": "FO"},
                    {"name": "Fiji", "code": "FJ"},
                    {"name": "Finland", "code": "FI"},
                    {"name": "France", "code": "FR"},
                    {"name": "French Guiana", "code": "GF"},
                    {"name": "French Polynesia", "code": "PF"},
                    {"name": "French Southern Territories", "code": "TF"},
                    {"name": "Gabon", "code": "GA"},
                    {"name": "Gambia", "code": "GM"},
                    {"name": "Georgia", "code": "GE"},
                    {"name": "Germany", "code": "DE"},
                    {"name": "Ghana", "code": "GH"},
                    {"name": "Gibraltar", "code": "GI"},
                    {"name": "Greece", "code": "GR"},
                    {"name": "Greenland", "code": "GL"},
                    {"name": "Grenada", "code": "GD"},
                    {"name": "Guadeloupe", "code": "GP"},
                    {"name": "Guam", "code": "GU"},
                    {"name": "Guatemala", "code": "GT"},
                    {"name": "Guernsey", "code": "GG"},
                    {"name": "Guinea", "code": "GN"},
                    {"name": "Guinea-Bissau", "code": "GW"},
                    {"name": "Guyana", "code": "GY"},
                    {"name": "Haiti", "code": "HT"},
                    {"name": "Heard Island and Mcdonald Islands", "code": "HM"},
                    {"name": "Holy See (Vatican City State)", "code": "VA"},
                    {"name": "Honduras", "code": "HN"},
                    {"name": "Hong Kong", "code": "HK"},
                    {"name": "Hungary", "code": "HU"},
                    {"name": "Iceland", "code": "IS"},
                    {"name": "India", "code": "IN"},
                    {"name": "Indonesia", "code": "ID"},
                    {"name": "Iran, Islamic Republic Of", "code": "IR"},
                    {"name": "Iraq", "code": "IQ"},
                    {"name": "Ireland", "code": "IE"},
                    {"name": "Isle of Man", "code": "IM"},
                    {"name": "Israel", "code": "IL"},
                    {"name": "Italy", "code": "IT"},
                    {"name": "Jamaica", "code": "JM"},
                    {"name": "Japan", "code": "JP"},
                    {"name": "Jersey", "code": "JE"},
                    {"name": "Jordan", "code": "JO"},
                    {"name": "Kazakhstan", "code": "KZ"},
                    {"name": "Kenya", "code": "KE"},
                    {"name": "Kiribati", "code": "KI"},
                    {"name": "Korea, Republic of", "code": "KR"},
                    {"name": "Kuwait", "code": "KW"},
                    {"name": "Kyrgyzstan", "code": "KG"},
                    {"name": "Latvia", "code": "LV"},
                    {"name": "Lebanon", "code": "LB"},
                    {"name": "Lesotho", "code": "LS"},
                    {"name": "Liberia", "code": "LR"},
                    {"name": "Libyan Arab Jamahiriya", "code": "LY"},
                    {"name": "Liechtenstein", "code": "LI"},
                    {"name": "Lithuania", "code": "LT"},
                    {"name": "Luxembourg", "code": "LU"},
                    {"name": "Macao", "code": "MO"},
                    {"name": "North Macedonia", "code": "MK"},
                    {"name": "Madagascar", "code": "MG"},
                    {"name": "Malawi", "code": "MW"},
                    {"name": "Malaysia", "code": "MY"},
                    {"name": "Maldives", "code": "MV"},
                    {"name": "Mali", "code": "ML"},
                    {"name": "Malta", "code": "MT"},
                    {"name": "Marshall Islands", "code": "MH"},
                    {"name": "Martinique", "code": "MQ"},
                    {"name": "Mauritania", "code": "MR"},
                    {"name": "Mauritius", "code": "MU"},
                    {"name": "Mayotte", "code": "YT"},
                    {"name": "Mexico", "code": "MX"},
                    {"name": "Micronesia, Federated States of", "code": "FM"},
                    {"name": "Moldova, Republic of", "code": "MD"},
                    {"name": "Monaco", "code": "MC"},
                    {"name": "Mongolia", "code": "MN"},
                    {"name": "Montserrat", "code": "MS"},
                    {"name": "Morocco", "code": "MA"},
                    {"name": "Mozambique", "code": "MZ"},
                    {"name": "Myanmar", "code": "MM"},
                    {"name": "Namibia", "code": "NA"},
                    {"name": "Nauru", "code": "NR"},
                    {"name": "Nepal", "code": "NP"},
                    {"name": "Netherlands", "code": "NL"},
                    {"name": "Netherlands Antilles", "code": "AN"},
                    {"name": "New Caledonia", "code": "NC"},
                    {"name": "New Zealand", "code": "NZ"},
                    {"name": "Nicaragua", "code": "NI"},
                    {"name": "Niger", "code": "NE"},
                    {"name": "Nigeria", "code": "NG"},
                    {"name": "Niue", "code": "NU"},
                    {"name": "Norfolk Island", "code": "NF"},
                    {"name": "Northern Mariana Islands", "code": "MP"},
                    {"name": "Norway", "code": "NO"},
                    {"name": "Oman", "code": "OM"},
                    {"name": "Pakistan", "code": "PK"},
                    {"name": "Palau", "code": "PW"},
                    {"name": "Palestinian Territory, Occupied", "code": "PS"},
                    {"name": "Panama", "code": "PA"},
                    {"name": "Papua New Guinea", "code": "PG"},
                    {"name": "Paraguay", "code": "PY"},
                    {"name": "Peru", "code": "PE"},
                    {"name": "Philippines", "code": "PH"},
                    {"name": "Pitcairn Islands", "code": "PN"},
                    {"name": "Poland", "code": "PL"},
                    {"name": "Portugal", "code": "PT"},
                    {"name": "Puerto Rico", "code": "PR"},
                    {"name": "Qatar", "code": "QA"},
                    {"name": "Reunion", "code": "RE"},
                    {"name": "Romania", "code": "RO"},
                    {"name": "Russian Federation", "code": "RU"},
                    {"name": "Rwanda", "code": "RW"},
                    {"name": "Saint Helena", "code": "SH"},
                    {"name": "Saint Kitts and Nevis", "code": "KN"},
                    {"name": "Saint Lucia", "code": "LC"},
                    {"name": "Saint Pierre and Miquelon", "code": "PM"},
                    {"name": "Saint Vincent and the Grenadines", "code": "VC"},
                    {"name": "Samoa", "code": "WS"},
                    {"name": "San Marino", "code": "SM"},
                    {"name": "Sao Tome and Principe", "code": "ST"},
                    {"name": "Saudi Arabia", "code": "SA"},
                    {"name": "Senegal", "code": "SN"},
                    {"name": "Serbia and Montenegro", "code": "CS"},
                    {"name": "Seychelles", "code": "SC"},
                    {"name": "Sierra Leone", "code": "SL"},
                    {"name": "Singapore", "code": "SG"},
                    {"name": "Slovakia", "code": "SK"},
                    {"name": "Slovenia", "code": "SI"},
                    {"name": "Solomon Islands", "code": "SB"},
                    {"name": "Somalia", "code": "SO"},
                    {"name": "South Africa", "code": "ZA"},
                    {"name": "South Georgia and the South Sandwich Islands", "code": "GS"},
                    {"name": "Spain", "code": "ES"},
                    {"name": "Sri Lanka", "code": "LK"},
                    {"name": "Sudan", "code": "SD"},
                    {"name": "Suriname", "code": "SR"},
                    {"name": "Svalbard and Jan Mayen", "code": "SJ"},
                    {"name": "Swaziland", "code": "SZ"},
                    {"name": "Sweden", "code": "SE"},
                    {"name": "Switzerland", "code": "CH"},
                    {"name": "Syrian Arab Republic", "code": "SY"},
                    {"name": "Taiwan", "code": "TW"},
                    {"name": "Tajikistan", "code": "TJ"},
                    {"name": "Tanzania, United Republic of", "code": "TZ"},
                    {"name": "Thailand", "code": "TH"},
                    {"name": "Timor-Leste", "code": "TL"},
                    {"name": "Togo", "code": "TG"},
                    {"name": "Tokelau", "code": "TK"},
                    {"name": "Tonga", "code": "TO"},
                    {"name": "Trinidad and Tobago", "code": "TT"},
                    {"name": "Tunisia", "code": "TN"},
                    {"name": "Turkey", "code": "TR"},
                    {"name": "Turkmenistan", "code": "TM"},
                    {"name": "Turks and Caicos Islands", "code": "TC"},
                    {"name": "Tuvalu", "code": "TV"},
                    {"name": "Uganda", "code": "UG"},
                    {"name": "Ukraine", "code": "UA"},
                    {"name": "United Arab Emirates", "code": "AE"},
                    {"name": "United Kingdom", "code": "GB"},
                    {"name": "United States", "code": "US"},
                    {"name": "United States Minor Outlying Islands", "code": "UM"},
                    {"name": "Uruguay", "code": "UY"},
                    {"name": "Uzbekistan", "code": "UZ"},
                    {"name": "Vanuatu", "code": "VU"},
                    {"name": "Venezuela", "code": "VE"},
                    {"name": "Vietnam", "code": "VN"},
                    {"name": "Virgin Islands, British", "code": "VG"},
                    {"name": "Virgin Islands, U.S.", "code": "VI"},
                    {"name": "Wallis and Futuna", "code": "WF"},
                    {"name": "Western Sahara", "code": "EH"},
                    {"name": "Yemen", "code": "YE"},
                    {"name": "Zambia", "code": "ZM"},
                    {"name": "Zimbabwe","code": "ZN"}
                ],
                len: null
            };
        },
    /* created() {
        this.fetchCountries();
    }, */
    methods: {
        /* async fetchCountries() {
            this.countries = (await axios.get("/other/countries-list.json")).data;
            this.len=this.countries.length
            console.log(this.countries.length);
        }, */
        addQuestion(){
            this.form.new_questions.push({   
                question:'',
                countries: [],
            })
        },
        delQuestion(index){
            if(this.form.questions.length > 1)
                this.form.questions.splice(index,1)
        },
        delNewQuestion(index){
            
                this.form.new_questions.splice(index,1)
        },
        addCountry(i){
            if(!this.form.questions[i].reponse.includes(this.country))
                this.form.questions[i].reponse.push(this.country)
        },
        addNewCountry(i){
            if(!this.form.new_questions[i].countries.includes(this.country))
                this.form.new_questions[i].countries.push(this.country)
        },
        delCountry(index, i){
            this.form.questions[index].reponse.splice(i,1)
            //console.log(this.form.country);
        },
        delNewCountry(index, i){
            this.form.new_questions[index].countries.splice(i,1)
        },
        submit(){
            this.form.post(route('store.map', this.id), {
                preserveScroll: true,
                onSuccess: () => location.reload()
            })
        },
        add(i){
            console.log(i);
        }
    },
    /* computed: {
        filteredCountries(){
            this.query.value === ''
                ? this.countries
                : this.countries.filter((country) =>
                    country.name
                    .toLowerCase()
                    .replace(/\s+/g, '')
                    .includes(query.value.toLowerCase().replace(/\s+/g, ''))
                )
        }
    }, */
    /* watch: {
        country(newValue){
            if(!this.form.countries.includes(this.country))
                this.form.countries.push(this.country)
        }
    } */
    
}
</script>

<style lang="scss" scoped>
    .list{
        z-index: 2000;
    }
</style>