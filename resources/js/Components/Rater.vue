<template>
    <div class="flex items-center">

        <div v-for="(noEstrella, index) in rate" :key="index" class="m-0">
            <svg @click="actualizarEstrellas(noEstrella)" :class="noEstrella <= estrellas?'text-warning':'text-gray-400'" class="fill-current cursor-pointer hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="35px" viewBox="0 0 24 24" width="35px" fill="#000000"><g><rect fill="none" height="24" width="24" x="0"/><polygon points="14.43,10 12,2 9.57,10 2,10 8.18,14.41 5.83,22 12,17.31 18.18,22 15.83,14.41 22,10"/></g></svg>
        </div>
        <!---<div v-for="(noEstrella, index) in maxRate - rate" :key="index" class="m-1">
            <svg @click="estrellas=index-estrellas" fill-current text-secondary-light" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24" x="0"/><polygon points="14.43,10 12,2 9.57,10 2,10 8.18,14.41 5.83,22 12,17.31 18.18,22 15.83,14.41 22,10"/></g></svg>

        </div>--->
    </div>
</template>

<script>
export default {
    props: {
        rate: {
            default: 5,
        },
        maxRate: {
            default: null,
        },
        noPersonas:{
            default: 10,
        },
        modelValue: {
            default: 0,
        },
    },
    emits:[
        'update:modelValue'
    ],
    data() {
        return {
            estrellas: 0,
        }

    },
    methods:{
        actualizarEstrellas(noEstrellas){
            this.estrellas = noEstrellas;
            this.$emit('update:modelValue', noEstrellas);
        }

    }
}
</script>
