<template>
    <div class="pb-navbar">
        <nav class="teal darken-2 pb-navbar-fixed">
            <div class="nav-wrapper">
                <router-link class="brand-logo" to="/"><span class="yellow-text"><b>PHONE</b></span>Book</router-link>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobil" class="right hide-on-med-and-down">
                    <li><a class="btn waves-effect waves-light yellow darken-1 black-text" @click="openAddModal()"><i class="material-icons">add</i> Add New</a></li>
                    <li><router-link to="/">Home</router-link></li>
                    <li><router-link to="/phonebook">Phonebook</router-link></li>
                    <li><router-link to="/about">About</router-link></li>
                </ul>
                <ul class="right show-on-medium-and-down">
                    <li>
                        <a class="btn pulse waves-effect waves-light yellow darken-1 black-text hide-on-med-and-up" @click="openAddModal()"><i class="material-icons">add</i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="nav-mobile">
            <a class="sidenav-close btn pulse btn-small right waves-effect waves-light red" style="margin-right: -3px; border-radius: 25px 0 0 25px;"><i class="material-icons">keyboard_backspace</i></a>
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/phonebook">Phonebook</router-link></li>
            <li><router-link to="/about">About</router-link></li>
        </ul>
    </div>
</template>

<script>
    export default {
        methods: {
            openAddModal: function () {
                $('.modal').modal();
                $('#addModal').modal('open');
            }
        }
    }
</script>