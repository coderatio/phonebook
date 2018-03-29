<template>
    <div id="deleteModal" class="modal small">
        <div class="modal-content center" v-if="!deleteSpinner">
            <i class="material-icons large red-text">error</i>
            <h3 class="title red-text"> Are you sure?</h3>
            <p>You will delete <b>{{ list.name }}</b>'s details.</p>
        </div>
        <div v-if="deleteSpinner">
            <div class="modal-content">
                <div class="center">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    Deleting...
                </div>
            </div>
        </div>
        <div class="modal-footer" v-if="!deleteSpinner">
            <button class="btn red waves-effect waves-red" @click="deleteItem(key, list.id)"><i class="material-icons left">done</i> Yes<span class="hide-on-small-and-down">, Delete</span></button>
            <button class="modal-action btn grey white-text modal-close waves-effect"><i class="material-icons left">clear</i> No<span class="hide-on-small-and-down">, Cancel</span></button>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['openmodal'],
        data() {
            return {
                deleteSpinner: false,
                message: '',
                list: {},
                errors: {},
                key: null
            }
        },
        methods: {
            close() {
                $('.collapsible').collapsible('close');
                $('#deleteModal').modal('close');
                this.$emit('closeModal');
            },
            deleteItem(key, id) {
                this.deleteSpinner = true;
                axios.delete(`/phonebook/${id}`)
                    .then((response) => {
                        this.close();
                        this.deleteSpinner = false;
                        this.$parent.lists.data.splice(key,1);
                        this.message = response.data.message;
                        toast(this.message);
                        this.$parent.getResults();
                        console.log(this.message);
                    })
                    .catch((error) => {
                        this.deleteSpinner = false;
                        this.message = this.errors = error.response.data.errors;
                        console.log(this.errors);
                    });
            }
        }
    }
</script>