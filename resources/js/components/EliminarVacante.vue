<template>

    <button class="text-red-600 hover:text-red-900  mr-5"
    @click="eliminarVacante()">Eliminar</button>

</template>

<script>
    export default {
        props: ['vacanteId'],
        methods:{
            eliminarVacante(){

                this.$swal({
                    title: 'Deseas eliminar esta vacante?',
                    text: "Una vez eliminada, no se puede recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {

                        const params = {
                            vacante: this.vacanteId
                        }

                        axios.post(`/vacantes/${this.vacanteId}`, {params, _method: 'delete'})
                            .then(respuesta => {
                               this.$swal.fire(
                                    'Vacante Eliminada',
                                    respuesta.data.mensaje,
                                    'success'
                                )
                                //console.log(respuesta)
                                // eliminando del DOM
                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);

                            })
                            .catch(error =>{
                                console.log(error)
                            })
                    }
                })
            }
        }
    }
</script>
