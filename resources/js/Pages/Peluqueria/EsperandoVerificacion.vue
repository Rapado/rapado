<template>
    <breeze-authenticated-peluqueria-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 text-center">
                        <div>
                            Bienvenido
                        </div>
                        <div class="flex justify-center gap-4 mt-4">
                            <div>
                                <svg class =  "fill-current text-error" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
                            </div>
                            <div class="w-1/2">
                                Tu solicitud ha sido enviada se encuentra en estato de PROCESO una vez que sera aceptada prodra visualizarce en la plataforma.
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

    export default {
        components: {
            BreezeAuthenticatedPeluqueriaLayout,
        },
    }
</script>
