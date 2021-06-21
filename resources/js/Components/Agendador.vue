<template>
        <div class="py-2 md:py-6 lg:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="lg:flex w-full">
                    <div class="lg:w-10/12 mx-2" id = "stepper">
                        <div class="lg:h-full h-50 min-h-full  bg-white overflow-hidden shadow-xl lg:shadow-sm rounded-lg">
                            <div class="p-6 bg-white">
                                <div id = "header">
                                    <steper-header :current-step="currentStep" :opciones-elegidas = "opcionesElegidas">
                                    </steper-header>
                                </div>

                                <div id="body">

                                    <div v-if="currentStep == 1" id="peluqueros">
                                        <div class="grid grid-rows-1 w-full justify-items-center ml-4 md:ml-0">
                                        <div class="w-full lg:w-10/12 mt-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:justify-items-center">
                                            <div v-for="(peluquero, index) in peluqueros.data" :key="index">
                                                <selector v-if="peluquero.disponible" selector v-on:update:model-value="actualizarPeluquero($event, index)" class="mt-2 w-auto" :model-value="peluquero.selected" :value="peluquero.nombre" :icon="'/storage/'+ peluquero.imagen" />
                                                <avatar v-else :label="peluquero.nombre" :imagen="'/storage/' + peluquero.imagen" class="mt-2 w-auto"/>
                                                <span class ="text-secondary-light text-xs text-center" v-text = "primerEspacioDisponible(peluquero)" />
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div v-if="currentStep == 2" id="servicios">
                                        <div class="grid grid-rows-1 w-full justify-items-center ml-4 md:ml-0">
                                        <div class="w-full md:w-9/12 lg:w-2/3 mt-5 grid grid-cols-1 md:grid-cols-3 md:justify-items-center">
                                            <div  v-for="(servicio, index) in servicios" :key="index">
                                                <selector class="mt-2 w-auto"  v-model="servicio.selected" :value="servicio.nombre" :icon="'/storage/'+ servicio.imagen" />
                                                <span class ="text-secondary-light text-xs text-center">Duración: {{servicio.duracion}} minutos</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div v-if="currentStep == 3" id="agenda">
                                        <div class="grid grid-rows-1 w-full justify-items-center">
                                        <div class="w-full md-1/2 lg:w-1/2 mt-5 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 md:justify-items-center gap-1">
                                            <div  v-for="(espacio, index) in agenda" :key="index">
                                                <div v-if="duracionCita <= espacio.minutosDisponibles" @click="actualizarHoraCita(!espacio.selected, index)" :class="!espacio.selected ? 'bg-secondary' : 'bg-secondary-light'" class="w-full mr-2  hover:bg-secondary-dark cursor-pointer rounded-full text-white text-center px-2 md:py-1">
                                                    {{espacio.hora.substring(0, 5)}}
                                                </div>
                                                <div v-else class="">
                                                    <div  class="w-full flex justify-between mr-2 bg-warning rounded-full text-white text-center px-2 md:py-1">
                                                    <div>
                                                        {{espacio.hora.substring(0, 5)}}
                                                    </div>
                                                    <div class="hidden md:block"><info>Tiempo insuficiente, quita algun servicio</info></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div id = "footer" class="flex justify-center mt-10">
                                    <div v-if="!citaAgendada">
                                        <gray-button @click="currentStep--" class="mr-2" :disabled = "!canBack">Anterior</gray-button>
                                        <gray-button @click="currentStep++" :disabled = "!canNext">Siguiente</gray-button>
                                    </div>
                                    <div v-else>
                                        <gray-button @click="nuevaCita" class="mr-2">Nueva cita</gray-button>
                                        <gray-button @click="irAincio">Inicio</gray-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 w-full lg:w-1/4">
                        <div class="mx-2 h-full bg-white rounded-xl shadow-2xl pb-2">
                            <div id="header" class="bg-secondary shadow-2xl rounded-t-lg p-2">
                                <div class=" text-white text-lg text-center">
                                    Tu cita
                                </div>
                            </div>
                            <div id="body" class = "ml-2 mt-2">
                                <avatar class="" v-if="hayPeluqueroSeleccionado" :label="peluqueroSeleccionado.nombre" :imagen="'/storage/' + peluqueroSeleccionado.imagen"/>
                            </div>

                            <div id="body" class = "ml-2 mt-2">
                                <div  v-for="(servicio, index) in serviciosEscogidos" :key="index">
                                    <div class="flex items-center ml-2 mt-2 ">
                                        <div class="bg-accent-dark py-1 px-2 mr-2 rounded-full text-white text-xs" v-text="index + 1" />
                                        <span class="text-secondary-light" v-text="servicio.nombre" />
                                    </div>
                                </div>
                            </div>

                             <div v-if="hayCitaSeleccionada" class="mx-4 my-2">
                                <div class="ml-1 text-secondary">
                                    Hora {{horaCita.hora.substring(0,5)}}
                                </div>
                            </div>

                             <div v-if="serviciosEscogidos.length > 0" class="mx-4 mt-2 mb-2">
                                <div class="ml-1 text-secondary">
                                    $total {{costoCita.toFixed(2)}}
                                </div>
                            </div>

                            <div v-if="!hayPeluqueroSeleccionado" class="mx-4">
                                <secondary-button class="w-full ">
                                    Buscame un lugar
                                </secondary-button>
                            </div>
                            <div v-if="hayCitaSeleccionada && !citaAgendada" class="mx-4">
                                <secondary-button @click="submit" class="w-full ">
                                    Confirmar
                                </secondary-button>
                            </div>
                            <div class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div v-if="showAlert" class="md:flex  gap-1 justify-center items-center mx-2 mt-4 md:mt-5">
                    <div class = "flex justify-center">
                        <svg class = "fill-current text-warning" xmlns="http://www.w3.org/2000/svg" height="37px" viewBox="0 0 24 24" width="37px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
                    </div>
                    <div class=" w-full md:w-1/2 text-secondary-light text-justify md:text-center">
                        Puedes cancelar en cualquier momento, sin embargo, recomendamos hacerlo con 15 minutos de anticipación.
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import SecondaryButton from '@/Components/ButtonSecondary'
    import SteperHeader from '@/Components/SteperHeader'
    import GrayButton from '@/Components/GreyButton'
    import Selector from '@/Components/Selector'
    import Avatar from '@/Components/Avatar'
    import toast from '@/mixins/toast.js'
    import Info from '@/Components/Info'

    export default {
        components: {
            BreezeAuthenticatedLayout, SteperHeader, GrayButton, SecondaryButton, Selector, Avatar, Info
        },

        props:{
            peluqueros:Object,
            peluqueriaId:{
                default: 0
            },
            urlPost:{
                default: '/agendar/'
            },
            showAlert:{
                default:true
            }
        },

        data () {
            return {
                currentStep: 1,
                peluqueroSelectedIndex: null,
                horaCitaIndex: null,
                citaAgendada: false,
            }
        },

        mixins: [toast],

        methods:{

            submit(){
                axios.post(this.urlPost + this.peluqueriaId, this.buildForm())
                .then(response => {
                    this.citaAgendada = true;
                    console.log('respuesta', response.data);
                    this.mostrarAlerta('Se agendo tu cita',  'success');
                })
                .catch(error => {
                    console.log(error.response.data.status);
                    if(error.response.data.status == 'horaNoDisponible'){
                        this.mostrarAlerta('Ya se ocupo el lugar, elige otro por favor', 'error', 5000);
                        this.actualizarInformacionPorCitaOcupada(error.response.data.peluqueros);
                    }
                    else if(error.response.data.status == 'peluqeroNoDisponible'){
                        this.mostrarAlerta('Parece que el peluquero no esta en servicio', 'warning', 5000);
                        this.actualizarInformacionPorPeluquerOff();
                    }else if(error.response.data.status == 'noCitasExcedido')
                        this.mostrarAlerta('No puedes tener mas de 2 citas agendadas', 'error', 5000);
                });
            },

            buildForm(){
                return ({
                    peluqueroId: this.peluqueroSeleccionado.id,
                    horaCita: this.horaCita.hora,
                    duracionCita: this.duracionCita,
                    nombreCliente: this.$page.props.auth.userName,
                    servicios: this.serviciosEscogidos.map(servicio => servicio.id)
                });
            },

            actualizarPeluquero(estado, index){
                if(estado && this.hayPeluqueroSeleccionado){
                    this.peluqueroSeleccionado.selected = false;
                    this.peluqueroSelectedIndex = null;
                }

                if(estado){
                    this.peluqueros.data[index].selected = true;
                    this.peluqueroSelectedIndex = index;
                    this.currentStep = 2;
                }else{
                    this.peluqueros.data[index].selected = false;
                    this.peluqueroSelectedIndex = null;
                }

            },

            actualizarHoraCita(estado, index){
                if(estado && this.hayCitaSeleccionada){
                    this.horaCita.selected = false;
                    this.horaCitaIndex = null;
                }

                if(estado){
                    this.agenda[index].selected = true;
                    this.horaCitaIndex = index;
                    this.currentStep = 4;
                }else{
                    this.horaCita.selected = false;
                    this.horaCitaIndex = null;
                }
            },

            actualizarInformacionPorCitaOcupada(peluqueros){
                this.currentStep = 3;
                this.actualizarHoraCita(false, this.horaCitaIndex);

                peluqueros.forEach((element, index) => {
                    this.peluqueros.data[index].agenda = element.agenda
                });
            },

            actualizarInformacionPorPeluquerOff(){
                this.currentStep = 1;
                this.actualizarHoraCita(false, this.horaCitaIndex);
                this.actualizarPeluquero(false, this.peluqueroSelectedIndex);
            },

            primerEspacioDisponible(peluquero){
                if(!peluquero.disponible)
                    return 'No esta trabajando';

                const esp = this.getPrimerEspacioDisponible(peluquero);
                return esp != undefined ? `${esp.minutosDisponibles} minutos disponibles a las ${esp.hora.substring(0,5)} ` : 'No tiene espacios disponibles';
            },

            getPrimerEspacioDisponible(peluquero){
                return peluquero.agenda.find(espacio => !espacio.ocupado);
            },

            nuevaCita(){
                window.location.reload();
            },

            irAincio(){
                window.location = '/dashboard';
            }
        },

        computed: {
            peluqueroSeleccionado: function(){
                return this.hayPeluqueroSeleccionado ? this.peluqueros.data[this.peluqueroSelectedIndex] : {}
            },

            hayPeluqueroSeleccionado: function(){
                return this.peluqueroSelectedIndex != null
            },

            servicios: function(){
                return this.hayPeluqueroSeleccionado ? this.peluqueroSeleccionado.servicios : [];
            },

            serviciosEscogidos(){
                return this.servicios.length > 0 ? this.servicios.filter(servicio => servicio.selected) : [];
            },

            agenda(){
                return this.hayPeluqueroSeleccionado ? this.peluqueroSeleccionado.agenda.filter(espacio => !espacio.ocupado) : []
            },

            horaCita(){
                return this.hayCitaSeleccionada ? this.agenda[this.horaCitaIndex] : '';
            },

            hayCitaSeleccionada(){
                return this.horaCitaIndex != null;
            },

            duracionCita(){
                const reducer = (acumulador, valorActual) => acumulador + valorActual.duracion;
                return this.serviciosEscogidos.reduce(reducer, 0);
            },

            costoCita(){
                const reducer = (acumulador, valorActual) => acumulador + parseInt(valorActual.costo);
                return this.serviciosEscogidos.reduce(reducer, 0);
            },

            opcionesElegidas: function(){
                return {tienePeluquero: this.hayPeluqueroSeleccionado, tieneServicios: this.serviciosEscogidos.length > 0, horaCita: this.hayCitaSeleccionada, citaConfirmada: this.citaAgendada}
            },

            canNext: function(){
                switch (this.currentStep) {
                    case 1:
                        return this.hayPeluqueroSeleccionado;
                    case 2:
                        return this.serviciosEscogidos.length > 0;
                    case 3:
                        return this.hayCitaSeleccionada;
                }
            },

            canBack: function(){
                return this.currentStep > 1
            },
        },
    }
</script>
