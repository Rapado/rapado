<template>
    <breeze-validation-errors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <div class="mb-4">
        Bienvenido Seguro habrá muchos cortes!
    </div>

    <login-form :auth = "auth" :canResetPassword = "canResetPassword" loginUrl = "peluqueria.login">
    </login-form>

</template>

<script>
    import BreezeGuestLayout from "@/Layouts/Guest"
    import LoginForm from "@/Components/LoginForm"
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    export default {
        layout: BreezeGuestLayout,

        components: {LoginForm, BreezeValidationErrors},

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
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('peluqueria.login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
