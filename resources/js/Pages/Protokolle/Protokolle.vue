<template>
    <app-layout>
        <template #header>
            <h2>
                Protokolle
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto px-sm-6 px-sm-8">

                <!--Hidden button to use interia-link as vuetify button-->
                <v-btn class="d-none"></v-btn>

                <v-container fluid>
                    <v-row dense>
                        <v-col
                        >
                            <v-card>
                                <v-img
                                    src="/img/einsatzprotokoll.PNG"
                                    class="white--text align-end"
                                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                                    height="200px"
                                >
                                    <v-card-title>Einsatz-Protokoll</v-card-title>
                                </v-img>

                                <v-card-actions>

                                    <inertia-link as="v-btn" text :href="route('protokolle.einsatzprotokoll')">Erstellen</inertia-link>

                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
export default {
    data: () => ({
    }),
    components: {
        AppLayout,
    },
}
</script>
