<?php
ob_start();
include ('data.php');
$total = 0;  $total_tva = 0;
?>
    <style type="text/css">
        table {
            width: 100%;
            color: #717375;
            font-family: helvetica;
            line-height: 5mm;
            border-collapse: collapse;
        }
        h2 { margin: 0; padding: 0; }
        p { margin: 5px; }

        .border th {
            border: 1px solid #000;
            color: white;
            background: #000;
            padding: 5px;
            font-weight: normal;
            font-size: 14px;
            text-align: center;
        }
        .border td {
            border: 1px solid #CFD1D2;
            padding: 5px 10px;
            text-align: center;
        }
        .no-border {
            border-right: 1px solid #CFD1D2;
            border-left: none;
            border-top: none;
            border-bottom: none;
        }
        .space { padding-top: 400px;}

        .10p { width: 10%; } .15p { width: 15%; }
        .25p { width: 25%; } .50p { width: 50%; }
        .60p { width: 60%; } .75p { width: 75%; }
    </style>
    <page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;">

        <page_footer>
            <hr />
            <p>Fait a Montpellier, le <?php echo date("d/m/y"); ?></p>
            <p>Merci pour votre confiance.</p>
            <p>L'équipe Hôtel Neptune.</p>
        </page_footer>

        <table style="vertical-align: top;">
            <tr>
                <td class="75p">
                    <strong>Hôtel Neptune</strong><br/>
                    01 23 45 67 89<br/>
                    neptune.contacte@free.fr<br/>
                    51 avenne du Pastis, <br/>5151 PastisLand
                </td>
                <td class="25p">
                    <strong><?php echo $client['firstname']." ".$client['lastname']; ?></strong><br />
                    <?php echo $client['mail'].'<br>'.$client["address"].'<br>'.$client["cp"].'<br>'.$client["ville"]; ?><br />
                </td>
            </tr>
        </table>

        <table style="margin-top: 50px;">
            <tr>
                <td class="50p"><h2>Reservation</h2></td>
                <td class="50p" style="text-align: right;">Fait le <?php echo date("d/m/y"); ?></td>
            </tr>
            <tr>
                <td style="padding-top: 15px;" colspan="2"><?php echo $project['name']; ?></td>
            </tr>
        </table>

        <table style="margin-top: 30px;" class="border">
            <thead>
            <tr>
                <th class="50p">Description</th>
                <th class="15p">Date d'arrivé</th>
                <th class="20p">Date de départ</th>
                <th class="15p">Montant</th>
            </tr>

            </thead>
            <tbody>

            <tr>
                <td class=""><?php echo $chambre['description1'].'<br>' .$chambre['description2'].'<br>' .$chambre['description3'];?></td>
                <td><?php echo $chambre['arrive'];?></td>
                <td><?php echo $chambre['depart'];?></td>
                <td><?php
                    $price_tva = $chambre['price']*1.2;
                    echo $price_tva;
                    ?>€</td>
                <?php
                $total += $chambre['price'];
                $total_tva += $price_tva;
                ?>
            </tr>
            <tr>
                <td class="space"></td>
                <td></td>
                <td></td>
                <td></td></tr>

            <tr>
                <td colspan="2" class="no-border"></td>
                <td style="text-align: center;" rowspan="3"><strong>Total:</strong></td>
                <td>HT : <?php echo $total; ?> €</td>
            </tr>
            <tr>
                <td colspan="2" class="no-border"></td>
                <td>TVA : <?php echo ($total_tva - $total); ?> €</td>
            </tr>
            <tr>
                <td colspan="2" class="no-border"></td>
                <td>TTC : <?php echo $total_tva; ?> €</td>
            </tr>
            </tbody>
        </table>

    </page>

<?php
$content = ob_get_clean();
require_once(__DIR__.'/html2pdf/vendor/autoload.php');

use Spipu\Html2Pdf\Html2Pdf;

try {
    $pdf = new HTML2PDF("p","A4","fr");
    $pdf->pdf->SetAuthor('Hôtel Neptune');
    $pdf->pdf->SetTitle('Reservation: '.$client['firstname']." ".$client['lastname']." | ".$chambre['description1']." | ".$chambre['arrive']." / ".$chambre['depart']);
    $pdf->pdf->SetSubject('Création d\'un Portfolio');
    $pdf->pdf->SetKeywords('HTML2PDF, Devis, PHP');
    $pdf->writeHTML($content);
    $content_PDF = $pdf->Output('','s');

    $txt=base64_encode($content_PDF);
    Base64($BDD,$txt,$_SESSION['id_chambre'],$_SESSION['id_client'],$_SESSION['date_depart'],$_SESSION['date_arrive']);//Ajout à la BDD base64

} catch (HTML2PDF_exception $e) {
    die($e);
}




