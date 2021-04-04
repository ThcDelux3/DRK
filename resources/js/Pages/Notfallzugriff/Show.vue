<template>
    <guest-layout>

        <v-container>
                <v-card>

                    <v-card-title>
                        <h2>DRK Auweiss Login</h2>

                    </v-card-title>

                    <v-card-text>

                        <form @submit.prevent="sendPersonalnummer">
                            <v-text-field
                                v-model="data.personalnummer"
                                outlined
                                label="Handscanner"
                            ></v-text-field>
                        </form>

                        <v-divider></v-divider>
                        <br>

                        <!-- Docs barcode-reader: https://github.com/olefirenko/vue-barcode-reader -->
                        <StreamBarcodeReader
                            @decode="onDecode"
                        ></StreamBarcodeReader>

                    </v-card-text>

                </v-card>

        </v-container>

    </guest-layout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { StreamBarcodeReader } from "vue-barcode-reader";

export default {
    components: {
        GuestLayout,
        StreamBarcodeReader
    },

    data() {
        return {
            data: {
                personalnummer: '',
            },
        }
    },

    methods: {

        sendPersonalnummer() {
            this.$inertia.post(this.route('ausweisslogin.checkpersonalnummer'), this.data);
        },

        onDecode(result) {
            this.data.personalnummer = result
            this.$inertia.post(this.route('ausweisslogin.checkpersonalnummer'), this.data);
        },

    }
}
</script>
