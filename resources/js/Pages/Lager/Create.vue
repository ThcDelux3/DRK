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
                                        v-model="form.name"
                                        :error-messages="errors.name"
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
                                        :error-messages="errors.ablaufdatum"
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
                                        :error-messages="errors.anzahl"
                                        hide-details="auto"
                                        label="Anzahl"
                                        outlined
                                        required
                                        type="number"
                                    ></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-autocomplete
                                        v-model="form.lagerort"
                                        :error-messages="errors.lagerort"
                                        :items="items_lagerort"
                                        label="Lagerort"
                                        outlined
                                        hide-details="auto"
                                    ></v-autocomplete>
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

    props: {
        errors: Object,
    },

    data() {

        return {

            photoPreview: null,

            items_lagerort: ['Schrank Atmung', 'Schrank Verbände', 'Schrank Kreislauf'],

            form: this.$inertia.form({
                name: '',
                ablaufdatum: '',
                anzahl: '',
                lagerort: '',
                img: null,
                photo: null,
            }),
        }
    },

    methods: {

        submit() {

            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }

            this.$inertia.post(this.route('lager.store'), this.form, {
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
