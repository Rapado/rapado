<template>
    <breeze-authenticated-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-secondary overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-secondary text-white border-b border-gray-200">
                        Peluqueria cerca de ti
                    </div>
                    <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center">
                        <div v-for="(peluqueria,index) in peluquerias" :key="index" style="display: inline-block ">
                            <div class="grid justify-items-stretch">
                                <div class="max-w-md mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-secondary overflow-hidden shadow-sm sm:rounded-lg ">
                                        <div class="p-2 bg-secondary text-white border-b border-gray-200">
                                            {{peluqueria.nombre}}
                                        </div>
                                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200">
                                            <div class="h-50% w-50%">
                                                <img class="h-50% w-50% rounded-md cursor-pointer "  @click="Peluqueria(peluqueria.id) " :src="'storage/'+peluqueria.logo" alt="" />
                                            </div>
                                            <div class="text-center">
                                                Direccion: {{peluqueria.direccion}}
                                            </div>
                                            <div class="text-center">
                                                Telefono: {{peluqueria.telefono}}
                                            </div>
                                            <div class="text-center">
                                                <a @click="Peluqueria(peluqueria.id) " class="no-underline hover:underline cursor-pointer" >Mas informacion</a>
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
    

    export default {
        components: {
            BreezeAuthenticatedLayout,
            BtnGris
        },
        props:{
            peluquerias:{}
        },
        methods:{
            Peluqueria(id_peluqueria){
                location.href ='/informacionpeluqueria/'+ id_peluqueria
                }
        }

    }
</script>
