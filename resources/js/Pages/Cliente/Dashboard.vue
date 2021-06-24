<template>
    <breeze-authenticated-layout>
        <div v-if="citas.data.length > 0" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-3 bg-gradient-to-l from-secondary-dark to-mauve text-lg text-white border-b md:rounded border-gray-200">
                    {{citasAlert}}
                </div>
                <div class="p-6 mx-5 md:mx-10 bg-white text-secondary-light border-b border-gray-200 text-center">
                    <div v-for="(cita, indexCita) in citas.data" :key="indexCita">
                        <div class="my-3 md:flex items-center">
                            <div class="mr-3 mb-3 md:mb-0">
                                 Tienes una cita a las {{cita.horaInicio.substring(0,5)}}
                            </div>
                            <cita-visualizer
                                class="w-full md:w-2/12"
                                label="Ver detalles"
                                :cita = "cita"
                                url-eliminar = '/eliminar_cita/'
                                v-on:eliminar-cita = "quitarCitaDeLista(indexCita,)"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-secondary overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-secondary text-white text-lg border-b border-gray-200">
                        Peluquerias Favoritas
                    </div>
                    <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center">
                        <div class="overflow-hidden shadow-sm" v-for="(peluqueria,index) in peluquerias" :key="index" style="display: inline-block ">
                            <div class="grid justify-items-stretch">
                                <div class="max-w-sm mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-secondary overflow-hidden shadow-2xl rounded-lg ">
                                        <div class="p-2 bg-secondary text-white border-b border-gray-200 max-w-sm text-right">
                                            <div style="display: inline-block">
                                            {{peluqueria.nombre}}
                                            </div>
                                            <div style="display: inline-block" class="align-top text-left ml-8">
                                                <div v-if = "horario===null">
                                                    <svg enable-background="new 0 0 24 24" height="15" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107"/></svg>
                                                </div>
                                                <div v-else-if ="peluqueria.horario===null" >
                                                    <div class="rounded-full h-3 w-3 bg-red-500"></div>
                                                </div>
                                                <div v-else>
                                                    <div v-if="peluqueria.horario.horaActual>peluqueria.horario.apertura && peluqueria.horario.horaActual<peluqueria.horario.cierre">
                                                        <div class="rounded-full h-3 w-3 bg-green-500"></div>
                                                    </div>
                                                    <div v-else>
                                                        <div class="rounded-full h-3 w-3 bg-red-500"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200">
                                            <div class="h-50% w-50%">
                                                <img class="h-50% w-50% rounded-md cursor-pointer "  @click="Peluqueria(peluqueria.id)"  :src="'storage/'+peluqueria.logo" alt="" />
                                            </div>
                                            <div class="text-center">
                                                Direccion: {{peluqueria.direccion}}
                                            </div>
                                            <div class="text-center">
                                                Telefono: {{peluqueria.telefono}}
                                            </div>
                                            <div class="my-8 text-center" >
                                                <btn-gris @click="Agendar(peluqueria.id) ">Agendar</btn-gris>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import BtnGris from '@/Components/GreyButton'
    import Swal from 'sweetalert2'
    import CitaVisualizer from '@/Components/CitaVisualizer'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            BtnGris,
            CitaVisualizer
        },
        props:{
            peluquerias:{},
            horario:{},
            citas:{},
        },

        methods:{
            Peluqueria(id_peluqueria){
                location.href ='/informacionpeluqueria/'+ id_peluqueria
            },

            Agendar(id_peluqueria){
                location.href ='/agendar/'+ id_peluqueria
            },

            quitarCitaDeLista(citaIndex){
               this.citas.data.splice(citaIndex, 1);
            }
        },

        computed:{
            citasAlert: function(){
                return this.citas.data.length > 1 ? 'No olvides atender tus citas' : 'No olvides atender tu cita'
            }
        }

    }
</script>
