<template>
    <breeze-authenticated-peluqueria-layout>
        <div class="bg-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
                <div class="grid grid-rows-1">
                    <div class="text-center text-xl">
                        Citas para hoy
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mx-2 md:mx-0 justify-items-center">
                        <div class="mt-4 w-full md:w-9/12"  v-for="(peluquero, index) in peluqueros.data" :key="index">
                            <peluquero-card :peluquero="peluquero" :show-stars="false" :cambiar-peluquero-estado="true" v-on:cambioEstado = "cambiarEstado">
                            </peluquero-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6 md:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-rows-1 mt-7">
                    <div class="text-center text-xl">
                        Peluqueros
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mx-2 md:mx-0 justify-items-center">
                        <div class="mt-4 w-full md:w-9/12 "  v-for="(peluquero, index) in peluqueros.data" :key="index">
                            <peluquero-card :peluquero="peluquero" :show-stars="false" :cambiar-peluquero-estado="true" v-on:cambioEstado = "cambiarEstado">
                            </peluquero-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-peluqueria-layout>
</template>

<script>
    import BreezeAuthenticatedPeluqueriaLayout from '@/Layouts/AuthenticatedPeluqueria'
    import PeluqueroCard from '@/Components/PeluqueroCard'

    export default {
        components: {
            BreezeAuthenticatedPeluqueriaLayout, PeluqueroCard
        },

        props:{
            peluqueros:{
                default: {data:[]}
            }
        },

        methods: {
            cambiarEstado(peluquero){
                peluquero.disponible = !peluquero.disponible
            }
        }
    }
</script>
