<template>
    <div class="modal" :class="showphonebook">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ list.name }}</p>
                <button class="delete" aria-label="close" @click="close"></button>
            </header>
            <section class="modal-card-body">
                <div class="message is-primary">
                    <div class="message-header">
                        <p>
                            <span class="panel-icon">
                              <i class="fa fa-phone has-text-light"></i>
                            </span>
                            Phone number
                        </p>
                    </div>
                    <p class="message-body">
                        {{ list.phone }}
                    </p>
                </div>
                <div class="message is-primary">
                    <div class="message-header">
                        <p>
                            <span class="panel-icon">
                              <i class="fa fa-envelope has-text-light"></i>
                            </span>
                            Email address
                        </p>
                    </div>
                    <p class="message-body">
                        {{ list.email }}
                    </p>
                </div>
            </section>
            <footer class="modal-card-foot">
                <!--<button class="button" @click="close">Cancel</button>-->
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['showphonebook'],
        data() {
            return {
                list: ''
            }
        },
        methods: {
            close() {
                this.$emit('closeModal');
            }
        }
    }
</script>