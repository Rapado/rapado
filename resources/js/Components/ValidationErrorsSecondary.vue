<template>
    <div v-if="hasErrors">
        <div class="font-medium text-red-600">Datos no válidos.</div>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <div v-for="(campo, key) in errors" :key="key">
                <li v-for="(error, key) in campo" :key="key">{{ error }}</li>
            </div>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                return this.$page.props.errors
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        }
    }
</script>
