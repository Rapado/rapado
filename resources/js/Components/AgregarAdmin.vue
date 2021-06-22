<template>
        <div  :class="classes" >

            <div @click="active = !active">
                Agregar administrador
            </div>

            <modal v-if = "active" @close="active = false">
                <template v-slot:header>
                    Agregar Administrador
                </template>
                <template v-slot:body>
                    <form  @submit.prevent="submit">
                        <div class="flex">
                            <input-secondary type="text" class="mr-2 block w-full" v-model="nombreAdmin" required placeholder = "Nombre del administrador" autocomplete="username">
                            </input-secondary>
                            <grey-button >
                                registrar
                            </grey-button>
                        </div>
                    </form>
                </template>
            </modal>
        </div>
</template>

<script>
import BreezeNavLink from '@/Components/NavLink'
import Modal from '@/Components/Modal'
import InputSecondary from '@/Components/InputSecondary'
import GreyButton from './GreyButton.vue'
import toast from '@/mixins/toast.js'

export default {

    props: {
        route: {
            route: '',
        },
    },

    components: {
        BreezeNavLink, Modal, InputSecondary, GreyButton
    },

    mixins: [toast],

    data (){
        return{
            active: false,
            nombreAdmin: '',
        }
    },

    methods:{
        submit(){
            axios.post('/admin/create', {nombre: this.nombreAdmin})
            .then(response => {
                this.nombreAdmin = ''
                this.active = false;
                const msj = 'Administrador registrado, código de acceso: ' + response.data.adminId;
                this.mostrarAlerta(msj, 'success', 6000);
            }).catch(error => {
                this.mostrarAlerta('Error en el nombre, ingresa de 4 a 200 caracteres.', 'error', 4000);
            })
        }
    },

    computed: {
        classes() {
            return this.active
                        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-accent text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
        }
    }


}
</script>
