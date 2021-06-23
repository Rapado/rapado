<template>
    <breeze-authenticated-peluqueria-layout>
        <div class="bg-gray-100 md:bg-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
                <div class="grid grid-rows-1">
                    <div class="text-center text-xl">
                        Citas para hoy
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mx-2 md:mx-0 justify-items-center">
                        <div class="mt-4 w-full md:w-9/12 lg:w-11/12"  v-for="(peluquero, indexPel) in peluqueros.data" :key="peluquero.id">
                            <avatar :imagen="'/storage/'+ peluquero.imagen" :label=peluquero.nombre />
                            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                                <div class="mt-4 w-full"  v-for="(cita, indexCita) in peluquero.citas" :key="indexCita.id">
                                    <cita-visualizer :label="cita.horaInicio.substring(0, 5) + ' - ' + cita.horaTermina.substring(0, 5)"
                                        :cita = "cita"
                                        v-on:eliminar-cita = "quitarCitaDeLista(indexCita, indexPel)"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-4 md:py-12">
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
    import Avatar from '@/Components/Avatar'
    import CitaVisualizer from '@/Components/CitaVisualizer'

    export default {
        components: {
            BreezeAuthenticatedPeluqueriaLayout, PeluqueroCard, Avatar, CitaVisualizer
        },

        props:{
            peluqueros:{
                default: {data:[]}
            }
        },

        methods: {
            cambiarEstado(peluquero){
                peluquero.disponible = !peluquero.disponible
            },

            quitarCitaDeLista(citaIndex, indexPeluquero){
               this.peluqueros.data[indexPeluquero].citas.splice(citaIndex, 1);
            }
        }
    }
</script>
