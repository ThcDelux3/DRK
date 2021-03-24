<template>
    <guest-layout>
        <v-container fill-height fluid>

            <v-card class="mx-auto" width="450px">

                <v-card-text>
                    <validation-errors class="mb-4"/>

                    <form @submit.prevent="submit">
                        <v-text-field v-model="form.vorname" autofocus dense
                                      label="Vorname" outlined required></v-text-field>
                        <v-text-field v-model="form.nachname" autofocus dense
                                      label="Nachname" outlined required></v-text-field>
                        <v-text-field v-model="form.email" dense
                                      label="Email address" outlined required></v-text-field>
                        <v-text-field v-model="form.password" :append-icon="showP ? 'mdi-eye' : 'mdi-eye-off'" :type="showP ? 'text' : 'password'" autocomplete="new-password"
                                      dense
                                      hint="At least 8 characters"
                                      label="Password"
                                      outlined
                                      required
                                      @click:append="showP = !showP"></v-text-field>
                        <v-text-field v-model="form.password_confirmation" :append-icon="showCP ? 'mdi-eye' : 'mdi-eye-off'" :type="showCP ? 'text' : 'password'" autocomplete="new-password"
                                      dense
                                      hint="At least 8 characters"
                                      label="Confirm Password"
                                      outlined
                                      required
                                      @click:append="showCP = !showCP"></v-text-field>
                        <v-btn :disabled="form.processing" block color="primary" type="submit">Register</v-btn>
                    </form>
                </v-card-text>
                <v-card-text v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" style="font-size: 14px;">
                    <v-checkbox id="terms" v-model:checked="form.terms">
                        <div slot="label">
                            By signing up you agree to the
                            <inertia-link :href="route('terms.show')">Terms of Service</inertia-link>
                            and
                            <inertia-link :href="route('policy.show')">Privacy Policy</inertia-link>
                        </div>
                    </v-checkbox>
                </v-card-text>

                <v-card-actions>
                    <inertia-link as="v-btn" text href="login">Login?</inertia-link>

                </v-card-actions>

            </v-card>

        </v-container>
    </guest-layout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ValidationErrors from '@/Components/ValidationErrors';

export default {
    components: {
        GuestLayout,
        ValidationErrors
    },

    data() {
        return {
            showP: false,
            showCP: false,
            form: this.$inertia.form({
                vorname: '',
                nachname: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>

<style>

</style>
