<template>
    <div class="container">
        <h1>{{name}}</h1>
        <div class="form-group">
            <input type="text" @blur="saveName" v-model="name" class="form-control" :class="{ 'is-invalid': $v.name.$error }" required>
            <div class="invalid-feedback" v-if="!$v.name.required">
                Обязательное поле!
            </div>
            <div class="invalid-feedback" v-if="!$v.name.maxLength">
                Макс. количество символов: {{$v.name.$params.maxLength.max}}
            </div>
        </div>
        <form @submit.prevent = "addNewDeskList">
            <div class="form-group">
                <input type="text" v-model="desk_list_name" class="form-control" :class="{ 'is-invalid': $v.desk_list_name.$error }" placeholder="Введите название списка">
                <div class="invalid-feedback" v-if="!$v.desk_list_name.required">
                    Обязательное поле!
                </div>
                <div class="invalid-feedback" v-if="!$v.desk_list_name.maxLength">
                    Макс. количество символов: {{$v.desk_list_name.$params.maxLength.max}}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Добавить список</button>
        </form>
        <div class="row">
            <div class="col-lg-4" v-for="(desk_list, i) in desk_lists" :key="i">
                <div class="card mt-3">
                    <a href="#" class="card-body">
                        <h4 class="card-title">{{desk_list.name}}</h4>
                    </a>
                    <button type="button" class="btn btn-danger mt-3" @click="deleteDeskList(desk_list.id)">Удалить</button>
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
import { required, maxLength } from 'vuelidate/lib/validators'
export default {
    props: [
        'deskId'
    ],
    data(){
        return{
            name: null,
            desk_list_name: null,
            errored: false,
            loading: true,
            desk_lists: true
        }
    },
    methods:{
        saveName(){
            axios.post('/api/V1/desks/'+this.deskId, {
                _method: 'PUT',
                name: this.name,
            })
            .then(response => {

            })
            .catch (error => {
                console.log(error.response)
                this.errored = true
            })
            .finally(() => {
                this.loading = false
            })
        },
        getDeskLists(){
            axios.get('/api/V1/desk-lists', {
                params: {
                    desk_id: this.deskId
                }
            })
            .then(response => {
                this.desk_lists = response.data.data
            })
            .catch (error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => {
                this.loading = false
            })
        },
        addNewDeskList(){
            this.$v.$touch()
            if (this.$v.$anyError) {
                return;
            }
            axios.post('/api/V1/desk-lists', {
                name: this.desk_list_name,
                desk_id: this.deskId,
            })
                .then(response => {
                    this.desk_list_name = ''
                    this.desk_lists = []
                    this.getDeskLists()
                })
                .catch (error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => {
                    this.loading = false
                })
        },
        deleteDeskList(id){
            if(confirm('Вы действительно хотите удалить список?')){
                axios.post('/api/V1/desk-lists/' + id, {
                    _method: 'DELETE'
                    })
                    .then(response => {
                        this.desk_lists = []
                        this.getDeskLists()
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
    },
    mounted(){
        axios.get('/api/V1/desks/'+this.deskId)
            .then(response => {
                this.name = response.data.data.name
            })
            .catch (error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => {
                this.loading = false
            })
        this.getDeskLists()
    },
    validations: {
        name: {
            required,
            maxLength: maxLength(255)
        },
        desk_list_name:{
            required,
            maxLength: maxLength(255)
        },
    },
}
</script>
