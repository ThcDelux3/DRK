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
        $einsatz_frei_einsatzstelle = $request->input('einsatz_frei_einsatzstelle');

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

        $einsatznachbesprechung_checkbox_durchgefuehrt = $request->input('einsatznachbesprechung_checkbox_durchgefuehrt');
        $einsatznachbesprechung_checkbox_nein_grund = $request->input('einsatznachbesprechung_checkbox_nein_grund');
        $einsatznachbesprechung_textfield_nein_grund = $request->input('einsatznachbesprechung_textfield_nein_grund');
        $einsatznachbesprechung_checkbox_offen = $request->input('einsatznachbesprechung_checkbox_offen');
        $einsatznachbesprechung_checkbox_geplant_am = $request->input('einsatznachbesprechung_checkbox_geplant_am');
        $einsatznachbesprechung_textfield_geplant_am = $request->input('einsatznachbesprechung_textfield_geplant_am');

        $rechtliches_textfield_ort = $request->input('rechtliches_textfield_ort');
        $rechtliches_textfield_datum = $request->input('rechtliches_textfield_datum');
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
                    $pdf->text(72,45,$einsatz_datum);

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
                    $pdf->text(171,55,$einsatz_frei_einsatzstelle);

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

                    //Stärke







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
                    $pdf->text(35,63,'Name, Vorname');
                    //BL
                    $pdf->text(108,63,'X');
                    //ZF / Artzt
                    $pdf->text(118,63,'X');
                    //GF
                    $pdf->text(128,63,'X');
                    //OV-KZ
                    $pdf->text(138.5,63,'VL');
                    //Von
                    $pdf->text(149,63,'19:00');
                    //Bis
                    $pdf->text(164,63,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,63,'SanC');

                    //2
                    //Name, Vorname
                    $pdf->text(35,73,'Name, Vorname');
                    //BL
                    $pdf->text(108,73,'X');
                    //ZF / Artzt
                    $pdf->text(118,73,'X');
                    //GF
                    $pdf->text(128,73,'X');
                    //OV-KZ
                    $pdf->text(138.5,73,'VL');
                    //Von
                    $pdf->text(149,73,'19:00');
                    //Bis
                    $pdf->text(164,73,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,73,'SanC');

                    //3
                    //Name, Vorname
                    $pdf->text(35,83,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,83,'VL');
                    //Von
                    $pdf->text(149,83,'19:00');
                    //Bis
                    $pdf->text(164,83,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,83,'SanC');

                    //4
                    //Name, Vorname
                    $pdf->text(35,93,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,93,'VL');
                    //Von
                    $pdf->text(149,93,'19:00');
                    //Bis
                    $pdf->text(164,93,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,93,'SanC');

                    //5
                    //Name, Vorname
                    $pdf->text(35,103,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,103,'VL');
                    //Von
                    $pdf->text(149,103,'19:00');
                    //Bis
                    $pdf->text(164,103,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,103,'SanC');

                    //6
                    //Name, Vorname
                    $pdf->text(35,113,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,113,'VL');
                    //Von
                    $pdf->text(149,113,'19:00');
                    //Bis
                    $pdf->text(164,113,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,113,'SanC');

                    //7
                    //Name, Vorname
                    $pdf->text(35,123,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,123,'VL');
                    //Von
                    $pdf->text(149,123,'19:00');
                    //Bis
                    $pdf->text(164,123,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,123,'SanC');

                    //8
                    //Name, Vorname
                    $pdf->text(35,133,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,133,'VL');
                    //Von
                    $pdf->text(149,133,'19:00');
                    //Bis
                    $pdf->text(164,133,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,133,'SanC');

                    //9
                    //Name, Vorname
                    //Name, Vorname
                    $pdf->text(35,143,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,143,'VL');
                    //Von
                    $pdf->text(149,143,'19:00');
                    //Bis
                    $pdf->text(164,143,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,143,'SanC');

                    //10
                    //Name, Vorname
                    $pdf->text(35,153,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,153,'VL');
                    //Von
                    $pdf->text(149,153,'19:00');
                    //Bis
                    $pdf->text(164,153,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,153,'SanC');

                    //11
                    //Name, Vorname
                    $pdf->text(35,163,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,163,'VL');
                    //Von
                    $pdf->text(149,163,'19:00');
                    //Bis
                    $pdf->text(164,163,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,163,'SanC');

                    //12
                    //Name, Vorname
                    $pdf->text(35,173,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,173,'VL');
                    //Von
                    $pdf->text(149,173,'19:00');
                    //Bis
                    $pdf->text(164,173,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,173,'SanC');

                    //13
                    //Name, Vorname
                    $pdf->text(35,183,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,183,'VL');
                    //Von
                    $pdf->text(149,183,'19:00');
                    //Bis
                    $pdf->text(164,183,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,183,'SanC');

                    //14
                    //Name, Vorname
                    $pdf->text(35,193,'Name, Vorname');
                    //OV-KZ
                    $pdf->text(138.5,193,'VL');
                    //Von
                    $pdf->text(149,193,'19:00');
                    //Bis
                    $pdf->text(164,193,'20:00');
                    //Qualifiaktion
                    $pdf->text(180,193,'SanC');

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
                    if ($einsatznachbesprechung_checkbox_offen) {
                        $pdf->SetFont('Arial','B',12);
                        $pdf->text(133.8,207.8,'X');

                    }

                    //geplant am
                    if ($einsatznachbesprechung_checkbox_geplant_am) {
                        $pdf->SetFont('Arial','',12);
                        $pdf->text(170,207,$einsatznachbesprechung_textfield_geplant_am);
                    }


                    //
                    //Rechtliches
                    //
                    //Ort, Datum
                    $pdf->text(20,230,$rechtliches_textfield_datum  . ', '. $rechtliches_textfield_ort);

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
