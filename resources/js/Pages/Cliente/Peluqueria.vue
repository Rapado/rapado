<template>
    <breeze-authenticated-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200 ">
                            <div class="grid justify-items-stretch text-2xl">
                                {{peluquerias.nombre}}
                            </div>
                            <div class="h-50% w-50%">
                                <img class="h-50% w-50% rounded-md cursor-pointer "  @click="Peluqueria(peluquerias.id) " :src="'/storage/'+peluquerias.logo" alt="" />
                            </div>
                            <div class="text-center">
                                Direccison: {{peluquerias.direccion}}
                            </div>
                            <div class="text-center">
                                Telefono: {{peluquerias.telefono}}
                            </div>
                            <div>
                                <btn-gris @click="AgregarFavoritos(peluquerias.id) ">Agregar a favoritos</btn-gris>
                            </div>
                        </div>
                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200">
                            <div class="grid justify-items-stretch text-2xl">
                                Peluqueros
                            </div>
                            <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center">
                                <td v-for="(peluquero,index) in peluqueros" :key="index" style="display: inline-block">
                                    <div class="grid justify-items-stretch">
                                        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
                                            <div class=" overflow-hidden shadow-sm sm:rounded-lg ">
                                                <div class="text-center">
                                                        {{peluquero.nombre}}
                                                </div>
                                                <div class="p-6 bg-white text-secondary-light border-b border-gray-200">
                                                    <div class="h-50% w-50%">
                                                        <img class="h-50% w-50% rounded-md cursor-pointer " :src="'/storage/'+peluquero.imagen" alt="" />
                                                    </div>
                                                    <div class="text-center">
                                                        Agrega estrellas de evaluacion
                                                    </div>
                                                    <div class="text-center">
                                                        Puede atenderte
                                                    </div>
                                                    <div class="text-center">
                                                        <btn-gris @click="Formarce(peluquero.id) ">Formarce</btn-gris>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </div>
                        </div>
                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200">
                            <div class="grid justify-items-stretch text-2xl">
                                Servicios
                            </div>
                            <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center">
                                <td v-for="(servicio,index) in servicios" :key="index" style="display: inline-block">
                                    <div class="grid justify-items-stretch">
                                        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
                                            <div class=" overflow-hidden shadow-sm sm:rounded-lg ">
                                                <div class="text-center">
                                                        {{peluquero.nombre}}
                                                </div>
                                                <div class="p-6 bg-white text-secondary-light border-b border-gray-200">
                                                    <div class="h-50% w-50%">
                                                        <img class="h-50% w-50% rounded-md cursor-pointer " :src="'storage/'+peluquero.logo" alt="" />
                                                    </div>
                                                    <div class="text-center">
                                                        Agrega estrellas de evaluacion
                                                    </div>
                                                    <div class="text-center">
                                                        Puede atenderte
                                                    </div>
                                                    <div class="text-center">
                                                        <btn-gris @click="Formarce(peluquero.id) ">Formarce</btn-gris>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
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
            peluquerias:{},
            peluqueros:{},
            servicios:{}
        },
        
        methods:{
            AgregarFavoritos(id_peluqueria){
                
                axios.post('/peluqueria/agregar_favoritos/'+id_peluqueria)
                .then(response => {
                    Swal.fire({
                        text:'Peluqueria Agragada', 
                        icon:'success',
                    })
                })
                .catch(error=>{
                    console.log(error)
                })
            }
        }

    }
</script>
