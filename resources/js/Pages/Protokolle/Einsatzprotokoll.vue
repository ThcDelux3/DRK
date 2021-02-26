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
                                <v-text-field
                                    v-model="form.einsatz_einsatz_anforderung_textfield_sontiges"></v-text-field>
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
                            <v-sheet outlined rounded>
                                <v-container>

                                    <div class="overline mb-4">
                                        Führung
                                    </div>

                                    <!--1-->
                                    <v-row align="center" class="justify-space-around">


                                        <v-icon>1</v-icon>

                                        <v-col
                                            sm="3"
                                        >
                                            <v-text-field
                                                v-model="form.helfer_1_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col
                                            sm="1"
                                        >
                                            <v-checkbox
                                                v-model="form.helfer_1_checkbox_bl"
                                                label="BL"
                                            >
                                            </v-checkbox>
                                        </v-col>

                                        <v-col
                                            sm="1"

                                        >
                                            <v-checkbox
                                                v-model="form.helfer_1_checkbox_zf_artzt"
                                                label="ZF / Artzt"
                                            >
                                            </v-checkbox>
                                        </v-col>

                                        <v-col
                                            sm="1"

                                        >
                                            <v-checkbox
                                                v-model="form.helfer_1_checkbox_gf"
                                                label="GF"
                                            >
                                            </v-checkbox>
                                        </v-col>

                                        <v-col
                                            sm="1"
                                        >

                                            <v-select
                                                v-model="form.helfer_1_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>

                                        </v-col>

                                        <v-col
                                            sm="1"
                                        >
                                            <v-menu
                                                ref="helfer_1_von_menu_menu"
                                                v-model="helfer_1_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_1_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_1_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_1_von_menu"
                                                    v-model="form.helfer_1_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_1_von_menu_menu.save(form.helfer_1_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col
                                            sm="1"
                                        >
                                            <v-menu
                                                ref="helfer_1_bis_menu_menu"
                                                v-model="helfer_1_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_1_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_1_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_1_bis_menu"
                                                    v-model="form.helfer_1_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_1_bis_menu_menu.save(form.helfer_1_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col
                                            sm="2"
                                        >
                                            <v-select
                                                v-model="form.helfer_1_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>
                                    </v-row>

                                    <!--2-->
                                    <v-row align="center" class="justify-space-around">

                                        <v-icon>2</v-icon>

                                        <v-col
                                            sm="3"
                                        >
                                            <v-text-field
                                                v-model="form.helfer_2_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col
                                            sm="1"
                                        >
                                            <v-checkbox
                                                v-model="form.helfer_2_checkbox_bl"
                                                label="BL"
                                            >
                                            </v-checkbox>
                                        </v-col>

                                        <v-col
                                            sm="1"

                                        >
                                            <v-checkbox
                                                v-model="form.helfer_2_checkbox_zf_artzt"
                                                label="ZF / Artzt"
                                            >
                                            </v-checkbox>
                                        </v-col>

                                        <v-col
                                            sm="1"

                                        >
                                            <v-checkbox
                                                v-model="form.helfer_2_checkbox_gf"
                                                label="GF"
                                            >
                                            </v-checkbox>
                                        </v-col>

                                        <v-col
                                            sm="1"
                                        >

                                            <v-select
                                                v-model="form.helfer_2_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>

                                        </v-col>

                                        <v-col
                                            sm="1"
                                        >
                                            <v-menu
                                                ref="helfer_2_von_menu_menu"
                                                v-model="helfer_2_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_2_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_2_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_2_von_menu"
                                                    v-model="form.helfer_2_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_2_von_menu_menu.save(form.helfer_2_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col
                                            sm="1"
                                        >
                                            <v-menu
                                                ref="helfer_2_bis_menu_menu"
                                                v-model="helfer_2_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_2_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_2_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_2_bis_menu"
                                                    v-model="form.helfer_2_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_2_bis_menu_menu.save(form.helfer_2_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col
                                            sm="2"
                                        >
                                            <v-select
                                                v-model="form.helfer_2_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>
                                    </v-row>
                                </v-container>

                            </v-sheet>

                            <br>

                            <v-sheet outlined rounded>
                                <v-container>

                                    <div class="overline mb-4">
                                        Helfer
                                    </div>

                                    <!--3-->
                                    <v-row align="center">


                                        <v-icon>3</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_3_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_3_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_3_von_menu_menu"
                                                v-model="helfer_3_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_3_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_3_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_3_von_menu"
                                                    v-model="form.helfer_3_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_3_von_menu_menu.save(form.helfer_3_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_3_bis_menu_menu"
                                                v-model="helfer_3_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_3_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_3_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_3_bis_menu"
                                                    v-model="form.helfer_3_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_3_bis_menu_menu.save(form.helfer_3_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_3_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--4-->
                                    <v-row align="center">


                                        <v-icon>4</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_4_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_4_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_4_von_menu_menu"
                                                v-model="helfer_4_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_4_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_4_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_4_von_menu"
                                                    v-model="form.helfer_4_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_4_von_menu_menu.save(form.helfer_4_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_4_bis_menu_menu"
                                                v-model="helfer_4_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_4_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_4_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_4_bis_menu"
                                                    v-model="form.helfer_4_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_4_bis_menu_menu.save(form.helfer_4_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_4_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--5-->
                                    <v-row align="center">


                                        <v-icon>5</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_5_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_5_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_5_von_menu_menu"
                                                v-model="helfer_5_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_5_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_5_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_5_von_menu"
                                                    v-model="form.helfer_5_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_5_von_menu_menu.save(form.helfer_5_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_5_bis_menu_menu"
                                                v-model="helfer_5_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_5_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_5_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_5_bis_menu"
                                                    v-model="form.helfer_5_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_5_bis_menu_menu.save(form.helfer_5_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_5_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--6-->
                                    <v-row align="center">


                                        <v-icon>6</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_6_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_6_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_6_von_menu_menu"
                                                v-model="helfer_6_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_6_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_6_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_6_von_menu"
                                                    v-model="form.helfer_6_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_6_von_menu_menu.save(form.helfer_6_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_6_bis_menu_menu"
                                                v-model="helfer_6_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_6_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_6_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_6_bis_menu"
                                                    v-model="form.helfer_6_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_6_bis_menu_menu.save(form.helfer_6_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_6_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--7-->
                                    <v-row align="center">


                                        <v-icon>7</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_7_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_7_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_7_von_menu_menu"
                                                v-model="helfer_7_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_7_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_7_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_7_von_menu"
                                                    v-model="form.helfer_7_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_7_von_menu_menu.save(form.helfer_7_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_7_bis_menu_menu"
                                                v-model="helfer_7_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_7_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_7_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_7_bis_menu"
                                                    v-model="form.helfer_7_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_7_bis_menu_menu.save(form.helfer_7_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_7_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--8-->
                                    <v-row align="center">


                                        <v-icon>8</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_8_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_8_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_8_von_menu_menu"
                                                v-model="helfer_8_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_8_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_8_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_8_von_menu"
                                                    v-model="form.helfer_8_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_8_von_menu_menu.save(form.helfer_8_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_8_bis_menu_menu"
                                                v-model="helfer_8_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_8_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_8_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_8_bis_menu"
                                                    v-model="form.helfer_8_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_8_bis_menu_menu.save(form.helfer_8_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_8_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--9-->
                                    <v-row align="center">


                                        <v-icon>9</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_9_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_9_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_9_von_menu_menu"
                                                v-model="helfer_9_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_9_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_9_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_9_von_menu"
                                                    v-model="form.helfer_9_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_9_von_menu_menu.save(form.helfer_9_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_9_bis_menu_menu"
                                                v-model="helfer_9_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_9_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_9_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_9_bis_menu"
                                                    v-model="form.helfer_9_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_9_bis_menu_menu.save(form.helfer_9_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_9_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--10-->
                                    <v-row align="center">


                                        <v-icon>10</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_10_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_10_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_10_von_menu_menu"
                                                v-model="helfer_10_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_10_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_10_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_10_von_menu"
                                                    v-model="form.helfer_10_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_10_von_menu_menu.save(form.helfer_10_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_10_bis_menu_menu"
                                                v-model="helfer_10_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_10_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_10_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_10_bis_menu"
                                                    v-model="form.helfer_10_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_10_bis_menu_menu.save(form.helfer_10_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_10_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--11-->
                                    <v-row align="center">


                                        <v-icon>11</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_11_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_11_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_11_von_menu_menu"
                                                v-model="helfer_11_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_11_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_11_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_11_von_menu"
                                                    v-model="form.helfer_11_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_11_von_menu_menu.save(form.helfer_11_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_11_bis_menu_menu"
                                                v-model="helfer_11_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_11_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_11_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_11_bis_menu"
                                                    v-model="form.helfer_11_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_11_bis_menu_menu.save(form.helfer_11_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_11_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--12-->
                                    <v-row align="center">


                                        <v-icon>12</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_12_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_12_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_12_von_menu_menu"
                                                v-model="helfer_12_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_12_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_12_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_12_von_menu"
                                                    v-model="form.helfer_12_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_12_von_menu_menu.save(form.helfer_12_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_12_bis_menu_menu"
                                                v-model="helfer_12_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_12_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_12_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_12_bis_menu"
                                                    v-model="form.helfer_12_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_12_bis_menu_menu.save(form.helfer_12_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_12_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--13-->
                                    <v-row align="center">


                                        <v-icon>13</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_13_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_13_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_13_von_menu_menu"
                                                v-model="helfer_13_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_13_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_13_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_13_von_menu"
                                                    v-model="form.helfer_13_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_13_von_menu_menu.save(form.helfer_13_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_13_bis_menu_menu"
                                                v-model="helfer_13_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_13_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_13_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_13_bis_menu"
                                                    v-model="form.helfer_13_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_13_bis_menu_menu.save(form.helfer_13_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_13_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>
                                    <!--14-->
                                    <v-row align="center">

                                        <v-icon>14</v-icon>


                                        <v-col>
                                            <v-text-field
                                                v-model="form.helfer_14_name_vorname"
                                                label="Name, Vorname"
                                            >
                                            </v-text-field>
                                        </v-col>


                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_14_dropdown_ov_kz"
                                                :items="items_helfer_checkbox_ov_kz"
                                                dense
                                                hide-details
                                                label="OV-KZ"
                                            ></v-select>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_14_von_menu_menu"
                                                v-model="helfer_14_von_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_14_von_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_14_von_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Von"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_14_von_menu"
                                                    v-model="form.helfer_14_von_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_14_von_menu_menu.save(form.helfer_14_von_time)"
                                                ></v-time-picker>
                                            </v-menu>
                                        </v-col>

                                        <v-col>
                                            <v-menu
                                                ref="helfer_14_bis_menu_menu"
                                                v-model="helfer_14_bis_menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="form.helfer_14_bis_time"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-y
                                                transition="scale-transition"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="form.helfer_14_bis_time"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        label="Bis"
                                                        prepend-inner-icon="mdi-clock-time-four-outline"
                                                        readonly
                                                    ></v-text-field>
                                                </template>
                                                <v-time-picker
                                                    v-if="helfer_14_bis_menu"
                                                    v-model="form.helfer_14_bis_time"
                                                    format="24hr"
                                                    full-width
                                                    @click:minute="$refs.helfer_14_bis_menu_menu.save(form.helfer_14_bis_time)"
                                                ></v-time-picker>
                                            </v-menu>

                                        </v-col>

                                        <v-col>
                                            <v-select
                                                v-model="form.helfer_14_checkbox_qualifikation"
                                                :items="items_helfer_checkbox_qualifikation"
                                                dense
                                                hide-details
                                                label="Qualifikation"
                                            ></v-select>
                                        </v-col>

                                    </v-row>

                                </v-container>
                            </v-sheet>


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
                                        v-model="form.einsatznachbesprechung_checkbox_offen"
                                        class="shrink mr-2 mt-0"
                                        hide-details
                                        label="offen"
                                    ></v-checkbox>
                                </v-col>

                                <v-checkbox
                                    v-model="form.einsatznachbesprechung_checkbox_geplant_am"
                                    class="shrink mr-2 mt-0"
                                    hide-details
                                    label="geplant am:"
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

            einsatz_datum_menu: false,
            einsatz_beginn_menu: false,
            einsatz_abfahrzeit_menu: null,
            einsatz_alarmzeit_menu: false,
            einsatz_fw_swd_menu: false,
            einsatz_eintreffzeit_menu: false,

            items_helfer_checkbox_ov_kz: ['OV-VL', 'OV-SW', 'fizz', 'buzz'],
            items_helfer_checkbox_qualifikation: ['Rettungs Helfer (RH)', 'RS', 'SanC', 'buzz'],


            helfer_1_von_menu: false,
            helfer_1_bis_menu: false,
            helfer_2_von_menu: false,
            helfer_2_bis_menu: false,
            helfer_3_von_menu: false,
            helfer_3_bis_menu: false,
            helfer_4_von_menu: false,
            helfer_4_bis_menu: false,
            helfer_5_von_menu: false,
            helfer_5_bis_menu: false,
            helfer_6_von_menu: false,
            helfer_6_bis_menu: false,
            helfer_7_von_menu: false,
            helfer_7_bis_menu: false,
            helfer_8_von_menu: false,
            helfer_8_bis_menu: false,
            helfer_9_von_menu: false,
            helfer_9_bis_menu: false,
            helfer_10_von_menu: false,
            helfer_10_bis_menu: false,
            helfer_11_von_menu: false,
            helfer_11_bis_menu: false,
            helfer_12_von_menu: false,
            helfer_12_bis_menu: false,
            helfer_13_von_menu: false,
            helfer_13_bis_menu: false,
            helfer_14_von_menu: false,
            helfer_14_bis_menu: false,

            form: {
                einsatz_datum: null,
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

                helfer_1_name_vorname: '',
                helfer_1_checkbox_bl: false,
                helfer_1_checkbox_zf_artzt: false,
                helfer_1_checkbox_gf: false,
                helfer_1_dropdown_ov_kz: '',
                helfer_1_von_time: null,
                helfer_1_bis_time: null,
                helfer_1_checkbox_qualifikation: '',

                helfer_2_name_vorname: '',
                helfer_2_checkbox_bl: false,
                helfer_2_checkbox_zf_artzt: false,
                helfer_2_checkbox_gf: false,
                helfer_2_dropdown_ov_kz: '',
                helfer_2_von_time: null,
                helfer_2_bis_time: null,
                helfer_2_checkbox_qualifikation: '',

                helfer_3_name_vorname: '',
                helfer_3_von_time: null,
                helfer_3_bis_time: null,
                helfer_3_dropdown_ov_kz: '',
                helfer_3_checkbox_qualifikation: '',

                helfer_4_name_vorname: '',
                helfer_4_von_time: null,
                helfer_4_bis_time: null,
                helfer_4_dropdown_ov_kz: '',
                helfer_4_checkbox_qualifikation: '',

                helfer_5_name_vorname: '',
                helfer_5_von_time: null,
                helfer_5_bis_time: null,
                helfer_5_dropdown_ov_kz: '',
                helfer_5_checkbox_qualifikation: '',

                helfer_6_name_vorname: '',
                helfer_6_von_time: null,
                helfer_6_bis_time: null,
                helfer_6_dropdown_ov_kz: '',
                helfer_6_checkbox_qualifikation: '',

                helfer_7_name_vorname: '',
                helfer_7_von_time: null,
                helfer_7_bis_time: null,
                helfer_7_dropdown_ov_kz: '',
                helfer_7_checkbox_qualifikation: '',

                helfer_8_name_vorname: '',
                helfer_8_von_time: null,
                helfer_8_bis_time: null,
                helfer_8_dropdown_ov_kz: '',
                helfer_8_checkbox_qualifikation: '',

                helfer_9_name_vorname: '',
                helfer_9_von_time: null,
                helfer_9_bis_time: null,
                helfer_9_dropdown_ov_kz: '',
                helfer_9_checkbox_qualifikation: '',

                helfer_10_name_vorname: '',
                helfer_10_von_time: null,
                helfer_10_bis_time: null,
                helfer_10_dropdownx_ov_kz: '',
                helfer_10_checkbox_qualifikation: '',

                helfer_11_name_vorname: '',
                helfer_11_von_time: null,
                helfer_11_bis_time: null,
                helfer_11_dropdown_ov_kz: '',
                helfer_11_checkbox_qualifikation: '',

                helfer_12_name_vorname: '',
                helfer_12_von_time: null,
                helfer_12_bis_time: null,
                helfer_12_dropdown_ov_kz: '',
                helfer_12_checkbox_qualifikation: '',

                helfer_13_name_vorname: '',
                helfer_13_von_time: null,
                helfer_13_bis_time: null,
                helfer_13_dropdown_ov_kz: '',
                helfer_13_checkbox_qualifikation: '',

                helfer_14_name_vorname: '',
                helfer_14_von_time: null,
                helfer_14_bis_time: null,
                helfer_14_dropdown_ov_kz: '',
                helfer_14_checkbox_qualifikation: '',

            },

        }
    },

    components: {
        AppLayout,
    },

    methods: {
        submit() {
            this.$inertia.post(this.route('protokolle.store'), this.form, {
                onFinish: () => this.openPDF(),
            })
        },

        openPDF() {
            window.open("/test.pdf", "_blank");
        }

    },

}
</script>
