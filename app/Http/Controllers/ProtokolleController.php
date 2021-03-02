<?php

namespace App\Http\Controllers;

use App\Models\Protokolle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Symfony\Component\Console\Input\Input;

class ProtokolleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Protokolle/');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pdf = new \setasign\Fpdi\Fpdi();

        //Einsatz
        $einsatz_datum = $request->input('einsatz_datum');
        $einsatz_beginn_time = $request->input('einsatz_beginn_time');
        $einsatz_ende_time = $request->input('einsatz_ende_time');
        $einsatz_alarmzeit_time = $request->input('einsatz_alarmzeit_time');
        $einsatz_abfahrzeit_time = $request->input('einsatz_abfahrzeit_time');
        $einsatz_eintreffzeit_time = $request->input('einsatz_eintreffzeit_time');
        $einsatz_nummer = $request->input('einsatz_nummer');
        $einsatz_frei_einsatzstelle_time = $request->input('einsatz_frei_einsatzstelle_time');

        $einsatz_checkbox_nach_aao = $request->input('einsatz_checkbox_nach_aao');
        $einsatz_checkbox_manv = $request->input('einsatz_checkbox_manv');
        $einsatz_checkbox_ee = $request->input('einsatz_checkbox_ee');
        $einsatz_checkbox_fw_swd_ab = $request->input('einsatz_checkbox_fw_swd_ab');
        $einsatz_fw_swd_time = $request->input('einsatz_fw_swd_time');
        $einsatz_einsatz_anforderung_checkbox_sonstiges = $request->input('einsatz_einsatz_anforderung_checkbox_sonstiges');
        $einsatz_einsatz_anforderung_textfield_sontiges = $request->input('einsatz_einsatz_anforderung_textfield_sontiges');

        $einsatz_textfield_einsatzort = $request->input('einsatz_textfield_einsatzort');

        $einsatz_checkbox_brandeinsatz = $request->input('einsatz_checkbox_brandeinsatz');
        $einsatz_checkbox_suchaktion = $request->input('einsatz_checkbox_suchaktion');
        $einsatz_checkbox_verkehrsunfall = $request->input('einsatz_checkbox_verkehrsunfall');
        $einsatz_einsatzart_checkbox_manv = $request->input('einsatz_einsatzart_checkbox_manv');
        $einsatz_checkbox_einsatzeinheit = $request->input('einsatz_checkbox_einsatzeinheit');
        $einsatz_einsatzart_checkbox_sonstige = $request->input('einsatz_einsatzart_checkbox_sonstige');
        $einsatz_einsatzart_textfield_sonstige = $request->input('einsatz_einsatzart_textfield_sonstige');

        $einsatz_textfield_einsatzauftrag = $request->input('einsatz_textfield_einsatzauftrag');

        $einheit_textfield_org_lm_herkunft_bezeichnung = $request->input('einheit_textfield_org_lm_herkunft_bezeichnung');
        $einheit_textfield_staerke_zf_artzt = $request->input('einheit_textfield_staerke_zf_artzt');
        $einheit_textfield_staerke_gf = $request->input('einheit_textfield_staerke_gf');
        $einheit_textfield_staerke_helfer = $request->input('einheit_textfield_staerke_helfer');
        $einheit_textfield_staerke_gesamt = $request->input('einheit_textfield_staerke_gesamt');

        $fahrzeuge_textfield_1_funkrufname = $request->input('fahrzeuge_textfield_1_funkrufname');
        $fahrzeuge_textfield_1_kennzeichen = $request->input('fahrzeuge_textfield_1_kennzeichen');
        $fahrzeuge_textfield_1_fahrzeugart = $request->input('fahrzeuge_textfield_1_fahrzeugart');
        $fahrzeuge_textfield_2_funkrufname = $request->input('fahrzeuge_textfield_2_funkrufname');
        $fahrzeuge_textfield_2_kennzeichen = $request->input('fahrzeuge_textfield_2_kennzeichen');
        $fahrzeuge_textfield_2_fahrzeugart = $request->input('fahrzeuge_textfield_2_fahrzeugart');
        $fahrzeuge_textfield_3_funkrufname = $request->input('fahrzeuge_textfield_3_funkrufname');
        $fahrzeuge_textfield_3_kennzeichen = $request->input('fahrzeuge_textfield_3_kennzeichen');
        $fahrzeuge_textfield_3_fahrzeugart = $request->input('fahrzeuge_textfield_3_fahrzeugart');

        $weitere_materialien_textfield = $request->input('weitere_materialien_textfield');

        $kurzbericht_textfield = $request->input('kurzbericht_textfield');

        $sonstige_hinweise_bemerkungen_ereignisse_textfield = $request->input('sonstige_hinweise_bemerkungen_ereignisse_textfield');

        $anzahl_masnahmen_eh_san_rd = $request->input('anzahl_masnahmen_eh_san_rd');
        $anzahl_masnahmen_btd = $request->input('anzahl_masnahmen_btd');
        $anzahl_masnahmen_tus = $request->input('anzahl_masnahmen_tus');
        $anzahl_masnahmen_verpflegung = $request->input('anzahl_masnahmen_verpflegung');
        $anzahl_masnahmen_sonstiges = $request->input('anzahl_masnahmen_sonstiges');

        $beigefuegte_dokumentation_swd_rd_patientenprotokolle = $request->input('beigefuegte_dokumentation_swd_rd_patientenprotokolle');
        $beigefuegte_dokumentation_manv_dokumente = $request->input('beigefuegte_dokumentation_manv_dokumente');
        $beigefuegte_dokumentation_sonstiges = $request->input('beigefuegte_dokumentation_sonstiges');

        $helfer_1_name_vorname = $request->input('helfer_1_name_vorname');
        $helfer_1_checkbox_bl = $request->input('helfer_1_checkbox_bl');
        $helfer_1_checkbox_zf_artzt = $request->input('helfer_1_checkbox_zf_artzt');
        $helfer_1_checkbox_gf = $request->input('helfer_1_checkbox_gf');
        $helfer_1_dropdown_ov_kz = $request->input('helfer_1_dropdown_ov_kz');
        $helfer_1_von_time = $request->input('helfer_1_von_time');
        $helfer_1_bis_time = $request->input('helfer_1_bis_time');
        $helfer_1_checkbox_qualifikation = $request->input('helfer_1_checkbox_qualifikation');

        $helfer_2_name_vorname = $request->input('helfer_2_name_vorname');
        $helfer_2_checkbox_bl = $request->input('helfer_2_checkbox_bl');
        $helfer_2_checkbox_zf_artzt = $request->input('helfer_2_checkbox_zf_artzt');
        $helfer_2_checkbox_gf = $request->input('helfer_2_checkbox_gf');
        $helfer_2_dropdown_ov_kz = $request->input('helfer_2_dropdown_ov_kz');
        $helfer_2_von_time = $request->input('helfer_2_von_time');
        $helfer_2_bis_time = $request->input('helfer_2_bis_time');
        $helfer_2_checkbox_qualifikation = $request->input('helfer_2_checkbox_qualifikation');

        $helfer_3_name_vorname = $request->input('helfer_3_name_vorname');
        $helfer_3_von_time = $request->input('helfer_3_von_time');
        $helfer_3_bis_time = $request->input('helfer_3_bis_time');
        $helfer_3_dropdown_ov_kz = $request->input('helfer_3_dropdown_ov_kz');
        $helfer_3_checkbox_qualifikation = $request->input('helfer_3_checkbox_qualifikation');

        $helfer_4_name_vorname = $request->input('helfer_4_name_vorname');
        $helfer_4_von_time = $request->input('helfer_4_von_time');
        $helfer_4_bis_time = $request->input('helfer_4_bis_time');
        $helfer_4_dropdown_ov_kz = $request->input('helfer_4_dropdown_ov_kz');
        $helfer_4_checkbox_qualifikation = $request->input('helfer_4_checkbox_qualifikation');

        $helfer_5_name_vorname = $request->input('helfer_5_name_vorname');
        $helfer_5_von_time = $request->input('helfer_5_von_time');
        $helfer_5_bis_time = $request->input('helfer_5_bis_time');
        $helfer_5_dropdown_ov_kz = $request->input('helfer_5_dropdown_ov_kz');
        $helfer_5_checkbox_qualifikation = $request->input('helfer_5_checkbox_qualifikation');

        $helfer_6_name_vorname = $request->input('helfer_6_name_vorname');
        $helfer_6_von_time = $request->input('helfer_6_von_time');
        $helfer_6_bis_time = $request->input('helfer_6_bis_time');
        $helfer_6_dropdown_ov_kz = $request->input('helfer_6_dropdown_ov_kz');
        $helfer_6_checkbox_qualifikation = $request->input('helfer_6_checkbox_qualifikation');

        $helfer_7_name_vorname = $request->input('helfer_7_name_vorname');
        $helfer_7_von_time = $request->input('helfer_7_von_time');
        $helfer_7_bis_time = $request->input('helfer_7_bis_time');
        $helfer_7_dropdown_ov_kz = $request->input('helfer_7_dropdown_ov_kz');
        $helfer_7_checkbox_qualifikation = $request->input('helfer_7_checkbox_qualifikation');

        $helfer_8_name_vorname = $request->input('helfer_8_name_vorname');
        $helfer_8_von_time = $request->input('helfer_8_von_time');
        $helfer_8_bis_time = $request->input('helfer_8_bis_time');
        $helfer_8_dropdown_ov_kz = $request->input('helfer_8_dropdown_ov_kz');
        $helfer_8_checkbox_qualifikation = $request->input('helfer_8_checkbox_qualifikation');

        $helfer_9_name_vorname = $request->input('helfer_9_name_vorname');
        $helfer_9_von_time = $request->input('helfer_9_von_time');
        $helfer_9_bis_time = $request->input('helfer_9_bis_time');
        $helfer_9_dropdown_ov_kz = $request->input('helfer_9_dropdown_ov_kz');
        $helfer_9_checkbox_qualifikation = $request->input('helfer_9_checkbox_qualifikation');

        $helfer_10_name_vorname = $request->input('helfer_10_name_vorname');
        $helfer_10_von_time = $request->input('helfer_10_von_time');
        $helfer_10_bis_time = $request->input('helfer_10_bis_time');
        $helfer_10_dropdown_ov_kz = $request->input('helfer_10_dropdown_ov_kz');
        $helfer_10_checkbox_qualifikation = $request->input('helfer_10_checkbox_qualifikation');

        $helfer_11_name_vorname = $request->input('helfer_11_name_vorname');
        $helfer_11_von_time = $request->input('helfer_11_von_time');
        $helfer_11_bis_time = $request->input('helfer_11_bis_time');
        $helfer_11_dropdown_ov_kz = $request->input('helfer_11_dropdown_ov_kz');
        $helfer_11_checkbox_qualifikation = $request->input('helfer_11_checkbox_qualifikation');

        $helfer_12_name_vorname = $request->input('helfer_12_name_vorname');
        $helfer_12_von_time = $request->input('helfer_12_von_time');
        $helfer_12_bis_time = $request->input('helfer_12_bis_time');
        $helfer_12_dropdown_ov_kz = $request->input('helfer_12_dropdown_ov_kz');
        $helfer_12_checkbox_qualifikation = $request->input('helfer_12_checkbox_qualifikation');

        $helfer_13_name_vorname = $request->input('helfer_13_name_vorname');
        $helfer_13_von_time = $request->input('helfer_13_von_time');
        $helfer_13_bis_time = $request->input('helfer_13_bis_time');
        $helfer_13_dropdown_ov_kz = $request->input('helfer_13_dropdown_ov_kz');
        $helfer_13_checkbox_qualifikation = $request->input('helfer_13_checkbox_qualifikation');

        $helfer_14_name_vorname = $request->input('helfer_14_name_vorname');
        $helfer_14_von_time = $request->input('helfer_14_von_time');
        $helfer_14_bis_time = $request->input('helfer_14_bis_time');
        $helfer_14_dropdown_ov_kz = $request->input('helfer_14_dropdown_ov_kz');
        $helfer_14_checkbox_qualifikation = $request->input('helfer_14_checkbox_qualifikation');

        $einsatznachbesprechung_checkbox_durchgefuehrt = $request->input('einsatznachbesprechung_checkbox_durchgefuehrt');
        $einsatznachbesprechung_checkbox_nein_grund = $request->input('einsatznachbesprechung_checkbox_nein_grund');
        $einsatznachbesprechung_textfield_nein_grund = $request->input('einsatznachbesprechung_textfield_nein_grund');
        $einsatznachbesprechung_checkbox_geplant_am = $request->input('einsatznachbesprechung_checkbox_geplant_am');
        $einsatznachbesprechung_textfield_geplant_am = $request->input('einsatznachbesprechung_textfield_geplant_am');

        $rechtliches_textfield_ort = $request->input('rechtliches_textfield_ort');
        $rechtliches_datum = $request->input('rechtliches_datum');
        $rechtliches_textfield_unterschrift = $request->input('rechtliches_textfield_unterschrift');

        //Load PDF from preset folder
        $pages_count = $pdf->setSourceFile('pdf_vorlagen/FO_E00-19-09_V1.0.pdf');

        //loop over all Pages in the PDF
        for($i = 1; $i <= $pages_count; $i++)
        {
            $pdf->AddPage();

            $tplIdx = $pdf->importPage($i);

            $pdf->useTemplate($tplIdx, 0, 0);

            switch ($i) {
                //Add changes to page 1
                case 1:
                    //
                    //Einsatz
                    //

                    //Datum
                    $pdf->SetFont('Arial','',12);
                    $pdf->text(72,45, date("d.m.Y", strtotime($einsatz_datum)));




                    //Beginn
                    $pdf->text(105,45,$einsatz_beginn_time);

                    //Ende
                    $pdf->text(138,45,$einsatz_ende_time);

                    //Einsatz Nr.
                    $pdf->text(171,45,$einsatz_nummer);

                    //Alarmzeit
                    $pdf->text(72,55,$einsatz_alarmzeit_time);

                    //Abfahrzeit (S3)
                    $pdf->text(105,55,$einsatz_abfahrzeit_time);

                    //Eintreffzeit (S4)
                    $pdf->text(138,55,$einsatz_eintreffzeit_time);

                    //Frei Einsatzstelle (S9)
                    $pdf->text(171,55,$einsatz_frei_einsatzstelle_time);

                    //Einsatz Anforderung durch


                    //nach AAO
                    if ($einsatz_checkbox_nach_aao) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(69.2,70.4,'X');
                        $pdf->SetFont('Arial','',12);
                    }

                    //MANV
                    if ($einsatz_checkbox_manv) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(88.5,70.4,'X');
                        $pdf->SetFont('Arial','',12);
                    }

                    //EE
                    if ($einsatz_checkbox_ee) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(104.5,70.4,'X');
                        $pdf->SetFont('Arial','',12);

                    }

                    //FW SWD ab
                    if ($einsatz_checkbox_fw_swd_ab) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(115.8,70.4,'X');
                        $pdf->SetFont('Arial','',12);
                        $pdf->text(137,70,$einsatz_fw_swd_time);
                    }

                    //Sonstiges
                    if ($einsatz_einsatz_anforderung_checkbox_sonstiges) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(158,70.4,'X');
                        $pdf->SetFont('Arial','',12);
                        $pdf->text(162,70,$einsatz_einsatz_anforderung_textfield_sontiges);
                    }


                    //Einsatzort
                    $pdf->SetFont('Arial','',12);
                    $pdf->text(72,80,$einsatz_textfield_einsatzort);

                    //Einsatzart

                    //Brandeinsatz
                    if ($einsatz_checkbox_brandeinsatz) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(69.2,91,'X');
                        $pdf->SetFont('Arial','',12);
                    }

                    //Suchaktion
                    if ($einsatz_checkbox_suchaktion) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(94.3,91,'X');
                        $pdf->SetFont('Arial','',12);
                    }

                    //Verkehrsunfall
                    if ($einsatz_checkbox_verkehrsunfall) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(117,91,'X');
                        $pdf->SetFont('Arial','',12);
                    }

                    //MANV
                    if ($einsatz_einsatzart_checkbox_manv) {

                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(148,91,'X');
                        $pdf->SetFont('Arial','',12);
                    }

                    //Einsatzeinheit
                    if ($einsatz_checkbox_einsatzeinheit) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(170.5,91,'X');
                        $pdf->SetFont('Arial','',12);
                    }

                    //Sonstige
                    if ($einsatz_einsatzart_checkbox_sonstige) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(69.2,98,'X');
                        $pdf->SetFont('Arial','',12);
                        $pdf->text(85,97,'Grund');
                    }

                    //Einsatzauftrag
                    if ($einsatz_textfield_einsatzauftrag) {
                        $pdf->SetFont('Arial','',12);
                        $pdf->text(72,113,$einsatz_einsatzart_textfield_sonstige);

                    }

                    //
                    //Einheit
                    //

                    //Org / LM / Herkunft / Bezeichnung
                    $pdf->text(70,128,$einheit_textfield_org_lm_herkunft_bezeichnung);

                    //
                    //Stärke
                    //

                    //ZF / Ärtzte
                    $pdf->text(137,125,$einheit_textfield_staerke_zf_artzt);

                    //GF
                    $pdf->text(152,125,$einheit_textfield_staerke_gf);

                    //Helfer
                    //GF
                    $pdf->text(168,125, $einheit_textfield_staerke_helfer);

                    //Gesamt
                    //GF
                    $pdf->text(185,125, $einheit_textfield_staerke_gesamt);

                    //
                    //Fahrzeuge
                    //

                    //1
                    $pdf->text(78,142,$fahrzeuge_textfield_1_funkrufname);

                    $pdf->text(120,142,$fahrzeuge_textfield_1_kennzeichen);

                    $pdf->text(160,142,$fahrzeuge_textfield_1_fahrzeugart);

                    //2
                    $pdf->text(78,152,$fahrzeuge_textfield_2_funkrufname);

                    $pdf->text(120,152,$fahrzeuge_textfield_2_kennzeichen);

                    $pdf->text(160,152,$fahrzeuge_textfield_2_fahrzeugart);

                    //3
                    $pdf->text(78,162,$fahrzeuge_textfield_3_funkrufname);

                    $pdf->text(120,162,$fahrzeuge_textfield_3_kennzeichen);

                    $pdf->text(160,162,$fahrzeuge_textfield_3_fahrzeugart);

                    //
                    //Weitere Materialien
                    //
                    $pdf->text(21,176,$weitere_materialien_textfield);

                    //
                    //Kurzbericht
                    //
                    $pdf->text(21,195,$kurzbericht_textfield);

                    //
                    //Sonstige Hinweise / Bemerkungen / Ereignisse
                    //
                    $pdf->text(21,262,$sonstige_hinweise_bemerkungen_ereignisse_textfield);

                    break;
                //Add changes to page 2
                case 2:
                    //
                    //Anzahl Maßnahmen
                    //

                    //EH/SAN/RD
                    $pdf->text(22,28,$anzahl_masnahmen_eh_san_rd);

                    //BTD
                    $pdf->text(57,28,$anzahl_masnahmen_btd);

                    //TuS
                    $pdf->text(92,28,$anzahl_masnahmen_tus);

                    //Verpflegung
                    $pdf->text(127,28,$anzahl_masnahmen_verpflegung);

                    //Sonstiges
                    $pdf->text(162,28,$anzahl_masnahmen_sonstiges);

                    //
                    //Beigefügte Dokumentation
                    //

                    //SWD, RD,Patientenprotokolle
                    $pdf->text(61,46.5,$beigefuegte_dokumentation_swd_rd_patientenprotokolle);

                    //MANV Dokumente
                    $pdf->text(114,46.5,$beigefuegte_dokumentation_manv_dokumente);

                    //Sonstiges
                    $pdf->text(167,46.5,$beigefuegte_dokumentation_sonstiges);

                    //
                    //Helfer
                    //

                    //1
                    //Name, Vorname
                    $pdf->text(35,63,$helfer_1_name_vorname);
                    //BL
                    if($helfer_1_checkbox_bl) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(108,63,'X');
                        $pdf->SetFont('Arial','',12);
                    }
                    //ZF / Artzt
                    if ($helfer_1_checkbox_zf_artzt) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(118,63,'X');
                        $pdf->SetFont('Arial','',12);
                    }
                    //GF
                    if ($helfer_1_checkbox_gf) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(128,63, 'X');
                        $pdf->SetFont('Arial','',12);
                    }
                    //OV-KZ
                    $pdf->text(138.5,63,  preg_replace('/[^0-9]/', '', $helfer_1_dropdown_ov_kz));

                    //Von
                    $pdf->text(149,63,$helfer_1_von_time);
                    //Bis
                    $pdf->text(164,63,$helfer_1_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,63,$helfer_1_checkbox_qualifikation);

                    //2
                    //Name, Vorname
                    $pdf->text(35,73,$helfer_2_name_vorname);
                    //BL
                    if ($helfer_2_checkbox_bl) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(108,73,'X');
                        $pdf->SetFont('Arial','',12);

                    }
                    //ZF / Artzt
                    if ($helfer_2_checkbox_zf_artzt) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(118,73,'X');
                        $pdf->SetFont('Arial','',12);
                    }
                    //GF
                    if ($helfer_2_checkbox_gf) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(128,73,'X');
                        $pdf->SetFont('Arial','',12);
                    }
                    //OV-KZ
                    $pdf->text(138.5,73, preg_replace('/[^0-9]/', '', $helfer_2_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,73,$helfer_2_von_time);
                    //Bis
                    $pdf->text(164,73,$helfer_2_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,73,$helfer_2_checkbox_qualifikation);

                    //3
                    //Name, Vorname
                    $pdf->text(35,83,$helfer_3_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,83, preg_replace('/[^0-9]/', '', $helfer_3_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,83,$helfer_3_von_time);
                    //Bis
                    $pdf->text(164,83,$helfer_3_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,83,$helfer_3_checkbox_qualifikation);

                    //4
                    //Name, Vorname
                    $pdf->text(35,93,$helfer_4_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,93, preg_replace('/[^0-9]/', '', $helfer_4_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,93,$helfer_4_von_time);
                    //Bis
                    $pdf->text(164,93,$helfer_4_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,93,$helfer_4_checkbox_qualifikation);

                    //5
                    //Name, Vorname
                    $pdf->text(35,103,$helfer_5_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,103, preg_replace('/[^0-9]/', '', $helfer_5_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,103,$helfer_5_von_time);
                    //Bis
                    $pdf->text(164,103,$helfer_5_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,103,$helfer_5_checkbox_qualifikation);

                    //6
                    //Name, Vorname
                    $pdf->text(35,113,$helfer_6_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,113, preg_replace('/[^0-9]/', '', $helfer_6_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,113,$helfer_6_von_time);
                    //Bis
                    $pdf->text(164,113,$helfer_6_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,113,$helfer_6_checkbox_qualifikation);

                    //7
                    //Name, Vorname
                    $pdf->text(35,123,$helfer_7_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,123, preg_replace('/[^0-9]/', '', $helfer_7_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,123,$helfer_7_von_time);
                    //Bis
                    $pdf->text(164,123,$helfer_7_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,123,$helfer_7_checkbox_qualifikation);

                    //8
                    //Name, Vorname
                    $pdf->text(35,133,$helfer_8_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,133, preg_replace('/[^0-9]/', '', $helfer_8_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,133,$helfer_8_von_time);
                    //Bis
                    $pdf->text(164,133,$helfer_8_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,133,$helfer_8_checkbox_qualifikation);

                    //9
                    //Name, Vorname
                    $pdf->text(35,143,$helfer_9_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,143, preg_replace('/[^0-9]/', '', $helfer_9_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,143,$helfer_9_von_time);
                    //Bis
                    $pdf->text(164,143,$helfer_9_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,143,$helfer_9_checkbox_qualifikation);

                    //10
                    //Name, Vorname
                    $pdf->text(35,153,$helfer_10_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,153, preg_replace('/[^0-9]/', '', $helfer_10_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,153,$helfer_10_von_time);
                    //Bis
                    $pdf->text(164,153,$helfer_10_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,153,$helfer_10_checkbox_qualifikation);

                    //11
                    //Name, Vorname
                    $pdf->text(35,163,$helfer_11_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,163, preg_replace('/[^0-9]/', '', $helfer_11_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,163,$helfer_11_von_time);
                    //Bis
                    $pdf->text(164,163,$helfer_11_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,163,$helfer_11_checkbox_qualifikation);

                    //12
                    //Name, Vorname
                    $pdf->text(35,173,$helfer_12_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,173, preg_replace('/[^0-9]/', '', $helfer_12_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,173,$helfer_12_von_time);
                    //Bis
                    $pdf->text(164,173,$helfer_12_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,173,$helfer_12_checkbox_qualifikation);

                    //13
                    //Name, Vorname
                    $pdf->text(35,183,$helfer_13_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,183, preg_replace('/[^0-9]/', '', $helfer_13_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,183,$helfer_13_von_time);
                    //Bis
                    $pdf->text(164,183,$helfer_13_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,183,$helfer_13_checkbox_qualifikation);

                    //14
                    //Name, Vorname
                    $pdf->text(35,193,$helfer_14_name_vorname);
                    //OV-KZ
                    $pdf->text(138.5,193, preg_replace('/[^0-9]/', '', $helfer_14_dropdown_ov_kz));
                    //Von
                    $pdf->text(149,193,$helfer_14_von_time);
                    //Bis
                    $pdf->text(164,193,$helfer_14_bis_time);
                    //Qualifiaktion
                    $pdf->text(180,193,$helfer_14_checkbox_qualifikation);

                    //
                    //Einsatznachbesprechung
                    //

                    //durchgeführt
                    if ($einsatznachbesprechung_checkbox_durchgefuehrt) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(22.2,207.8,'X');
                        $pdf->SetFont('Arial','',12);
                    }

                    //nein Grund
                    if ($einsatznachbesprechung_checkbox_nein_grund) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(59.8,207.8,'X');
                        $pdf->SetFont('Arial','',12);
                        $pdf->text(85,207,$einsatznachbesprechung_textfield_nein_grund);
                    }

                    //offen geplant am
                    if ($einsatznachbesprechung_checkbox_geplant_am) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(133.8,207.8,'X');
                        $pdf->SetFont('Arial','',12);
                        $pdf->text(170,207, date("d.m.Y", strtotime($einsatznachbesprechung_textfield_geplant_am)));
                    }

                    //
                    //Rechtliches
                    //
                    //Ort, Datum
                    $pdf->text(20,230, $rechtliches_textfield_ort . ', '.  date("d.m.Y", strtotime($rechtliches_datum)));

                    //Unterschrift E-Leitung/GF

                    $pdf->text(120,230,$rechtliches_textfield_unterschrift);

                    break;
            }
        }

        $pdf->output('F', 'test.pdf');
        exit;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Protokolle  $protokolle
     * @return \Illuminate\Http\Response
     */
    public function show(Protokolle $protokolle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Protokolle  $protokolle
     * @return \Illuminate\Http\Response
     */
    public function edit(Protokolle $protokolle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Protokolle  $protokolle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Protokolle $protokolle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Protokolle  $protokolle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Protokolle $protokolle)
    {
        //
    }
}
