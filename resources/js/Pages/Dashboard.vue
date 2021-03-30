<template>
    <app-layout>
        <template #header>
            <h2>
                Dashboard
            </h2>
        </template>

        <v-container>

            <h2>Sanlger Abgelaufen</h2>
            <v-data-table
                :headers="h"
                :items="h"
                :items-per-page="5"
                class="elevation-1"
            ></v-data-table>
            <h2>Sanlger Nachfüllen</h2>
            <v-data-table
                :headers="h"
                :items="h"
                :items-per-page="5"
                class="elevation-1"
            ></v-data-table>

            <br>


            <h2>Sanlger Notfallzugriffe</h2>

            <v-data-table
                :headers="headers"
                :items="accesses"
                :items-per-page="5"
                class="elevation-1"
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

    data() {
        return {

            items: [],
            item: [],
            model: null,
            search: null,

            query: '',

            headers: [

                {text: 'Name', value: 'name'},
                {text: 'Zugriffszeit', value: 'time'},
            ],

            accesses: [
                {
                    name: 'Felix Ruby',
                    time: '04.03.2021 12:00',
                },
                {
                    name: 'Felix Ruby',
                    time: '04.03.2021 12:05',
                },
            ],

        }
    },

    watch: {
        search(val) {

            axios.get('/search', {params: {query: val}}).then(response => {

                for (var i = 0; i < response.data.length; i++) {
                    response.data[i].name = response.data[i].vorname + ' ' + response.data[i].nachname;
                }

                this.items = response.data;


            });

        },
    },


}
</script>
