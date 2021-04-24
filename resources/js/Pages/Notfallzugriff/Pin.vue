<template>
    <guest-layout>
        <v-container>

            <v-card>

                <v-card-title>
                    <h2>DRK Auweiss Login / Pin</h2>

                </v-card-title>

                <v-card-text>
                    <form @submit.prevent="sendPin">
                        <v-text-field
                            v-model="data.pin"
                            :error-messages="errors.pin"
                            counter
                            maxlength="6"
                            label="Pin"
                            type="number"
                            outlined
                            autocomplete="off"
                        ></v-text-field>
                    </form>
                </v-card-text>

            </v-card>

        </v-container>

    </guest-layout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';

export default {

    props:  {
        userdata: Object,
        errors: Object,
    },

    components: {
        GuestLayout,
    },

    data() {
        return {
            data: {
                pin: '',
                userid: this.userdata[0].id,
            },
        }
    },

    methods: {
        sendPin() {
            this.$inertia.post(this.route('ausweisslogin.checkpin'), this.data);
        },

    }

}
</script>
