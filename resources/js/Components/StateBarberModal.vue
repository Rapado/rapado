<template>

</template>

<script>
    import Swal from 'sweetalert2'
    const options = ['En revisión', 'Aceptada', 'Rechazada', 'Reenviar documento']
    const optionsVlue = ['enRevision', 'aceptada', 'rechazada', 'reenviarDoc']

    export default {
        props: ['barber', 'canShowModal'],

        methods: {
           async showModal() {
                const { value: formValues } = await Swal.fire({
                    title: this.barber.peluqueria.nombre + ' - Actualizar estado',
                    showCancelButton: true,
                    confirmButtonText: 'Actualizar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#b91c1c',

                    html:
                        '<select id="state" class="swal2-input" placeholder = "Elige un estado">' +
                            '<option value="" selected>Elige un estado</option>' +
                            '<option value="aceptada">Aceptar</option>' +
                            '<option value="enRevision">En revisión</option>' +
                            '<option value="reenviarDoc">Reenviar documento</option>' +
                            '<option value="rechazada">Rechazar</option>' +
                        + '</select>' +
                        '<input id="message" class="swal2-input" placeholder = "Motivo del estado" autocomplete="nope">',

                    focusConfirm: false,
                    preConfirm: () => {
                        return [
                            document.getElementById('state').value,
                            document.getElementById('message').value
                        ]
                    },

                })


                if(formValues){
                    if(formValues[0] != ""){
                        this.updateState(formValues);
                    }
                }

                this.showModalStatus = false;
            },

            async updateState(form){
                const url = `peluqueria/${this.barber.peluqueria.id}/update_state/${this.barber.idEstado}`;

                try {
                    const response = await axios.post(url, { estado: form[0], meessage: form[1] });

                    this.$emit('updateBarberList', response.data);
                } catch (error) {
                    console.log(error);
                }
            }
        },

        watch: {
            canShowModal: function(val, oldVal){
                if(val == true)
                    this.showModal();

                console.log(this.barber);
            },
        },

        computed: {
            showModalStatus:{
                get: function () {
                    return this.canShowModal;
                },

                set: function(val){
                    this.$emit('hideModal', val)
                }
            }
        },

    }
</script>

