<template>
    <div class="bg-white shadow-md md:shadow-2xl rounded-lg p-2">
        <div class="flex justify-between my-2">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 mr-2">
                    <img class="h-10 w-10 rounded-full" :src="'/storage/'+ peluquero.imagen" alt="peluquero imagen" />
                </div>
                <div class="">
                    {{peluquero.nombre}}
                </div>
            </div>
            <div class="ml-2 float-left">
                <svg @click="cambiarEstado" class="fill-current" :class="{'cursor-pointer': cambiarPeluqueroEstado, 'text-info': peluquero.disponible, 'text-error-light': !peluquero.disponible}" xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 24 24" width="12px" fill="#000000"><path d="M24 24H0V0h24v24z" fill="none"/><circle cx="12" cy="12" r="8"/></svg>
            </div>
        </div>
        <div v-if="showStars">
            <rate :rate="peluquero.estrellas" max-rate=5 />
        </div>
        <div>
            <grey-button class="w-full mt-2 rounded-xl">
                Ver
            </grey-button>
        </div>
    </div>
</template>

<script>
import Rate from '@/Components/Rate'
import GreyButton from '@/Components/GreyButton'

export default {
    props: {
        peluquero: {
            default: {},
        },

        cambiarPeluqueroEstado: {
            default: false,
        },

        showStars: {
            default: true,
        }
    },

    components: {
        Rate, GreyButton,
    },

    emits: ['cambioEstado'],

    methods: {
        async cambiarEstado(){
            if(this.cambiarPeluqueroEstado){
                try{
                    this.peluqueroDisponible = !this.peluqueroDisponible
                    await axios.put('/peluqueria/cambiar_peluquero_estado/' + this.peluquero.id);
                }catch(error){
                    console.log(error);
                }
            }
        }
    },

    computed: {
        peluqueroDisponible:{
            set:function(val){
                this.$emit('cambioEstado', this.peluquero);
            },

            get:function(){
                return this.peluquero.disponible;
            }
        }
    }
}
</script>
