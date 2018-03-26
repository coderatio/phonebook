<template>
    <div class="modal modal-fixed-footer medium" id="updateModal">
        <div v-if="updateSpinner">
            <div class="modal-content">
                <div class="center">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    Saving...
                </div>
            </div>
        </div>
        <div v-if="!updateSpinner">
            <div class="modal-content">
                <h5 class="title truncate" v-if="!updateSpinner">Update <b>{{ list.name }}</b>'s details</h5><br/>
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.name}" type="text" placeholder="Name"
                               v-model="list.name">
                    </div>
                    <small v-if="errors.name" class="red-text">{{ errors.name[0] }}</small>
                </div>
                <div class="field">
                    <label class="label">Phone</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger': errors.phone}" type="text" placeholder="Phone"
                               v-model="list.phone">
                    </div>
                    <small v-if="errors.phone" class="red-text">{{ errors.phone[0] }}</small>
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" :class="{'is-danger': errors.email}" placeholder="Email"
                               v-model="list.email">
                    </div>
                    <small v-if="errors.email" class="red-text">{{ errors.email[0] }}</small>
                </div>
            </div>
        </div>
        <footer class="modal-footer" v-if="!updateSpinner">
            <button class="btn teal waves-effect waves-teal" @click="update()"><i
                    class="material-icons yellow-text left">done</i>
                Submit
            </button>
            <button class="btn modal-action grey white-text modal-close" @click="close"><i
                    class="material-icons left">clear</i> Cancel
            </button>
        </footer>
    </div>
</template>

<script>

    export default {
        props: ['openmodal'],
        data() {
            return {
                list: {},
                errors: {},
                message: false,
                alertClass: '',
                messageTitle: '',
                updateSpinner: false
            }
        },
        methods: {
            close() {
                this.message = {};
                this.errors = {};
                this.$emit('closeModal');
            },
            update() {
                this.updateSpinner = true;
                axios.put(`/phonebook/${this.list.id}`, this.$data.list)
                    .then((response) => {
                        this.message = true;
                        this.updateSpinner = false;
                        this.errors = {};
                        this.messageTitle = response.data.message;
                        toast(this.messageTitle);

                        this.$parent.lists.data.sort(function (a, b) {
                            if (a.name > b.name) {
                                return 1;
                            } else if (a.name < b.name) {
                                return -1;
                            }
                        });

                        console.log(response);
                    })
                    .catch((error) => {
                        this.message = true;
                        this.updateSpinner = false;
                        this.errors = error.response.data.errors;
                        console.log(error);
                    });
            }
        }
    }
</script>