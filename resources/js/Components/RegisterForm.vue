<template>
    <breeze-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
        <div v-if="formForModel == 'cliente'">
            <breeze-label for="nameClient" value="Nombre" />
            <secondary-input id="nameClient" type="text" class="mt-1 block w-full" v-model="form.nameClient" required autofocus autocomplete="nameClient" />
        </div>

        <div v-else-if="formForModel == 'peluqueria'">
            <breeze-label for="nombrePeluqueria" value="Nombre de la peluqueria" />
            <secondary-input id="nombrePeluqueria" type="text" class="mt-1 block w-full" v-model="form.nombrePeluqueria" required autofocus autocomplete="nombrePeluqueria" placeholder="" />
        </div>

        <div v-else>
            <breeze-label for="codigoDeAcceso" value="Código de acceso" />
            <secondary-input id="codigoDeAcceso" type="text" class="mt-1 block w-full" v-model="form.codigoDeAcceso" required autofocus autocomplete="codigoDeAcceso" />
        </div>

        <div class="mt-4" v-if="formForModel == 'cliente'">
            <breeze-label for="numeroCelular" value="Numero celular" />
            <secondary-input id="numeroCelular" type="number" class="mt-1 block w-full" v-model="form.numeroCelular" required autocomplete="numeroCelular" />
        </div>

        <div class="mt-4" v-else-if="formForModel == 'peluqueria'">
            <breeze-label for="numeroLocal" value="Telefono del local" />
            <secondary-input id="numeroLocal" type="number" class="mt-1 block w-full" v-model="form.numeroLocal" required autocomplete="numeroLocal" />
        </div>

        <div class="mt-4">
            <breeze-label for="email" value="Correo" />
            <secondary-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="mt-4">
                <breeze-label for="password" value="Contraseña" />
                <secondary-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4 ml-0 md:ml-2">
                <breeze-label for="password_confirmation" value="Confirma tu contraseña" />
                <secondary-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Registrarme
            </breeze-button>
        </div>
    </form>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from '@/Layouts/Guest'
    import SecondaryInput from '@/Components/InputSecondary'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    export default {
        layout: BreezeGuestLayout,

        components: {
            BreezeButton,
            SecondaryInput,
            BreezeLabel,
            BreezeValidationErrors,
        },

        props: {
            formForModel: String,
            registerUrl: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    nameClient: '',
                    email: '',
                    codigoDeAcceso: '',
                    numeroLocal: '',
                    numeroCelular: '',
                    nombrePeluqueria: '',
                    barberName: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route(this.registerUrl), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
