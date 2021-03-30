<template>
    <app-layout>
        <template #header>
            <h2>
                Sanlager
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto px-sm-6 px-sm-8">
                <div class="">
                    <v-container>

                        <!--Hidden button to use interia-link as vuetify button-->
                        <v-btn class="d-none"></v-btn>

                        <inertia-link as="v-btn" class="red white--text" :href="route('sanlager.notfallzugriff')">Notfallzugriff</inertia-link>

                    </v-container>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
export default {
    components: {
        AppLayout,
    },
}
</script>
