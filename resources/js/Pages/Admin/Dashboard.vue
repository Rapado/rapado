<template>
    <breeze-authenticated-admin-layout>
        <div class="flex flex-col md:items-center">
            <div class="pt-6 mb-2 w-screen max-w-7xl">
                <div class="w-full lg:px-8">
                    <div class="px-5 py-2 text-xs font-semibold md:rounded-lg bg-gray-800 text-white text-md md:text-lg">
                        Peluquerías esperando para ser aceptadas
                    </div>
                </div>
            </div>
            <div id="table-view" class="overflow-x-auto sm:-mx-6 lg:-mx-8  w-screen max-w-7xl">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Peluquería
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Telefono
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Direccion
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha de registro
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Documento
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Revisado por
                            </th>
                            <th scope="col" class="px-6 py-3 tracking-wider">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="(peluqueriaPendiente, index) in peluqueriasPendientes.data" :key="index">
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-md" :src="peluqueriaPendiente.peluqueria.imagen" alt="" />
                                </div>
                                <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ peluqueriaPendiente.peluqueria.nombre }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ peluqueriaPendiente.peluqueria.nombreEncargado }}
                                </div>
                                </div>
                            </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ peluqueriaPendiente.peluqueria.telefono }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ peluqueriaPendiente.peluqueria.direccion }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ peluqueriaPendiente.peluqueria.dadaDeAlta }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap  text-sm font-medium">
                                <div class="text-sm font-medium text-gray-900">
                                    <a :href="getLink(peluqueriaPendiente.peluqueria.id)" class="text-blue-500 hover:text-blue-700">Descargar</a>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ peluqueriaPendiente.peluqueria.actualizado }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class = "peluqueriaPendiente.estadoInfo.class" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-green-800">
                                    {{peluqueriaPendiente.estadoInfo.string}}
                                </span>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ peluqueriaPendiente.admin }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ peluqueriaPendiente.ultimaRevision }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <breeze-button @click="editBarber(peluqueriaPendiente, index)">
                                    Editar
                                </breeze-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div id = "change-state-form">
                <state-barber-modal :can-show-modal = 'showEditStateForm' :barber = 'barberToEditState' @hideModal = "hideModal" @updateBarberList = "updateBarberList">

                </state-barber-modal>
            </div>
        </div>
    </breeze-authenticated-admin-layout>
</template>

<script>
    import Swal from 'sweetalert2'
    import BreezeAuthenticatedAdminLayout from '@/Layouts/AuthenticatedAdmin'
    import BreezeButton from '@/Components/Button'
    import StateBarberModal from '@/Components/StateBarberModal'

    export default {
        components: {
            BreezeAuthenticatedAdminLayout, BreezeButton, StateBarberModal
        },

        props: {
            peluqueriasPendientes:{
                default: []
            }
        },

        data() {
            return {
                showEditStateForm: false,
                barberToChangeState: {},
                barberIndex: -1,
            }
        },

        methods:{
            editBarber(barber, barberIndex){
                this.showEditStateForm = true;
                this.barberToEditState = barber;
                this.barberIndex = barberIndex;
            },

            hideModal(val){
                this.showEditStateForm = val;
                this.barberToEditState = {};
                //this.barberIndex = -1;
            },

            updateBarberList(response){
                let message = '';

                if(response != 'clearBarber'){
                    this.peluqueriasPendientes.data.splice(this.barberIndex, 1, response);
                    message = 'Se actualizo el estado de la barbería';
                }else{
                    this.peluqueriasPendientes.data.splice(this.barberIndex, 1);
                    message = 'La barbería fue aceptada, verfica que este disponible en el explorador'
                }

                Swal.fire({
                    confirmButtonText: 'Cerrar',
                    confirmButtonColor: '#3b82f6',
                    icon: 'success',
                    title: message,
                });
            },

            getLink(peluqueriaID){
                return `/peluqueria/${peluqueriaID}/download_file`
            }
        }


    }
</script>
