<template>
  <guest-layout>
      <v-container fill-height fluid>
          <v-card class="mx-auto" width="450px">
          <v-card-title>Forgot password?</v-card-title>
          <v-card-subtitle>No problem.</v-card-subtitle>
          <v-card-text>
            <div class="mb-6">
              Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>


            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <validation-errors class="mb-4" />

            <form @submit.prevent="submit">
              <v-text-field dense outlined label="Email Address" required autofocus
                type="email" v-model="form.email"></v-text-field>

              <v-btn block color="primary" type="submit" :disabled="form.processing"> Request Password Reset</v-btn>

            </form>
          </v-card-text>

              <v-card-actions>
                  <inertia-link :href="route('login')" as="v-btn" text>Login?</inertia-link>
                  <inertia-link :href="route('register')" as="v-btn" text>Register?</inertia-link>
              </v-card-actions>

        </v-card>
      </v-container>
    <v-sheet class="" color="gray pulse" width="200px">
    </v-sheet>
  </guest-layout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ValidationErrors from '@/Components/ValidationErrors';

export default {
  components: {
    GuestLayout,
    ValidationErrors
  },

  props: {
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
          email: '',
      }),
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('password.email'))
    }
  }
}
</script>
