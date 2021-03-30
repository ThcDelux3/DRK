<template>
    <app-layout>
        <template #header>
            <h2>
                <inertia-link  :href="route('lager')">Lager</inertia-link>
                <span>/</span>
                Artikel Anlegen
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
                                        v-model="form.name"
                                        hide-details="auto"
                                        label="Name"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-text-field
                                        v-model="form.ablaufdatum"
                                        hide-details="auto"
                                        label="Ablaufdatum"
                                        outlined
                                        required
                                        type="date"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.anzahl"
                                        hide-details="auto"
                                        label="Anzahl"
                                        outlined
                                        required
                                        type="number"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.schrank"
                                        hide-details="auto"
                                        label="Schrank"
                                        outlined
                                        required
                                        type="text"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.img"
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

                            <v-btn text type="submit">Artikel Erstellen</v-btn>
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

    data() {
        return {
            form:  this.$inertia.form({
                name: '',
                ablaufdatum: '',
                anzahl: '',
                schrank: '',
                img: '',
            }),
        }
    },

    methods: {

        submit() {
            this.$inertia.post(this.route('lager.store'), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },

    },

}
</script>
