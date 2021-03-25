<template>
    <v-app>
        <v-app-bar
            app
            color="white"
            flat
            >
            <v-container class="py-0 px-0 fill-height">

                <inertia-link href="/" >
                    <v-img
                        src="img/logo.png"
                        max-width="90"
                        contain
                    ></v-img>
                </inertia-link>

                <v-spacer></v-spacer>

                <!--Hidden button to use interia-link as vuetify button-->
                <v-btn class="d-none"></v-btn>

                <inertia-link v-if="$page.props.user" href="/dashboard" text as="v-btn" text>
                    Dashboard
                </inertia-link>

                <inertia-link v-if="!route().current('login') && !route().current('register') && !$page.props.user" :href="route('login')"
                    as="v-btn" text>
                    Login
                </inertia-link>

                <inertia-link v-if="!route().current('login') && !route().current('register') && !$page.props.user"  :href="route('register')"
                    as="v-btn" color="primary" class="ml-2" text>
                    Register
                </inertia-link>

                <div v-if="route().current('login') || route().current('register')">
                        <div key="registerLink" v-if="route().current('login')"><inertia-link :href="route('register')" as="v-btn" text>Register</inertia-link></div>
                        <div key="loginLink" v-else><inertia-link :href="route('login')" as="v-btn" text>Login</inertia-link></div>
                </div>

            </v-container>

        </v-app-bar>

        <v-main class="mt-6" backgorun>
            <slot />
        </v-main>

        <v-footer
            padless>
            <v-row justify="center" no-gutters>
                <v-col class="py-4 text-center" cols="12">
                    © DRK Ortsverein Villingen e.V. by <!--2021 - --> {{ new Date().getFullYear() }} <a href="https://felixruby.de" target="_blank">Felix Ruby</a>
                </v-col>
            </v-row>
        </v-footer>
    </v-app>
</template>

<style>
main.v-main {
    background-color: #f3f4f6;
}
</style>
