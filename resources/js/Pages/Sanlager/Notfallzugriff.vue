<template>
    <app-layout>
        <template #header>
            <h2>
                Sanlager / Notfallzugirff
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto px-sm-6 px-sm-8">
                    <v-container>

                        <h2>DRK Ausweiß Barcode scannen</h2>

                        <br>

                        <!-- Docs barcode-reader: https://github.com/olefirenko/vue-barcode-reader -->
                        <StreamBarcodeReader
                            @decode="(a, b, c) => onDecode(a, b, c)"
                            @loaded="() => onLoaded()"
                        ></StreamBarcodeReader>
                        Input Value: {{ text || "Nothing" }}

                    </v-container>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import { StreamBarcodeReader } from "vue-barcode-reader";


export default {
    components: {
        AppLayout,
        StreamBarcodeReader,
    },
    data() {
        return {
            text: "",
            id: null,
        };
    },

    methods: {
        onDecode(a, b, c) {
            console.log(a, b, c);
            this.text = a;
            if (this.id) clearTimeout(this.id);
            this.id = setTimeout(() => {
                if (this.text === a) {
                    this.text = "";
                }
            }, 5000);
        },
        onLoaded() {
            console.log("load");
        },

    }

}
</script>
