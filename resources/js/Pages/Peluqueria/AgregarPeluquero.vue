<template>
    <breeze-authenticated-peluqueria-layout :hide-nav="firstTime">
        <div class="md:py-10">
            <div v-if="firstTime" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-secondary overflow-hidden shadow-md sm:rounded-lg">
                    <div  class="py-2 border-b border-gray-200 text-center">
                        <div  class="flex gap-1 justify-center items-center ">
                            <div >
                                <svg class = "fill-current text-accent" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="35px" viewBox="0 0 24 24" width="35px" fill="#000000"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><g><circle cx="10" cy="8" r="4"/><path d="M10.67,13.02C10.45,13.01,10.23,13,10,13c-2.42,0-4.68,0.67-6.61,1.82C2.51,15.34,2,16.32,2,17.35V20h9.26 C10.47,18.87,10,17.49,10,16C10,14.93,10.25,13.93,10.67,13.02z"/><path d="M20.75,16c0-0.22-0.03-0.42-0.06-0.63l1.14-1.01l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L18,11h-2l-0.3,1.49 c-0.4,0.15-0.76,0.36-1.08,0.63l-1.45-0.49l-1,1.73l1.14,1.01c-0.03,0.21-0.06,0.41-0.06,0.63s0.03,0.42,0.06,0.63l-1.14,1.01 l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L16,21h2l0.3-1.49c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1.01 C20.72,16.42,20.75,16.22,20.75,16z M17,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S18.1,18,17,18z"/></g></g></svg>
                            </div>
                            <div class="text-xl text-white">
                                Bienvenido
                            </div>
                        </div>
                        <div class="text-secondary-light md:text-center mt-2">
                            Tú peluquería esta lista para ser configurada. Comenzaremos por agregar a tus peluqueros.
                        </div>
                    </div>
                </div>
            </div>


            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <breeze-validation-errors class = "mb-2 ml-2"/>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-white bg-secondary-light border-b border-gray-200">
                        <div class="ml-3">
                           Agregar Peluqero
                        </div>
                    </div>
                    <div class="py-1 mx-4 md:ml bg-white border-b border-gray-200  pb-7">
                        <div class="mt-4 ml-0 md:ml-12 lg:ml-8">
                            <form @submit.prevent = "submit" >
                                <div class = "md:flex gap-1 items-end">
                                    <my-input type = "text" class="w-full md:w-auto mb-2 md:mb-0" v-model="form.peluqueroNombre" placeholder="Nombre del peluquero" />
                                    <input-file class="w-full md:w-auto" v-model="form.imagen" file-label = "Cargar imagen" />
                                    <gray-button class="w-full md:w-auto mt-1 md:mt-0 py-3" v-text="btnText" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    </gray-button>
                                </div>
                            </form>
                        </div>
                        <div class="mt-6">
                            <ul>
                                <transition-group name="list" tag="p" >
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mx-2 md:mx-0 justify-items-center">
                                    <span class="list-item mt-4 w-full md:w-9/12" v-for="(peluquero, index) in peluquerosList" :key="index">
                                        <peluquero-card :peluquero="peluquero" :cambiar-peluquero-estado="true" v-on:cambioEstado = "cambiarEstado">
                                            <template v-slot:actions>
                                                <div class="flex justify-center mt-1 md:mt-2">
                                                <div id = "ver" v-if="!firstTime" class="ml-3" >
                                                    <svg @click="verPeluquero(index)" class = "fill-current text-primary-dark hover:text-primary-darkest cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                                </div>
                                                <div id = "editar" class="ml-3">
                                                    <div class="cursor-pointer hover:text-secondary">
                                                        <svg v-if="isEditting && index == edittingIndex"  @click="editarPeluqueroReset()" class = "fill-current text-secondary-light hover:text-secondary"  xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                                                        <svg  v-else @click="editarPeluqueroSetUP(index)" class = "fill-current text-secondary-light hover:text-secondary" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                                    </div>
                                                </div>
                                                <div id = "eliminar" class="ml-3" >
                                                    <svg @click="eliminarPeluquero(index)" class = "fill-current text-error hover:text-accent-dark cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                                </div>
                                                </div>
                                            </template>
                                        </peluquero-card>
                                    </span>
                                    </div>
                                </transition-group>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if= "firstTime" class="flex max-w-7xl mx-auto my-4 sm:px-6 lg:px-8 justify-end">
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
    import PeluqueroCard from '@/Components/PeluqueroCard'
    import BreezeValidationErrors from '@/Components/ValidationErrorsSecondary'

    export default {
        props:{
            firstTime:{
                default: false,
            },

            peluqueros:{
                default: {data:[]}
            },

            peluquero:{
                default: {}
            }
        },

        components: {
            BreezeAuthenticatedPeluqueriaLayout, MyInput, GrayButton, InputFile, BreezeValidationErrors, PeluqueroCard
        },

        data() {
            return {
                form: this.$inertia.form({
                    peluqueroNombre: null,
                    imagen: null
                }),

                isEditting: false,
                edittingIndex: null,

                peluquerosList: []
            }
        },

        mounted() {
            this.peluquerosList = this.peluqueros.data;
        },

        methods: {
            submit(){
                !this.isEditting ? this.agregarPeluquero() : this.editarPeluquero();
            },

            agregarPeluquero(){
                this.$page.props.errors = []; //su hubo errores antees, se borran

                const data = new FormData();
                data.append('imagen', this.form.imagen);
                data.append('peluqueroNombre', this.form.peluqueroNombre);

                axios.post(this.route("peluquero.store"), data)
                .then(response =>{
                    this.form.reset();
                    this.peluquerosList.push(response.data.peluquero);
                }).catch(err =>{
                    this.$page.props.errors = err.response.data.errors;
                })

            },

            editarPeluquero(){
                this.$page.props.errors = []; //su hubo errores antees, se borran

                const id = this.peluquerosList[this.edittingIndex].id;
                const data = new FormData();
                data.append('imagen', this.form.imagen);
                data.append('peluqueroNombre', this.form.peluqueroNombre);

                axios.post(`/peluqueria/actualizar_peluquero/${id}`, data)
                .then(response => {
                    this.peluquerosList.splice(this.edittingIndex, 1, response.data.peluquero);
                    this.editarPeluqueroReset();
                }).catch(error => {
                    this.$page.props.errors = error.response.data.errors;
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
                this.form.peluqueroNombre = this.peluquerosList[index].nombre;
            },

            editarPeluqueroReset(){
                this.isEditting = false;
                this.edittingIndex = null;
                this.form.peluqueroNombre = '';
                this.form.imagen = null;
            },

            nextStep(){
                location.reload();
            },

            cambiarEstado(peluquero){
                peluquero.disponible = !peluquero.disponible
            }
        },

        computed: {
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
