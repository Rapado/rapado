<template>
    <breeze-authenticated-peluqueria-layout>
        <div class="md:py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 md:p-6 border-b border-gray-200 text-center">
                        <div class="text-xl">
                            Bienvenido
                        </div>

                        <div v-if="estado == 'enRevision'" class="md:flex gap-1 justify-center items-center mt-4 md:mt-3">
                            <div class="flex justify-center">
                                <svg class = "fill-current text-warning" xmlns="http://www.w3.org/2000/svg" height="37px" viewBox="0 0 24 24" width="37px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
                            </div>
                            <div class="w-full md:w-1/2 text-secondary-light text-justify md:text-center">
                                Tu solicitud ha sido enviada, se encuentra en estato de PROCESO una vez que sea aceptada prodra visualizarce en la plataforma.
                            </div>
                        </div>

                        <div v-else-if="estado == 'reenviarDoc'" class=" mt-4 md:mt-3">
                            <div class="md:flex gap-1 justify-center items-center">
                                <div class="flex justify-center">
                                    <svg class = "fill-current text-warning" xmlns="http://www.w3.org/2000/svg" height="37px" viewBox="0 0 24 24" width="37px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
                                </div>
                                <div class="w-full md:w-1/2 text-secondary-light text-justify md:text-center">
                                    Es necesario que reenvies tu documento. {{this.estadoRazon}}
                                </div>
                            </div>
                            <form @submit.prevent = "submit">
                                <div class = "md:flex gap-1 justify-center items-center mt-6">
                                        <input-file class="mt-1 w-auto" v-model="form.documento" file-label = "Logo de la peluquería" />
                                        <gray-button class="mt-4 md:mt-0 md:ml-4 py-3 w-full md:w-auto" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Subir documento
                                        </gray-button>
                                </div>
                            </form>
                        </div>

                        <div v-if="estado == 'rechazada'" class="md:flex gap-1 justify-center items-center mt-4 md:mt-3">
                            <div class="flex justify-center">
                                <svg class = "fill-current text-error" xmlns="http://www.w3.org/2000/svg" height="37px" viewBox="0 0 24 24" width="37px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
                            </div>
                            <div class="w-full md:w-1/2 text-error text-justify md:text-center">
                                No pudimos verificar la existencia de tu peluqueria. {{this.estadoRazon}}
                                <span>Si crees que se trata de un error, por favor ponte en contracto con nosotros.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-peluqueria-layout>
</template>

<script>
    import BreezeAuthenticatedPeluqueriaLayout from '@/Layouts/AuthenticatedPeluqueria'
    import InputFile from '@/Components/FileInput'
    import GrayButton from '@/Components/GreyButton'

    export default {
        props:['peluqueriaEstado', ],

        components: {
            BreezeAuthenticatedPeluqueriaLayout, InputFile, GrayButton
        },

        data() {
            return {
                form: this.$inertia.form({
                    documento: null
                })
            }
        },

        methods: {
            submit(){
                this.form.post(this.route("peluqueria.updateDoc"), {
                    onFinish: () => location.reload()
                });
            }
        },

        computed: {
            estado: function () {
                return this.peluqueriaEstado.data.estadoInfo.estado;
            },

            estadoRazon: function () {
                //return 'El documento que enviaste no pudo ayudarnos a validar la existencia de tu peluqueria, además fue buscada en maps y no nos dio un resultado.';
                return this.peluqueriaEstado.data.mensaje;
            }
        }

    }
</script>
