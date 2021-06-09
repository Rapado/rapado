<template>
    <breeze-authenticated-peluqueria-layout>
        <div class="md:py-10">
            <div v-if="firstTime" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-secondary overflow-hidden shadow-md sm:rounded-lg">
                    <div  class="py-2 border-b border-gray-200 text-center">
                        <div  class="flex gap-1 justify-center items-center ">
                            <div >
                                <svg class = "fill-current text-accent" xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 0 24 24" width="35px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="18" fill="none" r="2"/><circle cx="12" cy="12" fill="none" r=".5"/><circle cx="6" cy="6" fill="none" r="2"/><path d="M9.64 7.64c.23-.5.36-1.05.36-1.64 0-2.21-1.79-4-4-4S2 3.79 2 6s1.79 4 4 4c.59 0 1.14-.13 1.64-.36L10 12l-2.36 2.36C7.14 14.13 6.59 14 6 14c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4c0-.59-.13-1.14-.36-1.64L12 14l7 7h3v-1L9.64 7.64zM6 8c-1.1 0-2-.89-2-2s.9-2 2-2 2 .89 2 2-.9 2-2 2zm0 12c-1.1 0-2-.89-2-2s.9-2 2-2 2 .89 2 2-.9 2-2 2zm6-7.5c-.28 0-.5-.22-.5-.5s.22-.5.5-.5.5.22.5.5-.22.5-.5.5zM19 3l-6 6 2 2 7-7V3z"/></svg>
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
                    <div class="p-2 text-white bg-secondary-light border-b border-gray-200">
                        <div class="ml-3">
                           Agregar Servicio
                        </div>
                    </div>
                    <div class="py-1 mx-4 md:ml bg-white border-b border-gray-200">
                        <div class="grid grid-rows-1">
                            <div class="grid grid-cols-1 md:grid-cols-2">
                                <div id="form" class="mt-6">
                                    <form @submit.prevent = "submit" >
                                        <div class = "grid grid-rows-1">
                                            <div class = "grid grid-cols-2">
                                                <div class="">
                                                    <my-input type = "text" class="my-1 w-full" v-model="form.servicioNombre" placeholder="Nombre del servicio" />
                                                    <my-input type = "number" class="my-1 w-full" v-model="form.duracion" placeholder="Duración en minutos" />
                                                    <my-input type = "number" class="my-1 w-full" v-model="form.costo" placeholder="Costo en pesos mexicanos" />
                                                    <input-file class="w-auto" v-model="form.imagen" file-label = "Cargar imagen" />
                                                </div>
                                                <div>

                                                </div>
                                                </div>
                                                <div class="mt-2">
                                                    <gray-button class="mt-4 md:mt-0 w-full md:w-auto py-3" v-text="btnText" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                </gray-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id = "listaServicios" class="mt-6">
                                    <ul>
                                        <transition-group name="list" tag="p" >
                                            <span class="list-item" v-for="(peluquero, index) in peluquerosList" :key="index">
                                                <div class="flex items-center mt-2">
                                                    <div class="flex-shrink-0 h-10 w-10 mr-2">
                                                        <img class="h-10 w-10 rounded-full" :src="'/storage/'+ peluquero.imagen" alt="" />
                                                    </div>
                                                    <div class="w-5/12">
                                                        {{peluquero.nombre}}
                                                    </div>
                                                    <div id = "editar" class="ml-3">
                                                        <div class="flex cursor-pointer hover:text-secondary">
                                                            <svg v-if="isEditting && index == edittingIndex"  @click="editarPeluqueroReset()" class = "fill-current text-secondary-light hover:text-secondary"  xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                                                            <svg  v-else @click="editarPeluqueroSetUP(index)" class = "fill-current text-secondary-light hover:text-secondary" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                                        </div>
                                                    </div>
                                                    <div id = "ver" v-if="!firstTime" class="ml-3" >
                                                        <svg @click="verPeluquero(index)" class = "fill-current text-primary hover:text-primary-dark" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                                    </div>
                                                    <div id = "eliminar" v-if="firstTime" class="ml-3" >
                                                        <svg @click="eliminarPeluquero(index)" class = "fill-current text-error hover:text-accent-dark cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                                    </div>
                                                </div>
                                            </span>
                                        </transition-group>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex max-w-7xl mx-auto my-4 sm:px-6 lg:px-8 justify-end">
                <gray-button @click="nextStep" class="mt-3 mx-4 md:mx-0 md:mt-0 md:ml-4 w-full md:w-auto py-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Siguiente
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

    export default {
        props:{
            firstTime:{
                default: false,
            },

            peluqueros:{
                default: []
            },

            peluquero:{
                default: {}
            }
        },

        components: {
            BreezeAuthenticatedPeluqueriaLayout, MyInput, GrayButton, InputFile
        },

        data() {
            return {
                form: this.$inertia.form({
                    servicioNombre: null,
                    peluqueros: [],
                    duracion: null,
                    costo: null,
                    imagen: null,
                }),

                isEditting: false,
                edittingIndex: null,

                peluquerosList: []
            }
        },

        mounted() {
            this.peluquerosList = this.peluqueros;
        },

        methods: {
            submit(){
                !this.isEditting ? this.agregarPeluquero() : this.editarPeluquero();
            },

            agregarPeluquero(){
                // const data = new FormData();
                // data.append('imagen', this.form.imagen);
                // data.append('servicioNombre', this.form.servicioNombre);

                axios.post(this.route("servicio.store"), this.form)
                .then(response =>{
                    this.form.reset();
                   // this.peluquerosList.push(response.data.peluquero);
                }).catch(err =>{
                    console.log(err);
                })

            },

            editarPeluquero(){
                const id = this.peluquerosList[this.edittingIndex].id;
                const data = new FormData();
                data.append('imagen', this.form.imagen);
                data.append('servicioNombre', this.form.servicioNombre);

                axios.post(`/peluqueria/actualizar_peluquero/${id}`, data)
                .then(response => {
                    this.peluquerosList.splice(this.edittingIndex, 1, response.data.peluquero);
                    this.editarPeluqueroReset();
                }).catch(error => {
                    console.log(error);
                });

            },

            verPeluquero(peluquero){
                console.log(peluquero);
            },

            eliminarPeluquero(index){
                const id = this.peluquerosList[index].id;

                axios.delete(`/peluqueria/eliminar_peluquero/${id}`)
                .then(response => {
                    this.peluquerosList.splice(index, 1);
                }).catch(error => {
                    console.log(error);
                });

                this.isEditting ? this.editarPeluqueroReset() : null; //si dieron click en editar y no guardaron, podria haber errores
            },

            editarPeluqueroSetUP(index){
                this.isEditting = true;
                this.edittingIndex = index
                this.form.servicioNombre = this.peluquerosList[index].nombre;
            },

            editarPeluqueroReset(){
                this.isEditting = false;
                this.edittingIndex = null;
                this.form.servicioNombre = '';
                this.form.imagen = null;
            },

            nextStep(){
                location.reload();
            }


        },

        computed: {
            estado: function () {
                return this.peluqueriaEstado.data.estadoInfo.estado;
            },

            estadoRazon: function () {
                //return 'El documento que enviaste no pudo ayudarnos a validar la existencia de tu peluqueria, además fue buscada en maps y no nos dio un resultado.';
                return this.peluqueriaEstado.data.mensaje;
            },

            btnText: function(){
                return !this.isEditting ? 'Registrar' : 'Actualizar';
            }
        }

    }
</script>

<style >


    .list-enter-active,
    .list-leave-active {
         transition: all 1s ease;
    }

    .list-enter-from,
    .list-leave-to {
        opacity: 0;
        transform: translateY(30px);
    }
</style>
