<template>
    <input class="border-gray-300 border-0 border-b-2 focus:border-blue-400 focus:border-b-opacity-25 focus:ring focus:ring-transparent " :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
    export default {
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

