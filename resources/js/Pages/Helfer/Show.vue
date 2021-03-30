<template>
    <app-layout>
        <template #header>
            <h2>
                Helfer
            </h2>
        </template>


        <v-btn class="d-none"></v-btn>

        <v-container>

            <v-row>
                <v-spacer></v-spacer>
                <inertia-link :href="route('helfer.create')" as="v-btn" outlined>
                    Helfer Anlegen
                </inertia-link>
            </v-row>

            <v-row>
                <v-col>
                    <v-data-table
                        :sort-by.sync="sortBy"
                        :headers="headers"
                        :items="users"
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
        users: Array,
    },

    data: () => ({

        sortBy: 'nachname',
        search: '',

        headers: [
            {text: 'Vorname', value: 'vorname'},
            {text: 'Nachname', value: 'nachname'},
            {text: 'Personalnummer', value: 'personalnummer'},
            {text: 'Qualifikation', value: 'qualifikation'},
            {text: 'Email', value: 'email'},
            {text: 'Actions', value: 'actions', sortable: false },

        ]
    }),

    watch: {},

    computed: {

    },

    methods: {

        editItem (item) {
            this.$inertia.get('/helfer/'+ item['id'] + ' /edit')
        },

        deleteItem (item) {
            if (confirm('Möchten Sie diesen Benutzer wirklich löschen?')) {
                this.$inertia.delete(this.route('helfer.destroy', item['id']))
            }
        },

    },

}
</script>
