<template>
    <app-layout>
        <template #header>
            <h2>
                <inertia-link  :href="route('helfer')">Helfer</inertia-link>
                <span>/</span>
                Anlegen
            </h2>
        </template>


        <v-btn class="d-none"></v-btn>

        <v-container>

            <v-container>

                <form @submit.prevent="submit">

                    <v-card>

                        <v-card-text>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.vorname"
                                        :error-messages="errors.vorname"
                                        hide-details="auto"
                                        label="Vorname"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-text-field
                                        v-model="form.nachname"
                                        :error-messages="errors.nachname"
                                        hide-details="auto"
                                        label="Nachname"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.email"
                                        :error-messages="errors.email"
                                        hide-details="auto"
                                        label="Email"
                                        outlined
                                        type="email"
                                    ></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-text-field
                                        v-model="form.geburtsdatum"
                                        :error-messages="errors.geburtsdatum"
                                        hide-details="auto"
                                        label="Geburtsdatum"
                                        outlined
                                        type="date"
                                    ></v-text-field>
                                </v-col>

                            </v-row>

                            <v-row>
                                <v-col>
                                    <v-select
                                        v-model="form.qualifikation"
                                        :error-messages="errors.qualifikation"
                                        :items="items_qualifikation"
                                        label="Qualifikation"
                                        required
                                        outlined
                                        hide-details="auto"
                                    ></v-select>
                                </v-col>
                                <v-col>
                                    <v-text-field
                                        v-model="form.personalnummer"
                                        :error-messages="errors.personalnummer"
                                        hide-details="auto"
                                        label="Personalnummer"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.password"
                                        :error-messages="errors.password"
                                        hide-details="auto"
                                        label="Passwort"
                                        outlined
                                        required
                                        type="password"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.organisation"
                                        :error-messages="errors.organisation"
                                        hide-details="auto"
                                        label="Organisation"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                        </v-card-text>

                        <v-card-actions>
                            <v-btn text type="submit">Helfer Erstellen</v-btn>
                        </v-card-actions>
                    </v-card>

                </form>

            </v-container>

        </v-container>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },

    props: {
        errors: Object,
    },

    data() {
        return {
            items_qualifikation: ['EH', 'SanC', 'RH', 'RS', 'RA', 'NFS', 'Arzt', 'NA'],
            form:  this.$inertia.form({
                vorname: '',
                nachname: '',
                email: '',
                password: '',
                organisation: '',
                geburtsdatum: '',
                personalnummer: '',
                qualifikation: '',
            }),
        }
    },

    methods: {
        submit() {
            this.$inertia.post(this.route('helfer.store'), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },

    },

}
</script>
