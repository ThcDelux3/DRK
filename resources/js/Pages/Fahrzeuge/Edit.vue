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
            photoPreview: null,

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
