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
        <div class="alert alert-danger" role="alert" v-if="errored">
            Ошибка загрузки данных!
        </div>
        <div class="row">
            <div class="col-lg-4" v-for="(desk_list, i) in desk_lists" :key="i">
                <div class="card mt-3">
                    <div class="card-body">
                        <form @submit.prevent = "updateDeskList(desk_list.id, desk_list.name)" v-if = "desk_list_input_id == desk_list.id" class="d-flex justify-content-between align-items-center">
                            <input type="text" v-model="desk_list.name" class="form-control" placeholder="Введите название списка">
                            <button type="button" @click="desk_list_input_id = null" class="close ml-2" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                        <h4 v-else class="card-title d-flex justify-content-between align-items-center" style="cursor: pointer;" @click="desk_list_input_id = desk_list.id">{{desk_list.name}}<i class="fas fa-pen-alt" style="font-size: 15px;"></i></h4>
                        <button type="button" class="btn btn-danger mt-3" @click="deleteDeskList(desk_list.id)">Удалить список</button>
                        <div class="card mt-3 bg-light" v-for="card in desk_list.cards" :key="card.id">
                            <div class="card-body">
                                <h4 class="card-title d-flex justify-content-between align-items-center" style="cursor: pointer;">{{card.name}}</h4>
                                <button type="button" class="btn btn-secondary mt-3">Удалить</button>
                            </div>
                        </div>
                        <form @submit.prevent = "addNewCard(desk_list.id)" class="mt-3">
                            <div class="form-group">
                                <input type="text" v-model="card_names[desk_list.id]" class="form-control" :class="{ 'is-invalid': $v.card_names.$each[desk_list.id].$error }" placeholder="Введите название карточки">
                                <div class="invalid-feedback" v-if="!$v.card_names.$each[desk_list.id].required">
                                    Обязательное поле!
                                </div>
                                <div class="invalid-feedback" v-if="!$v.card_names.$each[desk_list.id].maxLength">
                                    Макс. количество символов: {{$v.card_names.$each[desk_list.id].$params.maxLength.max}}
                                </div>
                            </div>
                        </form>
                    </div>
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
    props: [
        'deskId'
    ],
    data(){
        return{
            name: null,
            desk_list_name: null,
            errored: false,
            loading: true,
            desk_lists: true,
            desk_list_input_id: null,
            card_names: []
        }
    },
    methods:{
        addNewCard(desk_list_id){
            this.$v.card_names.$each[desk_list_id].$touch()
            if (this.$v.card_names.$each[desk_list_id].$anyError) {
                return;
            }
            axios.post('/api/V1/cards', {
                name: this.card_names[desk_list_id],
                desk_list_id
            })
            .then(response => {
                this.$v.$reset()
                this.getDeskLists()
            })
            .catch (error => {
                console.log(error.response)
                this.errored = true
            })
            .finally(() => {
                this.loading = false
            })
        },
        saveName(){
            this.$v.name.$touch()
            if (this.$v.name.$anyError) {
                return;
            }
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
                this.card_names = []
                this.desk_lists.forEach(el => {
                    this.card_names[el.id] = ''
                });
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
            this.$v.desk_list_name.$touch()
            if (this.$v.desk_list_name.$anyError) {
                return;
            }
            axios.post('/api/V1/desk-lists', {
                name: this.desk_list_name,
                desk_id: this.deskId,
            })
                .then(response => {
                    this.$v.$reset()
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
        },
        updateDeskList(id, name){
            axios.post('/api/V1/desk-lists/' + id, {
                _method: 'PUT',
                name
            })
            .then(response => {
                this.desk_list_input_id = null
            })
            .catch (error => {
                console.log(error.response)
                this.errored = true
            })
            .finally(() => {
                this.loading = false
            })
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
        card_names:{
            $each:{
                required,
                maxLength: maxLength(255)
            }
        },
    },
}
</script>
