<template>
    <div>
        <div class="row">
            <div class="col l8 m10 offset-m1 offset-l2">
                <div class="card animated fadeIn">
                    <div class="card-body">
                        <div class="row">
                            <div class="col s12 center-block center">
                                <img src="/public/img/phonebook-icon.png" alt="" style="width: 200px; display: block; margin: 20px auto">
                            </div>
                            <div class="col l8 s10 offset-s1  m10 offset-m1 offset-l2 center">
                                <p>
                                    <b>PHONEBook</b> a.k.a <b>LaraVue</b>, is a simple started kit built to help you get started with Laravel and VueJS as fast as possible. This kit, will also help you understand beautiful Materialize CSS.
                                </p>

                                <div class="card-content">
                                    <router-link to="/about" class="btn teal-text white waves-effect btn-large">Learn More <i class="material-icons right">chevron_right</i></router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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