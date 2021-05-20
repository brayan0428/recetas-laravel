<template>
    <div class="text-center">
        <span class="like-btn" @click="likeReceta" :class="{'like-active': active}"></span>
        <p class="m-0">{{cantidadLikes}} Me gusta</p>
    </div>
</template>
<script>
    export default {
        props:['recetaId', 'like', 'likes'],
        data(){
            return {
                cantidadLikes: this.likes,
                active: this.like
            }
        },
        methods: {
            likeReceta(){
                axios.put(`/likes/${this.recetaId}`)
                .then(res => {
                    if(res.data.attached.length > 0) {
                        this.cantidadLikes++
                    }
                    if(res.data.detached.length > 0) {
                        this.cantidadLikes--
                    }
                    this.active = !this.active
                })
                .catch(error => {
                    if(error.response.status == 401){
                        window.location.href = '/register'
                    }
                })
            }
        }
    }
</script>
