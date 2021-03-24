<template>
    <div>

        <v-text-field clearable prepend-icon="mdi-magnify" type="text" placeholder="Nach Helfer suchen..." v-model="query" v-on:keyup="autoComplete"></v-text-field>

        <div class="panel-footer" v-if="results.length">

            <v-list three-line>
                <template v-for="result in results">

                        <v-list-item @click="this.$emit('clicked', 1)">
                            <v-list-item-content>
                                <v-list-item-title v-html="result.vorname + ' ' + result.nachname"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                    <v-divider inset></v-divider>

                </template>
            </v-list>

        </div>
    </div>
</template>
<script>
export default {

    data(){

        return {
            query: '',
            results: [],
        }
    },
    methods: {
        autoComplete(){
            this.results = [];
            if(this.query.length > 2){
                axios.get('/search',{params: {query: this.query}}).then(response => {
                    this.results = response.data;
                });
            }
        },

    }
}
</script>
