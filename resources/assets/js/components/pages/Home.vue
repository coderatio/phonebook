<template>
   <div>
       <div class="">
           <div class="row">
               <div class="col s12 m10 offset-m1 animated fadeIn">
                   <h4 class="card-title">
                       Phonebooks
                   </h4>

                   <div class="card search-card puls">
                       <div class="card-content">
                           <div class="row">
                               <div class="col m10 s8">
                                   <div class="">
                                       <input class="input" type="text" placeholder="Search phonebook" v-model="searchQuery">
                                   </div>
                               </div>
                               <div class="col m2 s4">
                                   <select class="pb-select" v-model="filterQuery">
                                       <option value="" disabled selected>Show..</option>
                                       <option value="4">Default</option>
                                       <option value="10">10</option>
                                       <option value="25">25</option>
                                       <option value="50">50</option>
                                       <option value="100">100</option>
                                   </select>
                               </div>

                           </div>
                       </div>
                   </div>
                   <div v-if="homeSpinner">
                       <div class="card-body center">
                           <div class="preloader-wrapper active">
                               <div class="spinner-layer spinner-teal-only">
                                   <div class="circle-clipper left">
                                       <div class="circle"></div>
                                   </div><div class="gap-patch">
                                   <div class="circle"></div>
                               </div><div class="circle-clipper right">
                                   <div class="circle"></div>
                               </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   <!--Not addLoading-->
                   <div v-if="!homeSpinner">
                       <ul class="collapsible popout" v-if="!noResults">
                           <li v-for="item, key in tempData.data" @click="activateCollapsible()">
                               <div class="collapsible-header">
                                   <i class="material-icons teal-text pulse">account_circle</i>
                                   {{ item.name }}
                               </div>
                               <div class="collapsible-body">
                               <span class="badge">
                                   <a @click="openDeleteModal(key, item.id)" class="waves-effect waves-red red-text"><i class="material-icons">delete</i></a>
                               </span>
                                   <span class="badge">
                                   <a @click="updatePhonebook(key)" class="waves-effect waves-green green-text"><i class="material-icons">create</i></a>
                               </span>
                                   <p>
                                       <b>Phone:</b> {{ item.phone }}<br/>
                                       <b>Email:</b> {{ item.email }}
                                   </p>
                               </div>
                           </li>
                       </ul>
                       <div class="card" v-if="noResults">
                           <div class="card-content">
                               <p>{{ noResultMsg }}</p>
                           </div>
                       </div>

                       <Add :openmodal="addActive" @closeModal="close"/>
                       <Update :openmodal="updateActive" @closeModal="close"/>
                       <Delete :openmodal="deleteActive" @closeModal="close"/>
                       <Pagination :data="tempData" v-on:pagination-change-page="getResults">
                           <span slot="prev-nav">Previous <i class="material-icons left">chevron_left</i></span>
                           <span slot="next-nav">Next <i class="material-icons right">chevron_right</i></span>
                       </Pagination>
                   </div>
               </div>
           </div>
       </div>
   </div>
</template>

<script>

    let Add = require('../models/Add.vue');
    let Update = require('../models/Update.vue');
    let Delete = require('../models/Delete.vue');
    let Pagination = require('laravel-vue-pagination');

    export default {
        components: {Add, Update, Delete, Pagination},
        data() {
            return {
                addActive : '',
                showActive: '',
                updateActive: '',
                lists: {},
                errors: {},
                tempData: {},
                searchQuery: '',
                filterQuery: 4,
                homeSpinner: false,
                deleteActive: '',
                noResults: false,
                noResultMsg: 'No phonebooks available..',
                searchData: {
                    query: '',
                    perPage: 4
                }
            }
        },
        watch:{
            searchQuery(){
                this.searchData.query = this.searchQuery;

                if (this.searchQuery.length > 0) {
                    this.homeSpinner = true;
                    axios.post('/get-search', {
                            searchQuery: this.searchData.query,
                            perPage: this.searchData.perPage
                        })
                        .then(response => {
                            this.homeSpinner = false;
                            this.lists = this.tempData = response.data;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                } else {
                    this.getResults();
                }

                //console.log(this.searchQuery.length);
            },

            filterQuery() {
                this.searchData.perPage = this.filterQuery;
                this.homeSpinner = true;

                axios.post('/get-phonebooks', {
                    perPage: this.searchData.perPage
                })
                    .then(response => {
                        this.homeSpinner = false;
                        this.lists = this.tempData = response.data;
                        console.log(response.data);
                    })
                    .catch(error => {
                        this.homeSpinner = false;
                        console.log(error);
                    });
            }
        },
        mounted() {
            this.activateSelect();
            this.getResults();
        },
        methods: {

            getResults(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                // Using vue-resource as an example
                axios.post('/get-phonebooks?page=' + page, {
                    perPage: this.searchData.perPage
                })
                    .then(response => {
                        this.lists = this.tempData = response.data;
                        return response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            openAddModal: function () {
                this.activateModal();
                $('#addModal').modal('open');
            },

            close() {
//                this.$children[1].message = false;
//                this.$children[1].errors = {};
//                this.$children[2].message = false;
            },

            openDeleteModal(key, id) {
                this.$children[2].list = this.tempData.data[key];
                this.$children[2].key = key;
                this.activateModal();
                $('#deleteModal').modal('open');
            },

            updatePhonebook(key) {
                this.$children[1].list = this.tempData.data[key];
                this.activateModal();
                $('#updateModal').modal('open');
            },

            activateCollapsible() {
                $('.collapsible').collapsible();
            },

            activateModal() {
                return $('.modal').modal();
            },

            activateSelect() {
                $('select').formSelect();
            }
        }
    };
</script>