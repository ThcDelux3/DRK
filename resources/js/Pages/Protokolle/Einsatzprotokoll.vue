<template>
    <app-layout>
        <template #header>
            <h2>
                Protokolle / Einsatzprotokoll
            </h2>
        </template>


        <form @submit.prevent="submit">

            <v-sheet rounded>
                <v-container>

                    <h2>Einsatz</h2>

                    <v-sheet outlined rounded>
                        <v-container>
                            <v-row>

                                <!--Einsatz Datum-->
                                <v-col
                                    cols="12"
                                    md="3"
                                    sm="6"
                                >
                                    <v-menu
                                        v-model="einsatz_datum_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        min-width="auto"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.einsatz_datum"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Datum"
                                                prepend-inner-icon="mdi-calendar"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="form.einsatz_datum"
                                            @input="einsatz_datum_menu = false"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-col>

                                <!--Einsatz Beginn-->
                                <v-col
                                    cols="12"
                                    md="3"
                                    sm="6"
                                >
                                    <v-menu
                                        ref="einsatz_beginn_menu_menu"
                                        v-model="einsatz_beginn_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.einsatz_beginn_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.einsatz_beginn_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Beginn"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="einsatz_beginn_menu"
                                            v-model="form.einsatz_beginn_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.einsatz_beginn_menu_menu.save(form.einsatz_beginn_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                </v-col>

                                <!--Einsatz Ende-->
                                <v-col
                                    cols="12"
                                    md="3"
                                    sm="6"
                                >
                                    <v-menu
                                        ref="einsatz_ende_menu_menu"
                                        v-model="form.einsatz_ende_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.einsatz_ende_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.einsatz_ende_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Ende"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="form.einsatz_ende_menu"
                                            v-model="form.einsatz_ende_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.einsatz_ende_menu_menu.save(form.einsatz_ende_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                </v-col>

                                <!--Einsatz Nr-->
                                <v-col
                                    cols="12"
                                    md="3"
                                    sm="6"
                                >
                                    <v-text-field
                                        v-model="form.einsatz_nummer"
                                        label="Einsatz Nr."
                                        min="0"
                                        type="number"
                                    ></v-text-field>
                                </v-col>

                                <!--Alarmzeit-->
                                <v-col
                                    cols="12"
                                    md="3"
                                    sm="6"
                                >
                                    <v-menu
                                        ref="einsatz_alarmzeit_menu_menu"
                                        v-model="einsatz_alarmzeit_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.einsatz_alarmzeit_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.einsatz_alarmzeit_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Alarmzeit"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="einsatz_alarmzeit_menu"
                                            v-model="form.einsatz_alarmzeit_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.einsatz_alarmzeit_menu_menu.save(form.einsatz_alarmzeit_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                </v-col>

                                <!--Abfahrzeit (S3)-->
                                <v-col
                                    cols="12"
                                    md="3"
                                    sm="6"
                                >
                                    <v-menu
                                        ref="einsatz_abfahrzeit_menu_menu"
                                        v-model="einsatz_abfahrzeit_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.einsatz_abfahrzeit_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.einsatz_abfahrzeit_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Abfahrzeit (S3)"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="einsatz_abfahrzeit_menu"
                                            v-model="form.einsatz_abfahrzeit_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.einsatz_abfahrzeit_menu_menu.save(form.einsatz_abfahrzeit_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                </v-col>

                                <!--Eintreffzeit (S4)-->
                                <v-col
                                    cols="12"
                                    md="3"
                                    sm="6"
                                >
                                    <v-menu
                                        ref="einsatz_eintreffzeit_menu_menu"
                                        v-model="einsatz_eintreffzeit_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.einsatz_eintreffzeit_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.einsatz_eintreffzeit_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Eintreffzeit (S4) "
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="einsatz_eintreffzeit_menu"
                                            v-model="form.einsatz_eintreffzeit_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.einsatz_eintreffzeit_menu_menu.save(form.einsatz_eintreffzeit_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                </v-col>

                                <!--Frei Einsatzstelle (S9)-->
                                <v-col
                                    cols="12"
                                    md="3"
                                    sm="6"
                                >
                                    <v-text-field
                                        v-model="form.einsatz_frei_einsatzstelle"
                                        label="Frei Einsatzstelle (S9)"
                                    ></v-text-field>
                                </v-col>

                            </v-row>
                        </v-container>
                    </v-sheet>

                    <br>

                    <v-sheet outlined rounded>
                        <v-container>
                            <div class="overline mb-4">
                                Einsatz Anforderung durch:
                            </div>
                            <v-row align="center">

                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatz_checkbox_nach_aao"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="nach AAO"
                                    ></v-checkbox>
                                </v-col>

                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatz_checkbox_manv"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="MANV"
                                    ></v-checkbox>
                                </v-col>

                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatz_checkbox_ee"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="EE"
                                    ></v-checkbox>
                                </v-col>

                                <v-spacer></v-spacer>

                                <v-checkbox
                                    v-model="form.einsatz_checkbox_fw_swd_ab"
                                    class="shrink mr-2 mt-0"
                                    hide-details
                                    label="FW SWD ab:"
                                ></v-checkbox>


                                <v-menu
                                    ref="einsatz_fw_swd_menu_menu"
                                    v-model="einsatz_fw_swd_menu"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    :return-value.sync="form.einsatz_fw_swd_time"
                                    max-width="290px"
                                    min-width="290px"
                                    offset-y
                                    transition="scale-transition"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="form.einsatz_fw_swd_time"
                                            v-bind="attrs"
                                            v-on="on"
                                            label=""
                                            prepend-inner-icon="mdi-clock-time-four-outline"
                                            readonly
                                        ></v-text-field>
                                    </template>
                                    <v-time-picker
                                        v-if="einsatz_fw_swd_menu"
                                        v-model="form.einsatz_fw_swd_time"
                                        format="24hr"
                                        full-width
                                        @click:minute="$refs.einsatz_fw_swd_menu_menu.save(form.einsatz_fw_swd_time)"
                                    ></v-time-picker>
                                </v-menu>
                                uhr

                                <v-spacer></v-spacer>

                                <v-checkbox
                                    v-model="form.einsatz_einsatz_anforderung_checkbox_sonstiges"
                                    class="shrink mr-2 mt-0"
                                    hide-details
                                ></v-checkbox>
                                <v-text-field v-model="form.einsatz_einsatz_anforderung_textfield_sontiges"></v-text-field>
                            </v-row>
                        </v-container>
                    </v-sheet>

                    <br>

                    <v-sheet outlined rounded>
                        <v-container>
                            <v-text-field
                                v-model="form.einsatz_textfield_einsatzort"
                                label="Einsatzort"
                                prepend-inner-icon="mdi-map-marker"
                            ></v-text-field>
                        </v-container>
                    </v-sheet>

                    <br>

                    <v-sheet outlined rounded>
                        <v-container>
                            <div class="overline mb-4">
                                Einsatzart
                            </div>
                            <v-row align="center">
                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatz_checkbox_brandeinsatz"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="Brandeinsatz"
                                    ></v-checkbox>
                                </v-col>


                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatz_checkbox_suchaktion"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="Suchaktion"
                                    ></v-checkbox>
                                </v-col>


                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatz_checkbox_verkehrsunfall"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="Verkehrsunfall"
                                    ></v-checkbox>
                                </v-col>


                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatz_einsatzart_checkbox_manv"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="MANV"
                                    ></v-checkbox>
                                </v-col>


                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatz_checkbox_einsatzeinheit"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="Einsatzeinheit"
                                    ></v-checkbox>
                                </v-col>

                                <v-checkbox
                                    v-model="form.einsatz_einsatzart_checkbox_sonstige"
                                    class="shrink mr-2 mt-0"
                                    hide-details
                                    label="Sonstige"
                                ></v-checkbox>
                                <v-text-field v-model="form.einsatz_einsatzart_textfield_sonstige"></v-text-field>

                            </v-row>
                        </v-container>
                    </v-sheet>

                    <br>

                    <v-sheet outlined rounded>
                        <v-container>
                            <v-text-field
                                v-model="form.einsatz_textfield_einsatzauftrag"
                                label="Einsatzauftrag"
                                prepend-inner-icon="mdi-clipboard-text"

                            ></v-text-field>
                        </v-container>
                    </v-sheet>

                </v-container>
            </v-sheet>

            <br>


            <v-sheet rounded>
                <v-container>
                    <h2>Einheit</h2>

                    <v-sheet outlined rounded>
                        <v-container>
                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.einheit_textfield_org_lm_herkunft_bezeichnung"
                                        label="Org / LM / Herkunft / Bezeichnung"
                                    ></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-text-field
                                        v-model="form.einheit_textfield_staerke_zf_artzt"
                                        label="ZF / Artzt"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.einheit_textfield_staerke_gf"
                                        label="GF"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.einheit_textfield_staerke_helfer"
                                        label="Helfer"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.einheit_textfield_staerke_gesamt"
                                        label="Gesamt"
                                    ></v-text-field>
                                </v-col>

                            </v-row>
                        </v-container>
                    </v-sheet>

                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Fahrzeuge</h2>

                    <v-sheet outlined rounded>
                        <v-container>

                            <v-row>
                                <v-icon>1</v-icon>
                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_1_funkrufname"
                                        label="Funkrufnamen"
                                        prepend-inner-icon="mdi-radio-handheld"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_1_kennzeichen"
                                        label="Amtl. Kennzeichen"
                                        prepend-inner-icon="mdi-card-text"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_1_fahrzeugart"
                                        label="Fahrzeugart"
                                        prepend-inner-icon="mdi-car-info"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-icon>2</v-icon>
                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_2_funkrufname"
                                        label="Funkrufnamen"
                                        prepend-inner-icon="mdi-radio-handheld"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_2_kennzeichen"
                                        label="Amtl. Kennzeichen"
                                        prepend-inner-icon="mdi-card-text"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_2_fahrzeugart"
                                        label="Fahrzeugart"
                                        prepend-inner-icon="mdi-car-info"
                                    ></v-text-field>
                                </v-col>
                            </v-row>


                            <v-row>
                                <v-icon>3</v-icon>
                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_3_funkrufname"
                                        label="Funkrufnamen"
                                        prepend-inner-icon="mdi-radio-handheld"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_3_kennzeichen"
                                        label="Amtl. Kennzeichen"
                                        prepend-inner-icon="mdi-card-text"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.fahrzeuge_textfield_3_fahrzeugart"
                                        label="Fahrzeugart"
                                        prepend-inner-icon="mdi-car-info"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                        </v-container>
                    </v-sheet>

                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Weitere Materialien</h2>
                    <v-sheet outlined rounded>
                        <v-container>
                            <v-textarea
                                v-model="form.weitere_materialien_textfield"
                                label="Weitere Materialien"
                                prepend-inner-icon="mdi-clipboard-text"
                            ></v-textarea>
                        </v-container>
                    </v-sheet>
                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Kurzbericht</h2>

                    <v-sheet outlined rounded>
                        <v-container>
                            <v-textarea
                                v-model="form.kurzbericht_textfield"
                                label="Kurzbericht"
                                prepend-inner-icon="mdi-clipboard-text"
                            ></v-textarea>
                        </v-container>
                    </v-sheet>

                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Sonstige Hinweise / Bemerkungen / Ereignisse</h2>
                    <v-sheet outlined rounded>
                        <v-container>
                            <v-textarea
                                v-model="form.sonstige_hinweise_bemerkungen_ereignisse_textfield"
                                label="Sonstige Hinweise / Bemerkungen / Ereignisse"
                                prepend-inner-icon="mdi-clipboard-text"
                            ></v-textarea>
                        </v-container>
                    </v-sheet>
                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Anzahl Maßnahmen</h2>

                    <v-sheet outlined rounded>
                        <v-container>
                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.anzahl_masnahmen_eh_san_rd"
                                        label="EH/SAN/RD"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.anzahl_masnahmen_btd"
                                        label="BTD"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.anzahl_masnahmen_tus"
                                        label="TuS"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.anzahl_masnahmen_verpflegung"
                                        label="Verpflegung"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.anzahl_masnahmen_sonstiges"
                                        label="Sonstiges"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-sheet>

                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Beigefügte Dokumentation</h2>
                    <v-sheet outlined rounded>
                        <v-container>
                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.beigefuegte_dokumentation_swd_rd_patientenprotokolle"
                                        label="SWD, RD, Patientenprotokolle"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.beigefuegte_dokumentation_manv_dokumente"
                                        label="MANV Dokumente"
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.beigefuegte_dokumentation_sonstiges"
                                        label="Sonstiges"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-sheet>
                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Einsatzkräfte</h2>


                    <v-sheet outlined rounded>

                        <v-container>

                            <v-row align="center">

                                <v-icon>1</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>


                                <v-col>
                                    <v-checkbox
                                        label="BL"
                                    >
                                    </v-checkbox>
                                </v-col>

                                <v-col>
                                    <v-checkbox
                                        label="ZF / Artzt"
                                    >
                                    </v-checkbox>
                                </v-col>

                                <v-col>
                                    <v-checkbox
                                        label="GF"
                                    >
                                    </v-checkbox>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-menu
                                        ref="helfer_von_1_menu_menu"
                                        v-model="helfer_von_1_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.helfer_von_1_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.helfer_von_1_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Von"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="helfer_von_1_menu"
                                            v-model="form.helfer_von_1_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.helfer_von_1_menu_menu.save(form.helfer_von_1_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                </v-col>

                                <v-col>
                                    <v-menu
                                        ref="helfer_bis_1_menu_menu"
                                        v-model="helfer_bis_1_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.helfer_bis_1_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.helfer_bis_1_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Bis"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="helfer_bis_1_menu"
                                            v-model="form.helfer_bis_1_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.helfer_bis_1_menu_menu.save(form.helfer_bis_1_time)"
                                        ></v-time-picker>
                                    </v-menu>

                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>2</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>


                                <v-col>
                                    <v-checkbox
                                        label="BL"
                                    >
                                    </v-checkbox>
                                </v-col>

                                <v-col>
                                    <v-checkbox
                                        label="ZF / Artzt"
                                    >
                                    </v-checkbox>
                                </v-col>

                                <v-col>
                                    <v-checkbox
                                        label="GF"
                                    >
                                    </v-checkbox>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-menu
                                        ref="helfer_von_2_menu_menu"
                                        v-model="helfer_von_2_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.helfer_von_2_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.helfer_von_2_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Von"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="helfer_von_2_menu"
                                            v-model="form.helfer_von_2_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.helfer_von_2_menu_menu.save(form.helfer_von_2_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                </v-col>

                                <v-col>
                                    <v-menu
                                        ref="helfer_bis_2_menu_menu"
                                        v-model="helfer_bis_2_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.helfer_bis_2_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.helfer_bis_2_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Bis"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="helfer_bis_2_menu"
                                            v-model="form.helfer_bis_2_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.helfer_bis_2_menu_menu.save(form.helfer_bis_2_time)"
                                        ></v-time-picker>
                                    </v-menu>

                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>3</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-menu
                                        ref="helfer_von_1_menu_menu"
                                        v-model="helfer_von_1_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.helfer_von_1_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.helfer_von_1_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Von"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="helfer_von_1_menu"
                                            v-model="form.helfer_von_1_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.helfer_von_1_menu_menu.save(form.helfer_von_1_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                </v-col>

                                <v-col>
                                    <v-menu
                                        ref="helfer_bis_1_menu_menu"
                                        v-model="helfer_bis_1_menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="form.helfer_bis_1_time"
                                        max-width="290px"
                                        min-width="290px"
                                        offset-y
                                        transition="scale-transition"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="form.helfer_bis_1_time"
                                                v-bind="attrs"
                                                v-on="on"
                                                label="Bis"
                                                prepend-inner-icon="mdi-clock-time-four-outline"
                                                readonly
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="helfer_bis_1_menu"
                                            v-model="form.helfer_bis_1_time"
                                            format="24hr"
                                            full-width
                                            @click:minute="$refs.helfer_bis_1_menu_menu.save(form.helfer_bis_1_time)"
                                        ></v-time-picker>
                                    </v-menu>

                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>4</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>5</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>7</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>8</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>9</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>10</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>11</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>12</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>13</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">

                                <v-icon>14</v-icon>

                                <v-col>
                                    <v-text-field
                                        label="Name, Vorname"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="OV-KZ"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Von"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Bis"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Qualifikation"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>

                        </v-container>

                    </v-sheet>

                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Einsatznachbesprechung</h2>

                    <v-sheet outlined rounded>
                        <v-container>
                            <v-row align="center">
                                <v-col>
                                    <v-checkbox
                                        v-model="form.einsatznachbesprechung_checkbox_durchgefuehrt"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="durchgeführt"
                                    ></v-checkbox>
                                </v-col>

                                <v-checkbox
                                    v-model="form.einsatznachbesprechung_checkbox_nein_grund"
                                    class="shrink mr-2 mt-0"
                                    hide-details
                                    label="nein Grund:"
                                ></v-checkbox>
                                <v-text-field v-model="form.einsatznachbesprechung_textfield_nein_grund"></v-text-field>

                                <v-col>
                                    <v-checkbox
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="offen"
                                        v-model="form.einsatznachbesprechung_checkbox_offen"
                                    ></v-checkbox>
                                </v-col>

                                <v-checkbox
                                    class="shrink mr-2 mt-0"
                                    hide-details
                                    label="geplant am:"
                                    v-model="form.einsatznachbesprechung_checkbox_geplant_am"
                                ></v-checkbox>
                                <v-text-field v-model="form.einsatznachbesprechung_textfield_geplant_am"></v-text-field>
                            </v-row>
                        </v-container>
                    </v-sheet>

                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Rechtliches</h2>

                    <v-sheet outlined rounded>
                        <v-container>
                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.rechtliches_textfield_ort"
                                        label="Ort"
                                        prepend-inner-icon="mdi-map-marker"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.rechtliches_textfield_datum"
                                        label="Datum"
                                        prepend-inner-icon="mdi-calendar"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.rechtliches_textfield_unterschrift"
                                        label="Unterschrift E-Leitung/GF"
                                        prepend-inner-icon="mdi-signature"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-sheet>
                </v-container>
            </v-sheet>

            <br>

            <v-sheet rounded>
                <v-container>
                    <h2>Dokument Lenkung</h2>
                    <v-sheet outlined rounded>
                        <v-container>
                            <p>1. Das Formular ist durch den Einsatzleiter vollständig auszufüllen.</p>
                            <p>2. Das ausgefüllte Formular ist zusammen mit den Anlagen zeitnah an den DRK Kreisverband
                                Villingen-Schwenningen zu schicken.</p>
                        </v-container>
                    </v-sheet>
                </v-container>
            </v-sheet>

            <br>

            <v-btn
                :disabled="loading"
                :loading="loading"
                type="submit"
            >
                PDF Erstellen
            </v-btn>


        </form>


    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    data() {
        return {
            loading: false,
            loader: null,

            einsatz_datum_menu: false,
            einsatz_beginn_menu: false,
            einsatz_abfahrzeit_menu: null,
            einsatz_alarmzeit_menu: false,
            einsatz_fw_swd_menu: false,
            einsatz_eintreffzeit_menu: false,

            helfer_von_1_menu: false,
            helfer_bis_1_menu: false,
            helfer_von_2_menu: false,
            helfer_bis_2_menu: false,

            form: {
                einsatz_datum: new Date().toISOString().substr(0, 10),
                einsatz_beginn_time: null,
                einsatz_ende_time: null,
                einsatz_alarmzeit_time: null,
                einsatz_abfahrzeit_time: null,
                einsatz_eintreffzeit_time: null,
                einsatz_nummer: '',
                einsatz_frei_einsatzstelle: '',

                einsatz_fw_swd_time: null,
                einsatz_checkbox_nach_aao: '',
                einsatz_checkbox_manv: '',
                einsatz_checkbox_ee: '',
                einsatz_checkbox_fw_swd_ab: '',
                einsatz_einsatz_anforderung_checkbox_sonstiges: '',
                einsatz_einsatz_anforderung_textfield_sontiges: '',
                einsatz_textfield_einsatzort: '',
                einsatz_checkbox_brandeinsatz: '',
                einsatz_checkbox_suchaktion: '',
                einsatz_checkbox_verkehrsunfall: '',
                einsatz_einsatzart_checkbox_manv: '',
                einsatz_checkbox_einsatzeinheit: '',
                einsatz_einsatzart_checkbox_sonstige: '',
                einsatz_einsatzart_textfield_sonstige: '',
                einsatz_textfield_einsatzauftrag: '',
                einheit_textfield_org_lm_herkunft_bezeichnung: '',

                einheit_textfield_staerke_zf_artzt: '',
                einheit_textfield_staerke_gf: '',
                einheit_textfield_staerke_helfer: '',
                einheit_textfield_staerke_gesamt: '',

                fahrzeuge_textfield_1_funkrufname: '',
                fahrzeuge_textfield_1_kennzeichen: '',
                fahrzeuge_textfield_1_fahrzeugart: '',
                fahrzeuge_textfield_2_funkrufname: '',
                fahrzeuge_textfield_2_kennzeichen: '',
                fahrzeuge_textfield_2_fahrzeugart: '',
                fahrzeuge_textfield_3_funkrufname: '',
                fahrzeuge_textfield_3_kennzeichen: '',
                fahrzeuge_textfield_3_fahrzeugart: '',

                weitere_materialien_textfield: '',
                kurzbericht_textfield: '',
                sonstige_hinweise_bemerkungen_ereignisse_textfield: '',
                anzahl_masnahmen_eh_san_rd: '',
                anzahl_masnahmen_btd: '',
                anzahl_masnahmen_tus: '',
                anzahl_masnahmen_verpflegung: '',
                anzahl_masnahmen_sonstiges: '',
                beigefuegte_dokumentation_swd_rd_patientenprotokolle: '',
                beigefuegte_dokumentation_manv_dokumente: '',
                beigefuegte_dokumentation_sonstiges: '',
                einsatznachbesprechung_checkbox_durchgefuehrt: '',
                einsatznachbesprechung_checkbox_nein_grund: '',
                einsatznachbesprechung_textfield_nein_grund: '',
                einsatznachbesprechung_checkbox_offen: '',
                einsatznachbesprechung_checkbox_geplant_am: '',
                einsatznachbesprechung_textfield_geplant_am: '',
                rechtliches_textfield_ort: '',
                rechtliches_textfield_datum: '',
                rechtliches_textfield_unterschrift: '',

                helfer_von_1_time: null,
                helfer_bis_1_time: null,
                helfer_von_2_time: null,
                helfer_bis_2_time: null,

            },

        }
    },

    components: {
        AppLayout,
    },

    methods: {
        submit() {

            this.$inertia.post(this.route('protokolle.store'), this.form, {
                onStart: () => this.loading = true,
                onFinish: () => this.loading = false,
            })

            axios({
                url: 'http://127.0.0.1:8080/protokolle/pdf',
                method: 'GET',
                responseType: 'blob',
            }).then((response) => {
                //Create a Blob from the PDF Stream
                const file = new Blob(
                    [response.data],
                    {type: 'application/pdf'});
                //Build a URL from the file
                const fileURL = URL.createObjectURL(file);
                //Open the URL on new Window
                window.open(fileURL);
            })
                .catch(error => {
                    console.log(error);
                });

        },
    },

    watch: {
        loader() {
            const l = this.loader
            this[l] = !this[l]

            setTimeout(() => (this[l] = false), 3000)

            this.loader = null
        },
    },

}
</script>
