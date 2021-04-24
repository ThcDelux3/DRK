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
            photoPreview: null,
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
