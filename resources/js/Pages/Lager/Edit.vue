<template>
    <app-layout>
        <template #header>
            <h2>
                <inertia-link  :href="route('lager')">Lager</inertia-link>
                <span>/</span>
                {{ form.name }}
            </h2>
        </template>

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

                        <v-btn text color="red" @click="destroy">Artikel Löschen</v-btn>

                        <v-spacer></v-spacer>

                        <v-btn text type="submit">Artikel Aktualisieren</v-btn>
                    </v-card-actions>
                </v-card>

            </form>

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
        lager: Object,
    },

    data() {
        return {
            sending: false,
            form: {
                name: this.lager.name,
                ablaufdatum: this.lager.ablaufdatum,
                anzahl: this.lager.anzahl,
                schrank: this.lager.schrank,
                img: this.lager.img,

            },
        }
    },

    methods: {

        submit() {
            this.$inertia.put(this.route('lager.update', this.lager.id), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },

        destroy() {
            if (confirm('Möchten Sie diesen Artikel wirklich löschen?')) {
                this.$inertia.delete(this.route('lager.destroy', this.lager.id))
            }
        },


    },

}
</script>
