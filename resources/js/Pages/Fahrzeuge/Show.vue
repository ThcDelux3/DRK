<template>
    <app-layout>
        <template #header>
            <h2>
                Fahrzeuge
            </h2>
        </template>

        <v-btn class="d-none"></v-btn>

        <v-container>

            <v-row>
                <v-spacer></v-spacer>
                <inertia-link :href="route('fahrzeuge.create')" as="v-btn" outlined>
                    Fahrzeug Anlegen
                </inertia-link>
            </v-row>

            <v-row>
                <v-col>
                    <v-data-table
                        :sort-by.sync="sortBy"
                        :headers="headers"
                        :items="fahrzeuge"
                        :items-per-page="10"
                        class="elevation-1"
                        :search="search"
                    >

                        <template v-slot:top>
                            <v-text-field
                                v-model="search"
                                prepend-icon="mdi-magnify"
                                label="Suche"
                                single-line
                                hide-details
                                class="mx-4"
                                clearable
                            ></v-text-field>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                @click="editItem(item)"
                                small
                                class="mr-2"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                @click="deleteItem(item)"
                                small
                            >
                                mdi-delete
                            </v-icon>
                        </template>

                        <template v-slot:item.img="{ item }">
                            <v-img left width="100px" :src="item.img"></v-img>
                        </template>

                    </v-data-table>
                </v-col>
            </v-row>


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
        fahrzeuge: Array,
    },

    data: () => ({

        sortBy: 'funkrufname',
        search: '',

        headers: [
            {text: '', value: 'img'},
            {text: 'Funkrufname', value: 'funkrufname'},
            {text: 'Kennzeichen', value: 'kennzeichen'},
            {text: 'Fahrzeugart', value: 'fahrzeugart'},
            {text: 'Actions', value: 'actions', sortable: false },

        ]
    }),


    watch: {},

    computed: {

    },

    methods: {

        editItem (item) {
            this.$inertia.get('/fahrzeuge/'+ item.id + ' /edit')
        },

        deleteItem (item) {
            if (confirm('Möchten Sie das Fahrzeug ' + item.kennzeichen + ' wirklich löschen?')) {
                this.$inertia.delete(this.route('fahrzeuge.destroy', item.id))
            }
        },

    },

}
</script>
