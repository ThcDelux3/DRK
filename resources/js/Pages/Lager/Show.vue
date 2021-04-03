<template>
    <app-layout>
        <template #header>
            <h2>
                Lager
            </h2>
        </template>

        <v-btn class="d-none"></v-btn>

        <v-container>

            <v-row justify="space-between">
                <inertia-link :href="route('lager.notfallzugriff')" as="v-btn" color="error">
                    Notfallzugriff
                </inertia-link>

                <inertia-link :href="route('lager.create')" as="v-btn" outlined>
                    Artikel Anlegen
                </inertia-link>
            </v-row>

            <v-row>
                <v-col>
                    <v-data-table
                        :sort-by.sync="sortBy"
                        :headers="headers"
                        :items="lager"
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
                                @click="editItem(item.id)"
                                small
                                class="mr-2"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                @click="deleteItem(item.id)"
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
        lager: Array,
    },

    data: () => ({

        sortBy: 'name',
        search: '',

        headers: [
            {text: '', value: 'img', sortable: false},
            {text: 'Name', value: 'name'},
            {text: 'Ablaufdatum', value: 'ablaufdatum'},
            {text: 'Anzahl', value: 'anzahl'},
            {text: 'Schrank', value: 'schrank'},
            {text: 'Actions', value: 'actions', sortable: false },

        ]
    }),


    watch: {},

    computed: {

    },

    methods: {

        editItem (item) {
            this.$inertia.get('/lager/'+ item + '/edit')
        },

        deleteItem (item) {
            if (confirm('Möchten Sie diesen Artikel wirklich löschen?')) {
                this.$inertia.delete(this.route('lager.destroy', item))
            }
        },

    },

}
</script>
