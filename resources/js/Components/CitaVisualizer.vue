<template>
    <div>
        <div @click="showCita" class = "mr-2 bg-secondary hover:bg-secondary-dark cursor-pointer rounded-full text-white text-center px-1 md:py-1">
            {{label}}
        </div>

        <modal v-if="showModal" @close="showModal = false">
            <template v-slot:header>
                <div class="flex">
                    <div class="mr-1"><svg class = "fill-current text-accent" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="18" fill="none" r="2"/><circle cx="12" cy="12" fill="none" r=".5"/><circle cx="6" cy="6" fill="none" r="2"/><path d="M9.64 7.64c.23-.5.36-1.05.36-1.64 0-2.21-1.79-4-4-4S2 3.79 2 6s1.79 4 4 4c.59 0 1.14-.13 1.64-.36L10 12l-2.36 2.36C7.14 14.13 6.59 14 6 14c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4c0-.59-.13-1.14-.36-1.64L12 14l7 7h3v-1L9.64 7.64zM6 8c-1.1 0-2-.89-2-2s.9-2 2-2 2 .89 2 2-.9 2-2 2zm0 12c-1.1 0-2-.89-2-2s.9-2 2-2 2 .89 2 2-.9 2-2 2zm6-7.5c-.28 0-.5-.22-.5-.5s.22-.5.5-.5.5.22.5.5-.22.5-.5.5zM19 3l-6 6 2 2 7-7V3z"/></svg></div>
                    <div class="mr-2">{{cita.peluquero}}</div>

                    <div class="mr-1"><svg class = "fill-current text-accent" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><circle cx="12" cy="4" r="2"/><path d="M15.89,8.11C15.5,7.72,14.83,7,13.53,7c-0.21,0-1.42,0-2.54,0C8.24,6.99,6,4.75,6,2H4c0,3.16,2.11,5.84,5,6.71V22h2v-6h2 v6h2V10.05L18.95,14l1.41-1.41L15.89,8.11z"/></g></g></svg></div>
                    <div class="mr-2">{{cita.nombreCliente}}</div>

                    <div class="mr-1"><svg class = "fill-current text-accent" enable-background="new 0 0 24 24" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M16.2,16.2L11,13V7h1.5v5.2l4.5,2.7L16.2,16.2z"/></g></g></g></svg></div>
                    <div>{{cita.duracion}} Min</div>
                </div>
            </template>
            <template v-slot:body>
                <span class="list-item" v-for="(servicio, index) in cita.servicios" :key="index">
                    <avatar :imagen = "'/storage/'+ servicio.imagen" :label = "servicio.nombre + ' $' + servicio.costo" rounded = "rounded-sm"/>
                </span>
            </template>
        </modal>
    </div>
</template>

<script>
import SecondaryButton from '@/Components/ButtonSecondary'
import Modal from '@/Components/Modal'
import Avatar from '@/Components/Avatar'

export default {
    components: {SecondaryButton, Modal, Avatar},

    props: {
        idCita: {
            default: null,
        },

        cita: {
            default: {},
        },

        label: {
            default: '',
        },
    },

    data(){
        return{
            showModal:false,
        }
    },

    methods:{
        showCita(){
            if(this.cita == {}){ // se tiene que consultar la cita
                this.consultarCita();
            }
            this.showModal = !this.showModal;
        },

        async consultarCita(){

        }
    }
}
</script>
