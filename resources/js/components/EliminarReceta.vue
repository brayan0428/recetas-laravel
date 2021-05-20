<template>
    <button class="btn btn-danger" @click="eliminarReceta">Eliminar</button>
</template>
<script>
    export default {
        props: ['recetaId'],
        methods: {
            eliminarReceta(){
                this.$swal({
                    title: '¿Esta seguro que desea eliminar la receta?',
                    text: "Una vez eliminada no podra recuperarla",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        const params = {
                            id: this.recetaId
                        }

                        axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                                .then(result => {
                                    this.$swal(
                                        'Confirmación',
                                        'La receta fue eliminada',
                                        'success'
                                    )
                                    const filaReceta = this.$el.parentElement.parentElement
                                    filaReceta.parentElement.removeChild(filaReceta)
                                }).catch(error => {
                                    console.error(error)
                                })
                    }
                })
            }
        }
    }   
</script>