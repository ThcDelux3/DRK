<template>
    <guest-layout>
        <v-container fill-height fluid>
            <v-card class="mx-auto" width="450px">
                <v-card-text>
                    <validation-errors class="mb-4" />

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit">
                        <v-text-field dense outlined label="Email Address" required autofocus
                                      v-model="form.email"></v-text-field>
                        <v-text-field dense hide-details outlined label="Password" required
                                      autocomplete="current-password"
                                      v-model="form.password"
                                      :append-icon="showP ? 'mdi-eye' : 'mdi-eye-off'"
                                      :type="showP ? 'text' : 'password'"
                                      hint="At least 8 characters"
                                      @click:append="showP = !showP"></v-text-field>
                        <v-checkbox
                            v-model="form.remember"
                            label="Remember me"
                        ></v-checkbox>
                        <v-btn block color="primary" type="submit" :disabled="form.processing"> Sign In</v-btn>
                        <br>
                        <v-divider></v-divider>
                        <br>
                        <inertia-link as="v-btn" :href="route('ausweisslogin')" block color="secondary" :disabled="form.processing"> DRK Ausweiß</inertia-link>

                    </form>

                </v-card-text>

                <v-card-actions>
                    <inertia-link :href="route('register')" as="v-btn" text>Register?</inertia-link>
                    <inertia-link v-if="canResetPassword" :href="route('password.request')" as="v-btn" text>Forgot Password?</inertia-link>
                </v-card-actions>

            </v-card>
        </v-container>
        <v-sheet class="" color="gray pulse" width="200px">
        </v-sheet>

    </guest-layout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ValidationErrors from '@/Components/ValidationErrors';

export default {
    components: {
        GuestLayout,
        ValidationErrors,
    },

    props: {
        canResetPassword: Boolean,
        status: String
    },

    data() {
        return {

            showP: false,

            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            }),

        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ... data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        },

    }
}
</script>

<style scoped>
a {
    font-size: 1.15rem;
}
</style>
