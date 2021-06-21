<template>
    <breeze-authenticated-layout>
       <agendador :peluqueros="peluqueros" :peluqueria-id="peluqueriaId" :showAlert="true">
       </agendador>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import Agendador from '@/Components/Agendador';



    export default {
        props:{
            peluqueros:Object,
            peluqueriaId:{
                default: 0
            },
        },

        components: {
            BreezeAuthenticatedLayout, Agendador
        },
    }
</script>
