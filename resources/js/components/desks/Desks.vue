<template>
    <div class="container">
        <h1>Доски</h1>
        <form @submit.prevent = "addNewDesk">
            <div class="form-group">
                <input type="text" v-model="name" class="form-control" :class="{ 'is-invalid': $v.name.$error }" placeholder="Введите название доски">
                <div class="invalid-feedback" v-if="!$v.name.required">
                    Обязательное поле!
                </div>
                <div class="invalid-feedback" v-if="!$v.name.maxLength">
                    Макс. количество символов: {{$v.name.$params.maxLength.max}}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
        <div class="alert alert-danger mt-3" role="alert" v-if="errored">
                Ошибка загрузки данных! <br>
                {{errors[0]}}
        </div>
        <div class="row">
            <div class="col-lg-4" v-for="(desk, i) in desks" :key="i">
                <div class="card mt-3">
                    <router-link class="card-body" :to="{name: 'showDesk', params: {deskId: desk.id}}">
                        <h4 class="card-title">{{desk.name}}</h4>
                    </router-link>
                    <button type="button" class="btn btn-danger mt-3" @click="deleteDesk(desk.id)">Удалить</button>
                </div>
            </div>
        </div>
        <div class="text-center" v-if="loading">
            <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </div>
</template>
<script>
import { required, maxLength } from 'vuelidate/lib/validators'
export default {
    data(){
        return{
            desks: [],
            errored: false,
            loading: true,
            name: null
        }
    },
    mounted(){
        this.getAllDesks()
    },
    methods:{
        getAllDesks(){
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
        },
        deleteDesk(id){
            if(confirm('Вы действительно хотите удалить доску?')){
                axios.post('/api/V1/desks/' + id, {
                    _method: 'DELETE'
                    })
                    .then(response => {
                        this.desks = []
                        this.getAllDesks()
                    })
                    .catch (error => {
                        console.log(error)
                        this.errored = true
                    })
                    .finally(() => {
                        this.loading = false
                    })
            }
        },
        addNewDesk(){
            this.$v.$touch()
            if (this.$v.$anyError) {
                return;
            }
            axios.post('/api/V1/desks', {
                name: this.name
            })
                .then(response => {
                    this.errored = false
                    this.name = ''
                    this.desks = []
                    this.getAllDesks()
                })
                .catch (error => {
                    console.log(error)
                    if(error.response.data.errors.name){
                        this.errors = []
                        this.errors.push(error.response.data.errors.name[0])
                    }
                    this.errored = true
                })
                .finally(() => {
                    this.loading = false
                })
        }
    },
    validations: {
        name: {
            required,
            maxLength: maxLength(255)
        }
    }
}
</script>
