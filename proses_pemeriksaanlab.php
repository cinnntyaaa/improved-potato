<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $no = 1;
    $sql = "CALL RL_3_8 ('" . $tanggal . "', '" . $tanggal2 . "');";
    $sql2 = "CALL RL_3_8_Sub ('" . $tanggal . "', '" . $tanggal2 . "');";
    $outp = array();
    $outp2 = array();
    // Execute multi query
    if (mysqli_multi_query($conn, $sql)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                // Fetch one and one row
            }
        } while (mysqli_next_result($conn));
        // foreach ($outp as $key => $subArray) {
        echo "
        <tr>
        <td style='text-align:center;'>1</td>
        <td>HEMATOLOGI</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1</td>
        <td>Sitologi Sel Darah</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1.1</td>
        <td>Eosinofil, hitung jumlah</td>
        <td style='text-align: right;'>" . $outp[0][0]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1.2</td>
        <td>Eritrosit, hitung jumlah</td>
        <td style='text-align: right;'>" . $outp[0][1]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1.3</td>
        <td>Leukosit, hitung jenis</td>
        <td style='text-align: right;'>" . $outp[0][2]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1.4</td>
        <td>Leukosit, hitung jumlah</td>
        <td style='text-align: right;'>" . $outp[0][3]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1.5</td>
        <td>Limfosit plasma biru, hitung jumlah</td>
        <td style='text-align: right;'>" . $outp[0][4]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1.6</td>
        <td>Morfologi sel</td>
        <td style='text-align: right;'>" . $outp[0][5]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1.7</td>
        <td>Retikulosit, hitung jumlah</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.1.8</td>
        <td>Trombosit, hitung jumlah</td>
        <td style='text-align: right;'>" . $outp[0][6]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.2</td>
        <td>Sitokimia darah</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.2.1</td>
        <td>Besi, pewarnaan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.2.2</td>
        <td>Neutrophil Alkaline Phosphatase/NAP, pewarnaan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.2.3</td>
        <td>Nitroblue tetrazoleum, pewarnaan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.2.4</td>
        <td>Periodic Acid Schiff/PAS, pewarnaan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.2.5</td>
        <td>Peroksidase, pewarnaan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.2.6</td>
        <td>Sudan Black B, pewarnaan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.3</td>
        <td>Analisa HB</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.3.1</td>
        <td>Hemoglobin A2, penetapan kadar</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.3.2</td>
        <td>Hemoglobin F, identifikasi</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.3.3</td>
        <td>Hemoglobin F, penetapan kadar</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.4</td>
        <td>Perbankan Darah</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.4.1</td>
        <td>Coomb's, percob. direk, indirek</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.4.2</td>
        <td>Penetapan gol darah A, B, O, Rh dll</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.4.3</td>
        <td>Uji saring antibodi pada darah donor</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.4.4</td>
        <td>Uji silang mayor/minor</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5</td>
        <td>Hemostasis</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.1</td>
        <td>Agregasi trombosit</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.2</td>
        <td>Antitrombin III</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.3</td>
        <td>Cryofibrinogen/cryoglobulin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.4</td>
        <td>D Dimer</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.5</td>
        <td>Euglobulin Clotlysis</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.6</td>
        <td>Faktor pembekuan V, VII, VIII, IX, X</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.7</td>
        <td>Faktor pembekuan VIII, IX, X, penetapan kadar</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.8</td>
        <td>Faktor pembekuan XII, XIII, penetapan kadar</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.9</td>
        <td>Fibrinogen Degradation Product/FDP</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.10</td>
        <td>Fibrinogen, penetapan kadar</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.11</td>
        <td>Pembekuan, masa</td>
        <td style='text-align: right;'>" . $outp[1][0]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.12</td>
        <td>Pembendungan, percobaan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.13</td>
        <td>Perdarahan, masa</td>
        <td style='text-align: right;'>" . $outp[1][1]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.14</td>
        <td>Plasminogen activator inhibitor -1/PAI-1</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.15</td>
        <td>Protein C</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.16</td>
        <td>Protein S</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.17</td>
        <td>Protrombin plasma, masa</td>
        <td style='text-align: right;'>" . $outp[1][2]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.18</td>
        <td>Retraksi bekuan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.19</td>
        <td>Trombin, masa</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.20</td>
        <td>Trombin, penetapan waktu seri</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.21</td>
        <td>Tromboplastin, masa partial teraktivasi</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.5.22</td>
        <td>Trombotest/Owren Test</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6</td>
        <td>Pemeriksaan Lain</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6.1</td>
        <td>Eritrosit, ketahanan osmotik</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6.2</td>
        <td>Ham's test</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6.3</td>
        <td>Hematokrit, penetapan nilai</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6.4</td>
        <td>Hemoglobin Eritrosit Rata-rata/HER</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6.5</td>
        <td>Konsentrasi Hemoglobin Eritrosit Rata-rata/HER</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6.6</td>
        <td>Laju endapan darah</td>
        <td style='text-align: right;'>" . $outp[2][0]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6.7</td>
        <td>Sel L.E.</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>1.6.8</td>
        <td>Volume Eritrosit Rata-rata/VER</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2</td>
        <td>Kimia Klinik</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1</td>
        <td>Protein dan NPN</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.1</td>
        <td>Albumin</td>
        <td style='text-align: right;'>" . $outp[3][0]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.2</td>
        <td>Amoniak</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.3</td>
        <td>Asam urat</td>
        <td style='text-align: right;'>" . $outp[3][1]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.4</td>
        <td>Bilirubin</td>
        <td style='text-align: right;'>" . $outp[3][2]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.5</td>
        <td>Gamma globulin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.6</td>
        <td>Globulin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.7</td>
        <td>Haptoglobin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.8</td>
        <td>Kreatinin</td>
        <td style='text-align: right;'>" . $outp[3][3]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.9</td>
        <td>Methemoglobin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.10</td>
        <td>Mikroalbumin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.11</td>
        <td>Myoglobin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.12</td>
        <td>Porfirin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.13</td>
        <td>Protein Bence Jones</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.14</td>
        <td>Protein Elektroforesis</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.15</td>
        <td>Protein Esbach</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.16</td>
        <td>Protein, penetapan kualitatif</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.17</td>
        <td>Protein, penetapan semikuantitatif</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.7</td>
        <td>Protein Total, penetapan kuantitatif</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.19</td>
        <td>Urea/BUN</td>
        <td style='text-align: right;'>" . $outp[3][4]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.20</td>
        <td>Urobilin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.1.21</td>
        <td>Urobilinogen</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.2</td>
        <td>Karbohidrat</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.2.1</td>
        <td>Amilum</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.2.2</td>
        <td>Eruktosa</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.2.3</td>
        <td>Galaktosa</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.2.4</td>
        <td>Glukosa</td>
        <td style='text-align: right;'>" . $outp[4][0]['sum_all'] . "</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.2.5</td>
        <td>Laktosa</td>
        <td style='text-align: right;'>0</td>
        </tr>
        ";
    }
    if (mysqli_multi_query($conn, $sql2)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                $outp2[] = $result->fetch_all(MYSQLI_ASSOC);
                // Fetch one and one row
            }
        } while (mysqli_next_result($conn));
        echo "
        <tr>
        <td style='text-align:center;'>2.3</td>
        <td>Lipid, Lipoprotein, Apoprotein</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.1</td>
        <td>Apoprotein A/B</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.2</td>
        <td>Fosfolipid/serebrosit/sfingolipid</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.3</td>
        <td>Kolesterol High Density Lipoprotein(HDL)</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.4</td>
        <td>Kolesterol Low Density Lipoprotein(LDL)</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.5</td>
        <td>Kolesterol total</td>
        <td style='text-align: right;'>".$outp2[0][0]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.6</td>
        <td>Lipid total</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.7</td>
        <td>Lipoprotein (a) / Lp (a)</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.8</td>
        <td>Small Dense LDL</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.3.9</td>
        <td>Trigliserida</td>
        <td style='text-align: right;'>".$outp2[0][1]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4</td>
        <td>Enzim</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.1</td>
        <td>Alkali Fosfatase</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.2</td>
        <td>Aldolase/ALD</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.3</td>
        <td>Amilase</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.4</td>
        <td>Asam Fosfatase</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.5</td>
        <td>Cholinesterase</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.6</td>
        <td>Creatinin, Kinase, MB Iso enzym</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.7</td>
        <td>Creatinin, Phosphokinase CPK-NAC = Creatinin Kinase - CK</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.8</td>
        <td>Gamma GT/Glutamil Transferase</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.9</td>
        <td>Glutamat Lakto Dehidrogenase/GLDH</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.10</td>
        <td>Transferase/AST</td>
        <td style='text-align: right;'>".$outp2[1][0]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.11</td>
        <td>Glutamat Piruvat Transaminase/GPT = Alanin Amino Transferase/ALT</td>
        <td style='text-align: right;'>".$outp2[0][1]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.12</td>
        <td>Hidroksi Butirik Dehidrogenase/HBDH</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.13</td>
        <td>Isositrat Dehidrogenase/ICD</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.14</td>
        <td>Laktat Dehidrogenase/LDH</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.15</td>
        <td>Leucine Amino Peptidase/LAP</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.4.16</td>
        <td>Lipase</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5</td>
        <td>Mikronutrient dan Monitoring kadar terapi obat</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.1</td>
        <td>Aminofilin/Teofilin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.2</td>
        <td>Asam Folat</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.3</td>
        <td>Besi, penetapan kadar</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.4</td>
        <td>Besi, TIBC</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.5</td>
        <td>Besi, unstaurated IBC</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.6</td>
        <td>Digitoksin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.7</td>
        <td>Digoksin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.8</td>
        <td>Fenitoin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.9</td>
        <td>Fenobarbital</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.10</td>
        <td>Ferritin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.11</td>
        <td>Iodium</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.12</td>
        <td>Isoniazid</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.13</td>
        <td>Karbamazepin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.14</td>
        <td>Magnesium</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.15</td>
        <td>Metotreksat</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.16</td>
        <td>Propanolol</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.17</td>
        <td>Seng</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.18</td>
        <td>Siklosporin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.19</td>
        <td>Tembaga</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.20</td>
        <td>Vitamin A</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.5.21</td>
        <td>Vitamin B12</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.6</td>
        <td>Elektrolit</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.6.1</td>
        <td>Fosfat anorganik</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.6.2</td>
        <td>Kalium</td>
        <td style='text-align: right;'>".$outp2[2][0]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.6.3</td>
        <td>Kalsium</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.6.4</td>
        <td>Klorida</td>
        <td style='text-align: right;'>".$outp2[2][1]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.6.5</td>
        <td>Natrium</td>
        <td style='text-align: right;'>".$outp2[2][2]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.6.6</td>
        <td>Magnesium</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7</td>
        <td>Fungsi Organ</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.1</td>
        <td>Asam Laktat</td>
        <td style='text-align: right;'>".$outp2[3][0]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.2</td>
        <td>Creatinin clearance</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.3</td>
        <td>Cystatin C</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.4</td>
        <td>Indeks ikterus</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.5</td>
        <td>Insulin clearance</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.6</td>
        <td>Insulin dalam plasma</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.7</td>
        <td>Kalsium</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.8</td>
        <td>Lemak, tes absorbsi</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.7.9</td>
        <td>Urea clearance</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8</td>
        <td>Hormon dan Fungsi Endokrin</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.1</td>
        <td>Adenocorticotropin Hormon/ACTH</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.2</td>
        <td>Anti Deuretik Hormon/ADH Respon</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.3</td>
        <td>Aldosteron</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.4</td>
        <td>Calcitonin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.5</td>
        <td>C Peptide</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.6</td>
        <td>Estrogen</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.7</td>
        <td>Estradiol, 17 Beta</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.8</td>
        <td>Follicle Stimulating Hormon</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.9</td>
        <td>Fruktosamin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.10</td>
        <td>Gastrin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.11</td>
        <td>Glucocorticoid</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.12</td>
        <td>Growth Hormon</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.13</td>
        <td>Hb glikosilat / HbA1c</td>
        <td style='text-align: right;'>".$outp2[4][0]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.14</td>
        <td>Human Chorionic Gonadotropin/HCG</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.15</td>
        <td>Insulin Growth factor 1 / IGF1</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.16</td>
        <td>Iodine uptake dan saturasi/T3 dan T4 uptake</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.17</td>
        <td>Insulin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.18</td>
        <td>Keton</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.19</td>
        <td>Kortisol</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.20</td>
        <td>Luteinizing Hormon/LH</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.21</td>
        <td>Pankreas, fungsi dengan tes triolen</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.22</td>
        <td>Pregnandiol</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.23</td>
        <td>Progesteron</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.24</td>
        <td>Prolaktin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.25</td>
        <td>Renin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.26</td>
        <td>Testosteron</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.27</td>
        <td>Thyroglobulin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.28</td>
        <td>Thyroxin dalam serum/T4</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.29</td>
        <td>Thyrotropic Release Factor Assay</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.30</td>
        <td>Thyroid Stimulating Hormon/TSH</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.31</td>
        <td>Thyroid, tes fungsi yang lain</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.8.32</td>
        <td>Vinyl Mandelic Acid/VMA</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9</td>
        <td>Pemeriksaan Lain</td>
        <td></td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.1</td>
        <td>Analisa batu</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.2</td>
        <td>Analisa cairan otak</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.3</td>
        <td>Analisa cairan sendi</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.4</td>
        <td>Analisa cairan tubuh</td>
        <td style='text-align: right;'>".$outp2[5][0]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.5</td>
        <td>Jumlah, morfologi</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.6</td>
        <td>Analisa tinja: sel darah, lemak, sisa makanan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.7</td>
        <td>Hemosiderin</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.8</td>
        <td>Homosistein</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.9</td>
        <td>oval fat bodies</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.10</td>
        <td>Sel, hitung jenis</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.11</td>
        <td>Sel, hitung jumlah</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.12</td>
        <td>Tes kehamilan</td>
        <td style='text-align: right;'>0</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.13</td>
        <td>Troponin T/I</td>
        <td style='text-align: right;'>".$outp2[5][1]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align:center;'>2.9.14</td>
        <td>Urinalisis</td>
        <td style='text-align: right;'>".$outp2[5][2]['sum_all']."</td>
        </tr>
        <tr>
        <td style='text-align: center;'>99</td>
        <td>TOTAL</td>
        <td id='jumlah' style='text-align: right;'></td>
        </tr>
        ";
        
    }
}

mysqli_close($conn);
