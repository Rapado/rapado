<template>
<div class="mb-10">
    <div class="bg-warning rounded-lg text-center px-2 py-1 text-white">
        {{dia}}
    </div>
    <form @submit.prevent="submit">
        <my-input type = "time" v-model="form.apertura" class="my-1 w-full"  placeholder="Nombre del peluquero" />
        <my-label value="A" class="text-center "/>
        <my-input type = "time" v-model="form.cierre" class="my-1 w-full"  placeholder="Nombre del peluquero" />

        <div class="ml-3 float-right" v-if="canSave" >
            <svg @click="submit" class = "fill-current text-primary hover:text-primary-dark cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0z" fill="none"/><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/></svg>
        </div>
        <div class="float-right" v-if="daySaved">
            <svg @click="eliminarDiaTrabajo" class = "fill-current text-error hover:text-accent-dark cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
        </div>
    </form>

</div>
</template>

<script>
    import MyInput from '@/Components/Input'
    import MyLabel from '@/Components/Label'
    import MyButton from '@/Components/Button'

    export default {
        props: ['modelValue', 'noDia', 'dia', 'workDay'],

        components:  { MyInput, MyLabel, MyButton },

        data() {
            return {
                form: {
                    apertura: '',
                    cierre: '',
                },

                lastDaySaved: {},
                canSave: false
            }
        },

        mounted() {
            this.workDay != null ? this.form = Object.assign({}, this.workDay) : null;
            this.lastDaySaved = Object.assign({}, this.form);
        },

        methods: {
            submit(){
                !this.daySaved ? this.diaDeTrabajoRequest('/peluqueria/agregar_dia') : this.diaDeTrabajoRequest('/peluqueria/actualizar_dia/' + this.form.id);
            },

            diaDeTrabajoRequest(url) {
                axios.post(url, {...this.form, numeroDia: this.noDia})
                .then( response => {
                    console.log(response.data);
                    this.form = response.data.diaDeTrabajo;
                    this.lastDaySaved = Object.assign({}, this.form);
                })
                .catch( error => {
                    console.log(error);
                });
            },

            eliminarDiaTrabajo(){
                axios.delete('/peluqueria/eliminar_dia/' + this.form.id)
                .then( response => {
                    this.form.apertura = '';
                    this.form.cierre = '';
                    this.form.id = undefined;
                    this.lastDaySaved = Object.assign({}, this.form);
                })
                .catch( error => {
                    console.log(error);
                });
            }
        },

        computed:{
            daySaved: function(){
                return this.form.id != undefined;
            },
        },

        watch:{
            form: {
                handler(){
                    this.canSave = this.form.apertura != '' && this.form.cierre != '' && JSON.stringify(this.form) !== JSON.stringify(this.lastDaySaved);
                },
                deep: true
            }
        }
    }
</script>

