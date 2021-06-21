<template>
    <breeze-authenticated-peluqueria-layout :hide-nav="firstTime">
        <div class="md:py-10">
            <div v-if="firstTime" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-secondary overflow-hidden shadow-md sm:rounded-lg">
                    <div  class="py-2 border-b border-gray-200 text-center">
                        <div  class="flex gap-1 justify-center items-center ">
                            <div >
                                <svg class = "fill-current text-accent" xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 0 24 24" width="35px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/></svg>
                            </div>
                        </div>
                        <div class="text-secondary-light md:text-center mt-2">
                            Por ultimo deberas registrar tu horario de trabajo
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-white bg-secondary border-b border-gray-200">
                        <div class="ml-3">
                           Horario de atención
                        </div>
                    </div>
                    <div class="py-1 mx-4 md:ml bg-white border-b border-gray-200">
                        <div class="flex gap-4 justify-between mt-4">
                            <div v-for="(dia, index) in dias" :key="index">
                                 <work-day :dia="dia" :no-dia = "index + 1" :work-day = "obtenerDia(index)"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="firstTime" class="flex max-w-7xl mx-auto my-4 sm:px-6 lg:px-8 justify-end ">
                <gray-button @click="nextStep" class="mt-3 mx-4 md:mx-0 md:mt-0 md:ml-4 w-full md:w-auto py-3">
                    Terminar
                </gray-button>
            </div>
        </div>
    </breeze-authenticated-peluqueria-layout>
</template>

<script>
    import BreezeAuthenticatedPeluqueriaLayout from '@/Layouts/AuthenticatedPeluqueria'
    import MyInput from '@/Components/Input'
    import InputFile from '@/Components/FileInput'
    import GrayButton from '@/Components/GreyButton'
    import WorkDay from '@/Components/WorkDay'

    export default {
        props:{
            firstTime:{
                default: false,
            },

            horario:{
                default: [null, null, null, null, null, null, null]
            },
        },

        components: {
            BreezeAuthenticatedPeluqueriaLayout, MyInput, GrayButton, InputFile, WorkDay
        },

        data() {
            return {
                dias: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
            }
        },

        mounted() {
        },

        methods: {
            obtenerDia(index){
                return this.horario[index] != null ? this.horario[index].data : null;
            },

            nextStep(){
                location.reload();
            }
        },
    }
</script>
