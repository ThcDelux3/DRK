<template>
    <app-layout>
        <template #header>
            <h2>

                <inertia-link  :href="route('helfer')">Helfer</inertia-link>
                <span>/</span>
                {{ form.vorname }} {{ form.nachname }}
            </h2>
        </template>

        <v-container>

            <form @submit.prevent="submit">

                <v-card>

                    <v-card-text>

                        <!-- Profile Photo -->
                        <div class="mb-4" v-if="$page.props.jetstream.managesProfilePhotos">
                            <!-- Profile Photo File Input -->
                            <input type="file" style="display: none;"
                                   ref="photo"
                                   @change="updatePhotoPreview">

                            <!-- New Profile Photo Preview -->
                            <v-avatar size="80">
                                <img :src="photoPreview" v-if="photoPreview">
                                <img :src="form.img" :alt="form.name" v-else>

                            </v-avatar>

                            <v-btn class="ml-3 mt-2 mr-2" outlined color="info" @click.native.prevent="selectNewPhoto">
                                Wählen Sie ein neues Foto                            </v-btn>
                            <v-btn class="mt-2" outlined color="info" @click.native.prevent="deletePhoto" v-if="form.img">
                                Foto entfernen
                            </v-btn>

                        </div>

                        <v-row>
                            <v-col>
                                <v-text-field
                                    v-model="form.vorname"
                                    hide-details="auto"
                                    label="Vorname"
                                    outlined
                                    required
                                    type="text"
                                    :error-messages="errors.vorname"
                                ></v-text-field>
                            </v-col>
                            <v-col>
                                <v-text-field
                                    v-model="form.nachname"
                                    hide-details="auto"
                                    label="Nachname"
                                    outlined
                                    required
                                    type="text"
                                    :error-messages="errors.nachname"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <v-text-field
                                    v-model="form.email"
                                    hide-details="auto"
                                    label="Email"
                                    outlined
                                    type="email"
                                    :error-messages="errors.email"
                                ></v-text-field>
                            </v-col>
                            <v-col>
                                <v-text-field
                                    v-model="form.geburtsdatum"
                                    hide-details="auto"
                                    label="Geburtsdatum"
                                    outlined
                                    required
                                    type="date"
                                    :error-messages="errors.geburtsdatum"
                                ></v-text-field>
                            </v-col>

                        </v-row>

                        <v-row>
                            <v-col>
                                <v-select
                                    v-model="form.qualifikation"
                                    :error-messages="errors.qualifikation"
                                    :items="items_qualifikation"
                                    :value="items_qualifikation_value"
                                    label="Qualifikation"
                                    outlined
                                    hide-details="auto"
                                ></v-select>
                            </v-col>
                            <v-col>
                                <v-text-field
                                    v-model="form.personalnummer"
                                    hide-details="auto"
                                    label="Personalnummer"
                                    outlined
                                    required
                                    type="text"
                                    :error-messages="errors.personalnummer"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <v-text-field
                                    v-model="form.organisation"
                                    hide-details="auto"
                                    label="Organisation"
                                    outlined
                                    required
                                    type="text"
                                    :error-messages="errors.organisation"
                                ></v-text-field>
                            </v-col>
                            <v-col>
                                <v-text-field
                                    v-model="form.password"
                                    hide-details="auto"
                                    label="Neues Passwort"
                                    outlined
                                    required
                                    type="text"
                                    :error-messages="errors.password"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                    </v-card-text>

                    <v-card-actions>

                        <v-btn text color="red" @click="destroy">Helfer Löschen</v-btn>

                        <v-spacer></v-spacer>

                        <v-btn text type="submit">Helfer Aktualisieren</v-btn>
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
        helfer: Object,
    },

    data() {
        return {
            photoPreview: null,
            sending: false,
            items_qualifikation: ['EH', 'SanC', 'RH', 'RS', 'RA', 'NFS', 'Arzt', 'NA'],
            items_qualifikation_value : ['EH', 'SanC', 'RH', 'RS', 'RA', 'NFS', 'Arzt', 'NA'],

            form: {
                vorname: this.helfer.vorname,
                nachname: this.helfer.nachname,
                email: this.helfer.email,
                password: this.helfer.password,
                organisation: this.helfer.organisation,
                geburtsdatum: this.helfer.geburtsdatum,
                personalnummer: this.helfer.personalnummer,
                qualifikation: this.helfer.qualifikation,
            },
        }
    },

    methods: {

        submit() {
            this.$inertia.put(this.route('helfer.update', this.helfer.id), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },

        destroy() {
            if (confirm('Möchten Sie diesen Benutzer wirklich löschen?')) {
                this.$inertia.delete(this.route('helfer.destroy', this.helfer.id))
            }
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },


        updatePhotoPreview(e) {

            this.form.img = e.target.files[0]

            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deletePhoto() {
            // ToDo Funktion erstellen
        },

    },

}
</script>
