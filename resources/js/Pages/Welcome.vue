<template>
  <guest-layout>

          <v-container>
              <v-row justify="center" class="py-4 mb-10 pt-0" align="center">
                  <v-col cols="12" md="10" order="first" class="align-center pr-6 ">
                      <h1 class="text-h4 text-sm-h3 text-lg-h2 mt-xl-4 font-weight-black">DRK Ortsverein Villingen e.V. <span class="primary--text">App</span></h1>
                      <h2 class="text-h6 text-sm-h5 secondary--text mt-4 pr-6">Protokolle, Sanlager, ...</h2>
                      <v-btn x-large color="secondary" class="mt-6">
                          Los gehts
                      </v-btn>
                  </v-col>
              </v-row>
          </v-container>


  </guest-layout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ValidationErrors from '@/Components/ValidationErrors';

export default {
  components: {
    GuestLayout,
    ValidationErrors,
  },
  data() {
    return {
      signUpEmail: false,
      showP: false,
      showCP: false,
      form: this.$inertia.form({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
      })
    }
  },

  methods: {
    submit() {
      this.form.password_confirmation = this.form.password;
      this.form.post(this.route('register'), {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      })
    }
  }
}
</script>
