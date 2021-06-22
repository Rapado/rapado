<template>
    <div class="flex gap-5 md:gap-10 justify-center">
        <div>
            <svg class = "mx-auto fill-current" :class="opcionesElegidas.tienePeluquero ? 'text-info-dark' : 'text-secondary'" xmlns="http://www.w3.org/2000/svg"  height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>

            <animated-text :show="currentStep == 1" class="text-secondary-light text-xs md:text-base">
                Escoge tu peluquero
            </animated-text>
        </div>
        <div>
            <svg class = "mx-auto fill-current" :class="opcionesElegidas.tieneServicios ? 'text-info-dark' : 'text-secondary'" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="18" fill="none" r="2"/><circle cx="12" cy="12" fill="none" r=".5"/><circle cx="6" cy="6" fill="none" r="2"/><path d="M9.64 7.64c.23-.5.36-1.05.36-1.64 0-2.21-1.79-4-4-4S2 3.79 2 6s1.79 4 4 4c.59 0 1.14-.13 1.64-.36L10 12l-2.36 2.36C7.14 14.13 6.59 14 6 14c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4c0-.59-.13-1.14-.36-1.64L12 14l7 7h3v-1L9.64 7.64zM6 8c-1.1 0-2-.89-2-2s.9-2 2-2 2 .89 2 2-.9 2-2 2zm0 12c-1.1 0-2-.89-2-2s.9-2 2-2 2 .89 2 2-.9 2-2 2zm6-7.5c-.28 0-.5-.22-.5-.5s.22-.5.5-.5.5.22.5.5-.22.5-.5.5zM19 3l-6 6 2 2 7-7V3z"/></svg>
            <animated-text :show="currentStep == 2" class="text-secondary-light text-xs md:text-base">
                Escoge tus servicios
            </animated-text>
        </div>
        <div>
            <svg class = "mx-auto fill-current" :class="opcionesElegidas.horaCita ? 'text-info-dark' : 'text-secondary'" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M16.2,16.2L11,13V7h1.5v5.2l4.5,2.7L16.2,16.2z"/></g></g></g></svg>
            <animated-text :show="currentStep == 3" class="text-secondary-light text-xs md:text-base">
                Escoge tu horario
            </animated-text>
        </div>
        <div>
            <svg class = "mx-auto fill-current" :class="opcionesElegidas.citaConfirmada ? 'text-info-dark' : 'text-secondary'" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            <animated-text :show="currentStep == 4" class="text-secondary-light text-xs md:text-base">
                Confirma tu cita
            </animated-text>
        </div>
    </div>
</template>

<script>
import AnimatedText from './AnimatedText.vue'

export default {

    components: { AnimatedText },

    props: {
        currentStep:{
            default: 0
        },
        opcionesElegidas:{
            default: {}
        }
    },
}
</script>
