<template>
    <app-layout>
        <template #header>
            <h2>
                <inertia-link  :href="route('fahrzeuge')">Fahrzeuge</inertia-link>
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
                                        v-model="form.funkrufname"
                                        :error-messages="errors.funkrufname"
                                        hide-details="auto"
                                        label="Funkrufname"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-text-field
                                        v-model="form.kennzeichen"
                                        :error-messages="errors.kennzeichen"
                                        hide-details="auto"
                                        label="Kennzeichen"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeugart"
                                        :error-messages="errors.fahrzeugart"
                                        hide-details="auto"
                                        label="Fahrzeugart"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-text-field
                                        v-model="form.img"
                                        :error-messages="errors.img"
                                        hide-details="auto"
                                        label="Img"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                        </v-card-text>

                        <v-card-actions>

                            <v-btn text type="submit">Fahrzeug Erstellen</v-btn>
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
            form:  this.$inertia.form({
                funkrufnamen: '',
                kennzeichen: '',
                fahrzeugart: '',
                img: '',
            }),
        }
    },

    methods: {

        submit() {
            this.$inertia.post(this.route('fahrzeuge.store'), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },

    },

}
</script>
