<template>
    <breeze-authenticated-layout>

        <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center" >
                            <div class="w-80 " style="display: inline-block">
                                <img class="rounded-md"  @click="Peluqueria(peluquerias.data.id) " :src="'/storage/'+peluquerias.data.logo" alt="" />
                            </div>

                            <div class="align-top m-8 text-left" style="display: inline-block">
                                <div class="justify-items-stretch text-2xl ">
                                    {{peluquerias.data.nombre}}
                                </div>
                                <div class="mt-4">
                                    <div  style="display: inline-block" v-for="i in peluquerias.data.estrellas" :key="i">
                                        <svg enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107"/></svg>
                                    </div>
                                </div>
                                <div >
                                    Direccion: {{peluquerias.data.direccion}}
                                </div>
                                <div>
                                    Telefono: {{peluquerias.data.telefono}}
                                </div>
                                <div v-if="peluquerias.data.horario!=null">
                                    <div class="my-8 text-center" v-if="peluquerias.data.horario.horaActual>peluquerias.data.horario.apertura && peluquerias.data.horario.horaActual<peluquerias.data.horario.cierre">
                                        <btn-gris @click="Agendar(peluquerias.data.id) ">Agendar</btn-gris>
                                    </div>
                                    <div class="my-8 text-center text-red-600" v-else>
                                        Peluquería Cerrada
                                    </div>
                                </div>
                                <div class="my-8 text-center text-red-600" v-else>
                                        Peluquería Cerrada
                                </div>
                            </div>
                            <div style="display: inline-block" class = "text-right align-top">
                                <div class="my-8" v-if="!esFavorita" >
                                    <svg @click="AgregarFavoritos(peluquerias.data.id)" class = " fill-current text-secondary hover:text-error cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FC0000"><path d="M0 0h24v24H0z" fill="none"/><path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"/></svg>
                                </div>
                                <div class="my-8"  v-else>
                                    <svg @click="QuitarFavoritos" class = "fill-current text-error cursor-pointer hover:text-error-light" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200">
                            <div class="grid justify-items-stretch text-2xl">
                                Peluqueros
                            </div>
                            <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center" >
                                <div class="overflow-hidden shadow-sm  m:2" v-for="(peluquero,index) in peluquerias.data.peluqueros" :key="index" style="display: inline-block">
                                    <div  class="m-8">
                                        <div class="" style="display: inline-block">
                                            <img class=" rounded-full h-20 w-20 flex items-center justify-center" :src="'/storage/'+peluquero.imagen" alt="" />
                                        </div>
                                        <div class="align-top ml-8 mt-8" style="display: inline-block">
                                            <div class="justify-items-stretch text-2xl">
                                                {{peluquero.nombre}}
                                            </div>

                                        </div>
                                        <div class="align-top ml-8 mt-8" style="display: inline-block">
                                                <div  style="display: inline-block" v-for="i in peluquero.estrellas" :key="i">
                                                    <svg enable-background="new 0 0 16 16" height="16" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107"/></svg>
                                                </div>
                                            </div>
                                        <div style="display: inline-block" class="text-right align-top">
                                            <div v-if="peluquero.disponible === 1">
                                                <div class="rounded-full h-2 w-2 bg-green-500"></div>
                                            </div>
                                            <div v-else>
                                                <div class="rounded-full h-2 w-2 bg-red-500"></div>
                                            </div>
                                        </div>
                                        <div class="  text-center">
                                            <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center" >
                                                <form action class="form" @submit.prevent="EvaluarPeluquero(peluquerias.data.id,peluquero.id, index)">
                                                    <div class="grid justify-items-stretch text-xs " >
                                                        Da tu opinión a los demás
                                                    </div>
                                                    <div style="display: inline-block">

                                                    <rater v-model="form.estrellas" > </rater>
                                                    </div>
                                                    <div >
                                                        <breeze-button class=" cursor-pointer" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                            Evaluar
                                                        </breeze-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200">
                            <div class="grid justify-items-stretch text-2xl">
                                Servicios
                            </div>
                            <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center">
                                <td v-for="(servicio,index) in peluquerias.data.servicios" :key="index" style="display: inline-block">
                                            <div >
                                                <div class="text-center text-2xl">
                                                        {{servicio.nombre}}
                                                </div>
                                                <div class="">
                                                    <div>
                                                        <img class="h-44 w-52 rounded-md" :src="'/storage/'+servicio.imagen" alt="" />
                                                    </div>
                                                    <div class="text-center">
                                                        Duracion {{servicio.duracion}} minutos
                                                    </div>
                                                    <div class="text-center">
                                                        $ {{servicio.costo}}
                                                    </div>
                                                </div>
                                            </div>

                                </td>
                            </div>
                        </div>
                        <div class="p-6 bg-white text-secondary-light border-b border-gray-200 shadow-sm">
                            <div class="grid justify-items-stretch text-2xl ">
                                Reseñas
                            </div>
                            <div class=" m-8 text-center">
                                <div class="grid justify-items-stretch text-xl text-gray-700">
                                    Valora a {{peluquerias.data.nombre}}
                                </div>
                                <div class="grid justify-items-stretch text-xs ">
                                    Da tu opinion a los demas
                                </div>
                                <div class="  text-center">
                                    <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center" >
                                        <form action class="form" @submit.prevent="Evaluar(peluquerias.data.id)">

                                            <div style="display: inline-block">
                                                <rater v-model="form.estrellas" > </rater>
                                            </div>
                                            <div>
                                            <input
                                                v-model="form.comentario"
                                                class="border-2 border-gray-300 bg-white h-20 w-1/2 px-5 pr-16 mt-2 rounded-lg text-sm "
                                                type="text-box"
                                                id="comentario"
                                                name="comentario"
                                                placeholder="Comparte con otros usuarios tu experiencia...">
                                            </div>
                                            <div>
                                                <breeze-button class="m-4 cursor-pointer" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                    Evaluar
                                                </breeze-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 bg-white text-secondary-light border-b border-gray-200 text-center" >
                                <div class="overflow-hidden shadow-sm  m:2" v-for="(comentario,index) in peluquerias.data.evaluaciones" :key="index" style="display: inline-block">
                                    <div class="grid justify-items-stretch">
                                        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
                                            <div class=" w-72 my-4 text-left">
                                                <div style="display: inline-block">
                                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        viewBox="0 0 53 53" height="40" style="enable-background:new 0 0 53 53; " xml:space="preserve">
                                                        <path style="fill:#E7ECED;" d="M18.613,41.552l-7.907,4.313c-0.464,0.253-0.881,0.564-1.269,0.903C14.047,50.655,19.998,53,26.5,53
                                                            c6.454,0,12.367-2.31,16.964-6.144c-0.424-0.358-0.884-0.68-1.394-0.934l-8.467-4.233c-1.094-0.547-1.785-1.665-1.785-2.888v-3.322
                                                            c0.238-0.271,0.51-0.619,0.801-1.03c1.154-1.63,2.027-3.423,2.632-5.304c1.086-0.335,1.886-1.338,1.886-2.53v-3.546
                                                            c0-0.78-0.347-1.477-0.886-1.965v-5.126c0,0,1.053-7.977-9.75-7.977s-9.75,7.977-9.75,7.977v5.126
                                                            c-0.54,0.488-0.886,1.185-0.886,1.965v3.546c0,0.934,0.491,1.756,1.226,2.231c0.886,3.857,3.206,6.633,3.206,6.633v3.24
                                                            C20.296,39.899,19.65,40.986,18.613,41.552z"/>
                                                        <g>
                                                            <path style="fill:#556080;" d="M26.953,0.004C12.32-0.246,0.254,11.414,0.004,26.047C-0.138,34.344,3.56,41.801,9.448,46.76
                                                                c0.385-0.336,0.798-0.644,1.257-0.894l7.907-4.313c1.037-0.566,1.683-1.653,1.683-2.835v-3.24c0,0-2.321-2.776-3.206-6.633
                                                                c-0.734-0.475-1.226-1.296-1.226-2.231v-3.546c0-0.78,0.347-1.477,0.886-1.965v-5.126c0,0-1.053-7.977,9.75-7.977
                                                                s9.75,7.977,9.75,7.977v5.126c0.54,0.488,0.886,1.185,0.886,1.965v3.546c0,1.192-0.8,2.195-1.886,2.53
                                                                c-0.605,1.881-1.478,3.674-2.632,5.304c-0.291,0.411-0.563,0.759-0.801,1.03V38.8c0,1.223,0.691,2.342,1.785,2.888l8.467,4.233
                                                                c0.508,0.254,0.967,0.575,1.39,0.932c5.71-4.762,9.399-11.882,9.536-19.9C53.246,12.32,41.587,0.254,26.953,0.004z"/>
                                                        </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                                </div>
                                                <div class="text-2xl ml-4" style="display: inline-block">
                                                        {{comentario.cliente_nombre}}
                                                </div>
                                                <div class="my-4">
                                                    <div  style="display: inline-block" v-for="i in comentario.estrellas" :key="i">
                                                            <svg enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z" fill="#ffc107"/></svg>
                                                    </div>
                                                    <div style="display: inline-block" class="m-4">
                                                        {{comentario.fecha}}
                                                    </div>
                                                </div>

                                                <div class=" text-xl" style="display: inline-block">
                                                        {{comentario.comentario}}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import BtnGris from '@/Components/GreyButton'
    import Swal from 'sweetalert2'
    import BreezeButton from '@/Components/GreyButton'
    import Rater from '@/Components/Rater'
    import toast from '@/mixins/toast.js'


    export default {
        components: {
            BreezeAuthenticatedLayout,
            BtnGris,
            BreezeButton,
            Rater

        },
        props:{
            peluquerias:{},
            peluqueros:{},
            servicios:{},
            favorito:{tiene:'ture'},
            evaluacion:{},
        },

        mixins:[toast],

        data() {
            return {
                form: this.$inertia.form({
                    estrellas: '',
                    comentario: '',
                }),

                infoFavorita: false,
            }
        },

        mounted(){
            this.infoFavorita = this.favorito;
        },

        methods:{
            AgregarFavoritos(id_peluqueria){

                axios.post('/peluqueria/agregar_favoritos/'+id_peluqueria)
                .then(response => {
                    this.infoFavorita = response.data.peluqueriaFavorita;
                })
                .catch(error=>{
                    console.log(error)
                })
            },

            QuitarFavoritos(id_peluqueria){

                axios.delete('/peluqueria/eliminar_favorita/' + this.infoFavorita.id)
                .then(response => {
                    this.infoFavorita = null;
                })
                .catch(error=>{
                    console.log(error)
                })
            },

            Agendar(id_peluqueria){
                  location.href ='/agendar/'+ id_peluqueria
            },

            Evaluar(id_peluqueria){

                axios.post('/peluqueria/evaluar/'+id_peluqueria,{...this.form})
                .then(response => {
                    this.peluquerias.data.evaluaciones=response.data.data
                    this.form.reset();
                    Swal.fire({
                        text:'Gracias por tu evaluación',
                        icon:'success',
                    })
                })
                .catch(error=>{
                    this.mostrarAlerta('Agrega al menos una estrella', 'error', 3000);
                    console.log(error)
                })
            },
            EvaluarPeluquero(id_peluqueria,id_peluquero, index){

                axios.post('/peluquero/evaluar/'+id_peluqueria+'/'+id_peluquero,{...this.form})
                .then(response => {
                    console.log(response.data.estrellas);
                    this.peluquerias.data.peluqueros[index].estrellas=response.data.estrellas
                    Swal.fire({
                        text:'Gracias por tu evaluación',
                        icon:'success',
                    })
                })
                .catch(error=>{
                    this.mostrarAlerta('Agrega al menos una estrella', 'error', 3000);
                    console.log(error)
                })
            },
            /*Evaluar(id_peluqueria) {
                    this.form.post(this.route('peluqueria.evaluar'+id_peluqueria));
                }*/
        },

        computed:{
            esFavorita:function(){
                return this.infoFavorita != null;
            }
        }

    }
</script>
<style scoped>
    #form {
    width: 250px;
    margin: 0 auto;
    height: 100px;
    font-size: 40px;
    }

    #form p {
    text-align: righ;
    }

   label {
        font-size: 35px;
    }

    input[type="radio"] {
    display: none;
    }

    label {
    color: grey;
    }

    .clasificacion {
    direction: rtl;
    unicode-bidi: bidi-override;
    }

    label:hover,
    label:hover ~ label {
    color: orange;
    }

    input[type="radio"]:checked ~ label {
    color: orange;
    }
</style>
