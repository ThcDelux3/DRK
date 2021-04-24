<template>
    <app-action-section>
        <template #title>
            Zwei-Faktor-Authentifizierung
        </template>

        <template #description>
            Fügen Sie Ihrem Konto zusätzliche Sicherheit hinzu, indem Sie die Zwei-Faktor-Authentifizierung verwenden.
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900" v-if="twoFactorEnabled">
                Sie haben die Zwei-Faktor-Authentifizierung aktiviert.
            </h3>

            <h3 class="text-lg font-medium text-gray-900" v-else>
                Sie haben die Zwei-Faktor-Authentifizierung nicht aktiviert.
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    Wenn die Zwei-Faktor-Authentifizierung aktiviert ist, werden Sie während der Authentifizierung zur Eingabe eines sicheren, zufälligen Tokens aufgefordert. Sie können dieses Token aus der Google Authenticator-Anwendung Ihres Telefons abrufen.                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Die Zwei-Faktor-Authentifizierung ist jetzt aktiviert. Scannen Sie den folgenden QR-Code mit der Authentifizierungsanwendung Ihres Telefons.
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode">
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4">
                        <p class="font-semibold">
                            Speichern Sie diese Wiederherstellungscodes in einem sicheren Kennwortmanager. Sie können verwendet werden, um den Zugriff auf Ihr Konto wiederherzustellen, wenn Ihr Zwei-Faktor-Authentifizierungsgerät verloren geht.
                        </p>
                    </div>

                    <div class="mt-4 px-4 py-4 font-mono text-sm bg-blue-grey lighten-4 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <app-confirms-password @confirmed="enableTwoFactorAuthentication">
                        <v-btn :class="{ 'opacity-25': enabling }" :disabled="enabling">
                            Enable
                        </v-btn>
                    </app-confirms-password>
                </div>

                <div v-else>
                    <app-confirms-password @confirmed="regenerateRecoveryCodes">
                        <v-btn outlined class="mr-3"
                                        v-if="recoveryCodes.length > 0">
                            Wiederherstellungscodes neu generieren
                        </v-btn>
                    </app-confirms-password>

                    <app-confirms-password @confirmed="showRecoveryCodes">
                        <v-btn outlined class="mr-3" v-if="recoveryCodes.length === 0">
                            Wiederherstellungscodes anzeigen
                        </v-btn>
                    </app-confirms-password>

                    <app-confirms-password @confirmed="disableTwoFactorAuthentication">
                        <v-btn color="red"
                            :class="{ 'opacity-25': disabling }"
                            :disabled="disabling">
                            Disable
                        </v-btn>
                    </app-confirms-password>
                </div>
            </div>
        </template>
    </app-action-section>
</template>

<script>
    import AppActionSection from '@/Components/ActionSection'
    import AppConfirmsPassword from '@/Components/ConfirmsPassword'

    export default {
        components: {
            AppActionSection,
            AppConfirmsPassword,
        },

        data() {
            return {
                enabling: false,
                disabling: false,

                qrCode: null,
                recoveryCodes: [],
            }
        },

        methods: {
            enableTwoFactorAuthentication() {
                this.enabling = true

                this.$inertia.post('/user/two-factor-authentication', {}, {
                    preserveScroll: true,
                    onSuccess: () => Promise.all([
                        this.showQrCode(),
                        this.showRecoveryCodes(),
                    ]),
                    onFinish: () => (this.enabling = false),
                })
            },

            showQrCode() {
                return axios.get('/user/two-factor-qr-code')
                        .then(response => {
                            this.qrCode = response.data.svg
                        })
            },

            showRecoveryCodes() {
                return axios.get('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.recoveryCodes = response.data
                        })
            },

            regenerateRecoveryCodes() {
                axios.post('/user/two-factor-recovery-codes')
                        .then(response => {
                            this.showRecoveryCodes()
                        })
            },

            disableTwoFactorAuthentication() {
                this.disabling = true

                this.$inertia.delete('/user/two-factor-authentication', {
                    preserveScroll: true,
                    onSuccess: () => (this.disabling = false),
                })
            },
        },

        computed: {
            twoFactorEnabled() {
                return ! this.enabling && this.$page.props.user.two_factor_enabled
            }
        }
    }
</script>
