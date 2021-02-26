<template>
    <v-app>
        <v-app-bar
            id="app-nav"
            app
            color="white"
            fixed
        >

            <v-container class="py-0 px-0 fill-height">


                <v-app-bar-nav-icon class="hidden-sm-and-up"
                                    @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

                <!-- Logo -->
                <inertia-link :href="route('dashboard')">
                    <v-img
                        contain
                        max-width="90"
                        src="/img/logo.png"
                    ></v-img>
                </inertia-link>

                <transition name="fade">
                    <v-toolbar-item v-if="$slots.header && scrolled" class="text-capitalize ml-5"
                                    transition="scroll-y-transition">
                        <slot name="header"/>
                    </v-toolbar-item>
                </transition>

                <!-- Navigation Links -->
                <v-spacer></v-spacer>


                <inertia-link :active="route().current('dashboard')" :href="route('dashboard')" as="v-btn"
                              class="text-capitalize d-none d-sm-flex"
                              text>
                    Dashboard
                </inertia-link>

                <inertia-link :active="route().current('sanlager')" :href="route('sanlager')" as="v-btn"
                              class="text-capitalize d-none d-sm-flex"
                              text>
                    Sanlager
                </inertia-link>

                <inertia-link :active="route().current('protokolle')" :href="route('protokolle')" as="v-btn"
                              class="text-capitalize d-none d-sm-flex"
                              text>
                    Protokolle
                </inertia-link>

                <v-spacer></v-spacer>

                <!-- Teams Dropdown -->
                <v-menu
                    v-if="$page.props.jetstream.hasTeamFeatures"
                    min-width="240"
                    offset-y
                    transition="slide-y-transition">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            v-bind="attrs"
                            v-on="on"
                            class="text-capitalize d-none d-sm-flex"
                            text
                        >
                            {{ $page.props.user.current_team.name }}
                            <svg fill="currentColor" style="width: 1rem; height: 1rem;"
                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </v-btn>
                    </template>
                    <v-list dense>
                        <v-subheader>Manage Team</v-subheader>
                        <inertia-link :href="route('teams.show', $page.props.user.current_team)" as="v-list-item">
                            Team Settings
                        </inertia-link>
                        <inertia-link v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')"
                                      as="v-list-item">
                            Create New Team
                        </inertia-link>

                        <v-subheader>Switch Teams</v-subheader>
                        <template v-for="team in $page.props.user.all_teams">
                            <v-list-item :key="team.id" @click.prevent="switchToTeam(team)">
                                <v-list-item-icon v-if="team.id == $page.props.user.current_team_id">
                                    <v-icon style="color: rgba(52, 211, 153, 1); ">mdi-check-circle-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-title>{{ team.name }}</v-list-item-title>
                            </v-list-item>
                        </template>
                    </v-list>
                </v-menu>

                <!-- Settings Dropdown -->
                <v-menu
                    min-width="200"
                    offset-y
                    transition="slide-y-transition">
                    <template v-slot:activator="{ on, attrs }">
                        <v-avatar v-if="$page.props.jetstream.managesProfilePhotos" v-bind="attrs"
                                  v-on="on">
                            <img :alt="$page.props.user.name" :src="$page.props.user.profile_photo_url">
                        </v-avatar>
                        <v-btn
                            v-else
                            v-bind="attrs"
                            v-on="on"
                            class="text-capitalize d-none d-sm-flex"
                            text
                        >
                            {{ $page.props.user.name }}

                            <svg class=" -mr-0.5 "
                                 fill="currentColor" style="width: 1.rem; height: 1rem; "
                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </v-btn>
                    </template>
                    <v-list dense>
                        <v-subheader>Manage Account</v-subheader>
                        <inertia-link :href="route('profile.show')" as="v-list-item"
                                      class="v-list-item">
                            Profile
                        </inertia-link>
                        <inertia-link v-if="$page.props.jetstream.hasApiFeatures"
                                      :href="route('api-tokens.index')" as="v-list-item">
                            API Tokens
                        </inertia-link>
                        <v-divider/>
                        <!-- Authentication -->
                        <v-list-item @click.prevent="logout">
                            Logout
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-container>


        </v-app-bar>

        <!-- Responsive Navigation Menu -->
        <v-navigation-drawer
            v-model="drawer"
            :mini-variant="mini"
            app
        >
            <v-list
                dense
                nav
                shaped
            >
                <v-list-item-group
                >
                    <v-list-item class="pt-2 pb-4 pl-0">
                        <v-list-item-avatar>
                            <img :alt="$page.props.user.name" :src="$page.props.user.profile_photo_url"/>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <div>{{ $page.props.user.name }}</div>
                            <div class="text--secondary">{{ $page.props.user.email }}</div>
                        </v-list-item-content>
                    </v-list-item>

                    <inertia-link :active="route().current('dashboard')" :href="route('dashboard')" as="v-list-item">
                        <v-list-item-icon>
                            <v-icon>mdi-view-dashboard</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Dashboard</v-list-item-title>
                    </inertia-link>

                    <inertia-link :active="route().current('sanlager')" :href="route('sanlager')" as="v-list-item">
                        <v-list-item-icon>
                            <v-icon>mdi-view-column-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Sanlager</v-list-item-title>
                    </inertia-link>

                    <inertia-link :active="route().current('protokolle')" :href="route('protokolle')" as="v-list-item">
                        <v-list-item-icon>
                            <v-icon>mdi-file-document-edit</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Protokolle</v-list-item-title>
                    </inertia-link>

                    <!-- API Management -->
                    <inertia-link v-if="$page.props.jetstream.hasApiFeatures"
                                  :active="route().current('api-tokens.index')"
                                  :href="route('api-tokens.index')"
                                  as="v-list-item">
                        <v-list-item-icon>
                            <v-icon>mdi-api</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>API Tokens</v-list-item-title>
                    </inertia-link>
                    <v-divider/>

                    <!-- Team Management -->
                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                        <v-subheader v-if="mini">MT</v-subheader>
                        <v-subheader v-else>Manage Team</v-subheader>

                        <inertia-link :active="route().current('teams.show')"
                                      :href="route('teams.show', $page.props.user.current_team)"
                                      as="v-list-item">
                            <v-list-item-icon>
                                <v-icon>mdi-account-multiple-outline</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>Team Settings</v-list-item-title>
                        </inertia-link>
                        <inertia-link :active="route().current('teams.create')" :href="route('teams.create')"
                                      as="v-list-item">
                            <v-list-item-icon>
                                <v-icon>mdi-account-multiple-plus-outline</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>Create New Team</v-list-item-title>
                        </inertia-link>

                        <v-subheader v-if="mini">ST</v-subheader>
                        <v-subheader v-else>Switch Teams</v-subheader>

                        <template v-for="team in $page.props.user.all_teams">
                            <v-list-item :key="team.id" @click.prevent="switchToTeam(team)">
                                <v-list-item-icon v-if="team.id == $page.props.user.current_team_id">
                                    <v-icon style="color: rgba(52, 211, 153, 1); ">mdi-check-circle-outline</v-icon>
                                </v-list-item-icon>
                                <v-list-item-title>{{ team.name }}</v-list-item-title>
                            </v-list-item>
                        </template>
                        <v-divider/>
                    </template>

                    <v-subheader v-if="mini">AC</v-subheader>
                    <v-subheader v-else>Account</v-subheader>

                    <inertia-link :active="route().current('profile.show')" :href="route('profile.show')"
                                  as="v-list-item">
                        <v-list-item-icon>
                            <v-icon>mdi-account</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Profile</v-list-item-title>
                    </inertia-link>

                    <v-list-item @click.prevent="logout">
                        <v-list-item-icon>
                            <v-icon>mdi-exit-run</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item>
                </v-list-item-group>

                <v-divider/>
                <div class="text-center">
                    <v-btn icon large @click="mini = !mini">

                        <v-icon v-if="mini">mdi-chevron-right</v-icon>
                        <v-icon v-else>mdi-chevron-left</v-icon>
                    </v-btn>
                </div>
            </v-list>
        </v-navigation-drawer>

        <v-main v-scroll="onScroll">
            <v-container class="pt-7">
                <header v-if="$slots.header" id="pageheader">
                    <slot name="header"/>
                </header>

                <slot/>
            </v-container>
        </v-main>

    </v-app>
</template>


<script>

export default {
    components: {},

    data() {
        return {
            drawer: false,
            mini: false,
            showingNavigationDropdown: true,
            scrolled: false,
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('logout'));
        },

        onScroll(e) {
            const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop    // Because of momentum scrolling on mobiles, we shouldn't continue if it is less than zero
            if (currentScrollPosition < 0) {
                return
            }
            if (currentScrollPosition > 60) {
                this.scrolled = true;
            } else {
                this.scrolled = false;
            }
        }
    }
}
</script>

<style>
main.v-main {
    background-color: #f3f4f6;
}

.v-app-bar .v-btn.v-btn--text {
    text-transform: capitalize;
    font-weight: 400;
}

#app-nav v-toolbar-item.text-capitalize.ml-5 h2 {
    color: rgba(0, 0, 0, 0.6) !important;
}

#pageheader {
    line-height: 1.25;
    font-size: 1.5rem;
    padding-left: 2.5rem;
}

#pageheader h2 {
    color: #424242 !important;
    caret-color: #424242 !important;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
{
    opacity: 0;
}

</style>
