<template>
    <breeze-authenticated-peluqueria-layout>
        <div class="py-0 md:py-12">
            <div class="max-w-7xl mx-auto px-0 sm:px-6 lg:px-8">
                <breeze-validation-errors/>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-6 py-2 bg-secondary border-b border-gray-200 text-white text-center">
                        Necesitamos un poco más de información, una vez la subas revisaremos la solicitud y te notificaremos el avance.
                    </div>
                    <div class="p-6 items-center">
                        <div class="flex gap-4">
                            <div id="image" class="hidden md:block">
                                <img style = "width: 30vw; height: 35vh;" src = "/svgs/girl_form.svg" onerror="this.onerror=null; this.src='image.png'">
                            </div>
                            <div id="form">
                                <form @submit.prevent="submit">
                                    <div class="grid flex gap-4 justify-center">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <breeze-label for="encargado" value="Encargado de la peleluqería" class="text-green" />
                                                <secondary-input  id="encargado" type="text" class="mt-1 block w-full" v-model="form.encargado" required autofocus placeholder = "Pedro Fernandez" autocomplete="encargado" />
                                            </div>
                                            <div >
                                                <breeze-label for="ciudad" value="Ciudad" />
                                                <secondary-input id="ciudad" type="text" class="mt-1 block w-full" v-model="form.ciudad" required/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <breeze-label for="calle" value="Calle" />
                                                <secondary-input  id="calle" type="text" class="mt-1 block w-full" v-model="form.calle" required autofocus placeholder = "5 de Mayo" autocomplete="calle" />
                                            </div>
                                            <div >
                                                <breeze-label for="numero" value="Numero" />
                                                <secondary-input id="numero" type="number" class="mt-1 block w-full" v-model="form.numero" placeholder="Numero del local" required/>
                                            </div>
                                        </div>
                                        <div id = "documentos" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <file-input  id="documento"  class="mt-1 w-full" v-model="form.documento" file-label = "Documento o Foto" required/>
                                                <span class="text-secondary-light">Documento o foto que compruebe la existencia de tu peluquería</span>
                                            </div>
                                            <div >
                                                <file-input id="logo" class="mt-1 w-full" v-model="form.logo" file-label = "Logo de la peluquería" required/>
                                                <span class="text-secondary-light">Necesitamos que tu perfil se vea más llamativo</span>
                                            </div>
                                        </div>
                                        <div class="flex items-right justify-end mt-4">
                                            <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Guardar datos
                                            </breeze-button>
                                        </div>
                                    </div>
                                </form>
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
    import BreezeButton from '@/Components/GreyButton'
    import SecondaryInput from '@/Components/InputSecondary'
    import FileInput from '@/Components/FileInput'
    import BreezeCheckbox from '@/Components/Checkbox'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    export default {
        components: {
            BreezeAuthenticatedPeluqueriaLayout,
            BreezeButton,
            SecondaryInput,
            BreezeCheckbox,
            BreezeLabel,
            BreezeValidationErrors,
            FileInput
        },

        data() {
            return {
                form: this.$inertia.form({
                    encargado: '',
                    ciudad: '',
                    calle: '',
                    numero: '',
                    documento: null,
                    logo: null
                })
            }
        },

        methods: {
            submit() {
                    this.form.post(this.route('peluqueria.completarInfo'));
                }
            }

    }
</script>
