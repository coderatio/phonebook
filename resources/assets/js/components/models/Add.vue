<template>
    <div class="modal modal-fixed-footer medium" id="addModal">
        <div v-if="addLoading">
            <div class="modal-content">
                <div class="center">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    {{ loadingMessage }}
                </div>
            </div>
        </div>
        <div class="modal-content" v-if="!addLoading">
            <div class="">
                <h5 class="title truncate">New phonebook</h5>
            </div>
            <div class="field">
                <label class="label">Name</label>
                <input class="form-control" :class="{'is-danger':errors.name}" type="text" placeholder="Name" v-model="list.name">
                <small v-if="errors.name" class="red-text">{{ errors.name[0] }}</small>
            </div>
            <div class="field">
                <label class="label">Phone</label>
                <div class="control">
                    <input class="form-control" :class="{'is-danger': errors.phone}" type="text" placeholder="Phone" v-model="list.phone">
                </div>
                <small v-if="errors.phone" class="red-text">{{ errors.phone[0] }}</small>
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="form-control" type="email" :class="{'is-danger': errors.email}" placeholder="Email" v-model="list.email">
                </div>
                <small v-if="errors.email" class="red-text">{{ errors.email[0] }}</small>
            </div>
        </div>
        <footer class="modal-footer" v-if="!addLoading">
            <button class="btn teal waves-effect waves-light" @click="save"><i class="material-icons left yellow-text">done</i>  Submit</button>
            <button class="btn grey waves-effect waves-light white-text modal-action modal-close" @click="close"><i class="material-icons left">clear</i> Cancel</button>
        </footer>
    </div>
</template>

<script>
    export default {
        props: ['openmodal'],
        data() {
            return {
                list: {
                    name: null,
                    email: null,
                    phone: null
                },
                message: false,
                alertClass: '',
                errors: {},
                messageTitle: '',
                addLoading: false,
                loadingMessage: ''
            }
        },
        methods: {
            close() {
                this.errors = {};
                this.$emit('closeModal');
            },
            save() {
                this.addLoading = true;
                this.loadingMessage = 'Saving...';
                axios.post('/phonebook', this.$data.list)
                    .then((response) => {
                        this.loadingMessage = 'Finalizing...';
                        this.message = true;
                        this.addLoading = false;
                        this.errors = {};
                        this.alertClass = 'is-success';
                        this.messageTitle = response.data.message;
                        toast(this.messageTitle);
                        /**
                         *  Add new record to lists
                         *  And update records table
                         **/
                        this.$parent.tempData.data.push(response.data.newItem);
                        //Sort names in ascending order
                        this.$parent.tempData.data.sort((a,b) => {
                            if (a.name > b.name) {
                                return 1;
                            }else if(a.name < b.name){
                                return -1;
                            }
                        });

                        this.$parent.getResults();

                        // Clear input fields
                        this.list = '';
                    })
                    .catch((error) => {
                        this.message = true;
                        this.addLoading = !this.addLoading;
                        this.errors = error.response.data.errors;
                        console.log(error)
                    });
            }
        }
    }
</script>