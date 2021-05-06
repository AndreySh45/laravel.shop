<template>
    <div class="container">
        <h1>Доски</h1>
        <div class="row">
            <div class="col-lg-4" v-for="desk in desks">
                <div class="card mt-3">
                    <router-link class="card-body" :to="{name: 'showDesk', params: {deskId: desk.id}}">
                        <h4 class="card-title">{{desk.name}}</h4>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="alert alert-danger" role="alert" v-if="errored">
                Ошибка загрузки данных!
        </div>
        <div class="text-center" v-if="loading">
            <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            desks: [],
            errored: false,
            loading: true
        }
    },
    mounted(){
        axios.get('/api/V1/desks')
        .then(response => {
            this.desks = response.data.data
        })
        .catch (error => {
            console.log(error)
            this.errored = true
        })
        .finally(() => {
            this.loading = false
        })
    }
}
</script>
