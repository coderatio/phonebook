<template>
    <div>
        <section class="section">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col l8 s12 m10 offset-m1 offset-l2">
                        <h4 class="title">About</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col l8 s12 m10 offset-m1 offset-l2">
                        <div>
                            After downloading this kit, you be able to learn:
                        </div>
                        <ul class="collection z-depth-1">
                            <li class="collection-item avatar">
                                <i class="material-icons circle teal">http</i>
                                <h4 class="title"><b>Routing</b></h4>
                                <p>
                                    VueJS - Laravel routing harmonization
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons grey-text">verified_user</i></a>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle teal">code</i>
                                <h4 class="title"><b>Vue Syntax</b></h4>
                                <p>
                                    What VueJS is all about and how it works by reading the codes.
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons grey-text">verified_user</i></a>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle teal">chrome_reader_mode</i>
                                <h4 class="title"><b>Vue Components</b></h4>
                                <p>
                                    Understand how Vue components works, how data is passed from one component to another. You will also learn vue events.
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons grey-text">verified_user</i></a>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle teal">list</i>
                                <h4 class="title"><b>Vue Pagination</b></h4>
                                <p>
                                    You will understand how vue pagination works
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons grey-text">verified_user</i></a>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle teal">search</i>
                                <h4 class="title"><b>Global Search</b></h4>
                                <p>
                                    You will understand how simply you can build your awesome search and filter
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons grey-text">verified_user</i></a>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle teal">input</i>
                                <h4 class="title"><b>Laravel - Vue CRUD</b></h4>
                                <p>
                                    Laravel - Vue create, read, update an delete.
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons grey-text">verified_user</i></a>
                            </li>
                        </ul>

                        <!--<div class="card-content center">-->
                            <!--<br/>-->
                            <!--<a href="" class="btn btn-large waves-effect yellow black-text">Download Kit <i class="material-icons right">get_app</i></a>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </section>
        <Add></Add>
    </div>
</template>

<script>
    let Add = require('../models/Add.vue');

    export default {
        components: {Add},
        methods: {
            openAddModal: function () {
                $('.modal').modal();
                $('#addModal').modal('open');
            }
        }
    }
</script>