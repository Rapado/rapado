<template>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <div class="grid xs:grid-cols-1 md:grid-cols-2 pt-2">
        <div class="px-2 md:px-5">
            <div class = "flex items-center justify-center">
                <inertia-link href="/">
                    <rapado-logo class="w-30 h-20 fill-current text-gray-500" />
                </inertia-link>
            </div>

            <div class="flex items-center justify-center mb-4">
                Bienvenido!
            </div>

            <login-form v-if="showLoginForm" :auth = "auth" :canResetPassword = "canResetPassword" loginUrl = "admin.login">
            </login-form>

            <register-form v-else formForModel = "admin" registerUrl = "admin.register">
            </register-form>

            <div class="h-16 md:h-32 flex flex-wrap content-end">
                <button-secondary @click="showLoginForm = !showLoginForm" class="mt-6 w-full text-center" style="text-align:center;" v-text="formToShowMessage"></button-secondary>
            </div>
        </div>
        <div class = "max-h-full md:max-h-96 ml-0 md:ml-2 pt-4 md:pt-0 w-full">
            <img src="/images/administrador.jpg" alt="imgen-administrador">
        </div>
    </div>
</template>

<script>
    import BreezeGuestLayout from "@/Layouts/Guest"
    import LoginForm from "@/Components/LoginForm"
    import RegisterForm from "@/Components/RegisterForm"
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    import rapadoLogo from '@/Components/ApplicationLogo.vue'
    import BreezeButton from '@/Components/Button'
    import ButtonSecondary from '@/Components/ButtonSecondary'

    export default {
        layout: BreezeGuestLayout,

        components: {LoginForm, RegisterForm, BreezeValidationErrors, rapadoLogo, BreezeButton, ButtonSecondary},

        props: {
            auth: Object,
            canResetPassword: Boolean,
            errors: Object,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                }),

                showLoginForm: true,
            }
        },

        computed: {
            formToShowMessage: function(){
                return this.showLoginForm ? 'Necesito una cuenta' : 'De echo, ya tengo una cuenta'
            }
        }
    }
</script>
