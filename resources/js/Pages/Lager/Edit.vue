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
                                <img :src="form.img_path" :alt="form.name" v-else>

                            </v-avatar>

                            <v-btn class="ml-3 mt-2 mr-2" outlined color="info" @click.native.prevent="selectNewPhoto">
                                Wählen Sie ein neues Foto                            </v-btn>
                            <v-btn class="mt-2" outlined color="info" @click.native.prevent="deletePhoto" v-if="form.img_path">
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
                                    min="0"
                                ></v-text-field>
                            </v-col>
                            <v-col>
                                <v-text-field
                                    v-model="form.mindestbestand"
                                    :error-messages="errors.mindestbestand"
                                    hide-details="auto"
                                    label="Mindestbestand"
                                    outlined
                                    required
                                    type="number"
                                    min="0"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <v-autocomplete
                                    v-model="form.zustand"
                                    :error-messages="errors.zustand"
                                    :items="items_zustand"
                                    label="Zustand"
                                    outlined
                                    hide-details="auto"
                                    clearable
                                ></v-autocomplete>
                            </v-col>
                            <v-col>
                                <v-autocomplete
                                    v-model="form.lagerort"
                                    :error-messages="errors.lagerort"
                                    :items="items_lagerort"
                                    label="Lagerort"
                                    outlined
                                    hide-details="auto"
                                    clearable
                                ></v-autocomplete>
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

            items_lagerort: ['Schrank Atmung', 'Schrank Verbände', 'Schrank Kreislauf'],
            items_zustand: ['einsatzbereit', 'kleiner Mangel', 'defekt', 'verschmutzt', 'verliehen', 'zur Prüfung', 'verschwunden', 'archiviert', 'gesperrt',],

            form: {
                name: this.lager.name,
                ablaufdatum: this.lager.ablaufdatum,
                anzahl: this.lager.anzahl,
                mindestbestand: this.lager.mindestbestand,
                zustand: this.lager.zustand,
                lagerort: this.lager.lagerort,
                img: '',
                img_path: this.lager.img,
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
