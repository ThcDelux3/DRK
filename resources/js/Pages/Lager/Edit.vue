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
                                <v-text-field
                                    v-model="form.schrank"
                                    :error-messages="errors.schrank"
                                    hide-details="auto"
                                    label="Schrank"
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
            photoPreview: null,

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

            this.$inertia.post(this.route('lager.update', this.lager.id), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
                onSuccess: () => this.form.reset("photo"),
            })
        },

        destroy() {
            if (confirm('Möchten Sie diesen Artikel wirklich löschen?')) {
                this.$inertia.delete(this.route('lager.destroy', this.lager.id))
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
