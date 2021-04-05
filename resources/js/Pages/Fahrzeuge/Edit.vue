<template>
    <app-layout>
        <template #header>
            <h2>
                <inertia-link  :href="route('fahrzeuge')">Fahrzeug</inertia-link>
                <span>/</span>
                {{ form.kennzeichen }}
            </h2>
        </template>

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

                        <v-btn text color="red" @click="destroy">Fahrzeug Löschen</v-btn>

                        <v-spacer></v-spacer>

                        <v-btn text type="submit">Fahrzeug Aktualisieren</v-btn>
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
        fahrzeuge: Object,
    },

    data() {
        return {
            sending: false,
            form: {
                funkrufname: this.fahrzeuge.funkrufname,
                kennzeichen: this.fahrzeuge.kennzeichen,
                fahrzeugart: this.fahrzeuge.fahrzeugart,
                img: this.fahrzeuge.img,

            },
        }
    },

    methods: {

        submit() {
            this.$inertia.put(this.route('fahrzeuge.update', this.fahrzeuge.id), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },

        destroy() {
            if (confirm('Möchten Sie dieses Fahrzeug wirklich löschen?')) {
                this.$inertia.delete(this.route('fahrzeuge.destroy', this.fahrzeuge.id))
            }
        },


    },

}
</script>
