<template>
    <app-layout>
        <template #header>
            <h2>
                Dashboard
            </h2>
        </template>

        <v-container>

            <v-row>

                <v-col>
                    <h2>Sanlger Abgelaufen</h2>
                    <v-data-table
                        :headers="sanlager_abgelaufen_header"
                        :items="sanlager_abgelaufen"
                        :items-per-page="5"
                        class="elevation-1"
                    >

                        <template v-slot:item.ablaufdatum="{ item }">
                            <span>{{ new Date(item.ablaufdatum).toLocaleString('DE', options = {year: "numeric", month: "2-digit", day: "numeric"}) }}</span>
                        </template>

                    </v-data-table>
                </v-col>

                <v-col>
                    <h2>Sanlger Nachfüllen</h2>
                    <v-data-table
                        :headers="sanlager_nachfuellen_header"
                        :items="sanlager_nachfuellen"
                        :items-per-page="5"
                        class="elevation-1"
                    >

                        <template v-slot:item.ablaufdatum="{ item }">
                            <span>{{ new Date(item.ablaufdatum).toLocaleString('DE', options = {year: "numeric", month: "2-digit", day: "numeric"}) }}</span>
                        </template>

                    </v-data-table>
                </v-col>


            </v-row>

            <br>

            <h2>Sanlger Notfallzugriffe</h2>

            <v-data-table
                :headers="sanlager_notfallzugriff_header"
                :items="sanlager_notfallzugriff"
                :items-per-page="5"
                class="elevation-1"
                sort-by="zugriffszeit"
                sort-desc="true"
            ></v-data-table>
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
        sanlager_abgelaufen: Array,
        sanlager_nachfuellen: Array,
        sanlager_notfallzugriff: Array,
    },

    data() {
        return {

            loading: true,
            firstLoad: true,


            sanlager_abgelaufen_header: [
                {text: '', value: '', sortable: false},
                {text: 'Name', value: 'name'},
                {text: 'Stückzahl', value: 'anzahl'},
                {text: 'Ablaufdatum', value: 'ablaufdatum'}
            ],
            sanlager_nachfuellen_header: [
                {text: '', value: '', sortable: false},
                {text: 'Name', value: 'name'},
                {text: 'Stückzahl', value: 'anzahl'},
                {text: 'Ablaufdatum', value: 'ablaufdatum'}
            ],
            sanlager_notfallzugriff_header: [
                {text: 'Name', value: 'name', sortable: false},
                {text: 'Zugriffszeit', value: 'zugriffszeit'}
            ],
        }
    },

}
</script>
