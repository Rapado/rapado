<template>
    <breeze-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <breeze-label for="email" value="Correo electronico" />
            <secondary-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus placeholder = "nombre@email.com" autocomplete="username" />
        </div>

        <div class="mt-4">
            <breeze-label for="password" value="Contraseña" />
            <secondary-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" placeholder="**********" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <breeze-checkbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">Recuerdame</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                ¿Olvidaste tu contraseña?
            </inertia-link>

            <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Iniciar Sesión
            </breeze-button>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button'
import SecondaryInput from '@/Components/InputSecondary'
import BreezeCheckbox from '@/Components/Checkbox'
import BreezeLabel from '@/Components/Label'
import BreezeValidationErrors from '@/Components/ValidationErrors'

export default {

    components: {
        BreezeButton,
        SecondaryInput,
        BreezeCheckbox,
        BreezeLabel,
        BreezeValidationErrors
    },

    props: {
        auth: Object,
        canResetPassword: Boolean,
        loginUrl: String,
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
                .post(this.route(this.loginUrl), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    }

}
</script>
