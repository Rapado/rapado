<template>
        <div  :class="classes" >

            <div @click="active = !active" class="cursor-pointer">
                Ver administradores
            </div>

            <modal v-if = "active" @close="active = false">
                <template v-slot:header>
                    Lista de Administradores
                </template>
                <template v-slot:body>
                    <div v-for="(admin, index) in administradores" :key="index">
                        <div class="flex justify-between">
                            <div class="m-3" v-text="admin.nombre" />
                            <div class="m-3">Código de acceso: {{admin.id}}  </div>
                        </div>
                    </div>
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
            administradores: []
        }
    },

    mounted (){
        axios.get('/admin/administradores')
        .then(response => {
            console.log(response.data.administradores)
            this.administradores = response.data.administradores;
        }).catch(err => {
            console.log(err);
        })
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
