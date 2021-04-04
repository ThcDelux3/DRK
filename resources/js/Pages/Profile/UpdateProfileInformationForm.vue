<template>
    <app-form-section @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="mb-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" style="display: none;"
                    ref="photo"
                    @change="updatePhotoPreview">

                <!-- New Profile Photo Preview -->
                <v-avatar size="80">
                    <img :src="photoPreview" v-if="photoPreview">
                    <img :src="user.profile_photo_url" :alt="user.name" v-else>

                </v-avatar>

                <v-btn class="ml-3 mt-2 mr-2" outlined color="info" @click.native.prevent="selectNewPhoto">
                    Select A New Photo
                </v-btn>
                <v-btn class="mt-2" outlined color="info" @click.native.prevent="deletePhoto" v-if="user.profile_photo_path">
                    Remove Photo
                </v-btn>

            </div>

            <!-- Vorname -->
            <v-text-field
                label="Vorname"
                type="text"
                outlined autocomplete="given-name"
                 v-model="form.vorname"
                :error-messages="form.errors.vorname"></v-text-field>

            <!-- Nachname -->
            <v-text-field
                label="Nachname"
                type="text"
                outlined autocomplete="family-name"
                v-model="form.nachname"
                :error-messages="form.errors.nachname"></v-text-field>

            <!-- Perosnalnummer -->
            <v-text-field
                label="Personalnummer"
                type="text"
                outlined
                v-model="form.personalnummer"
                disabled
                :error-messages="form.errors.personalnummer"></v-text-field>

            <!-- Qualifikation -->
            <v-text-field
                label="Qualifikation"
                type="text"
                outlined
                v-model="form.qualifikation"
                disabled
                :error-messages="form.errors.qualifikation"></v-text-field>


            <!-- Email -->
            <v-text-field
                label="Email"
                type="email"
                outlined autocomplete="email"
                v-model="form.email"
                :error-messages="form.errors.email"></v-text-field>

            <!-- Geburtsdatum -->
            <v-text-field
                label="Geburtsdatum"
                type="date"
                outlined autocomplete="bday"
                v-model="form.geburtsdatum"
                :error-messages="form.errors.geburtsdatum"></v-text-field>

            <!-- Pin -->
            <v-text-field
                counter
                maxlength="6"
                label="Pin"
                type="number"
                outlined autocomplete="off"
                v-model="form.pin"
                :error-messages="form.errors.pin"></v-text-field>

        </template>

        <template #actions>
            <transition

                leave-active-class="transition ease-in duration-1000"
                leave-class="opacity-100"
                leave-to-class="opacity-0">
                <div v-show="form.recentlySuccessful" class="text-sm text-gray-600">
                    Saved.
                </div>
            </transition>

            <v-btn class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" color="secondary">
                Save
            </v-btn>
        </template>
    </app-form-section>
</template>

<script>
    import AppFormSection from '@/Components/FormSection'

    export default {
        components: {
            AppFormSection,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    vorname: this.user.vorname,
                    nachname: this.user.nachname,
                    personalnummer: this.user.personalnummer,
                    geburtsdatum: this.user.geburtsdatum,
                    qualifikation: this.user.qualifikation,
                    email: this.user.email,
                    pin: this.user.pin,
                    photo: null,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => (this.photoPreview = null),
                });
            },
        },
    }
</script>
