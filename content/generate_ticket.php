<?php
ob_start();

require('../admin/src/php/utils/check_connection_client.php');
require('../admin/src/php/utils/fpdf186/fpdf.php');
require('../admin/src/php/db/db_pg_connect.php');
require('../admin/src/php/utils/phpqrcode/qrlib.php'); // <-- inclure la lib QR code
require('../admin/src/php/classes/Autoloader.class.php');

Autoloader::register();

$cnx = Connection::getInstance($dsn, $user, $password);
if (!isset($_SESSION['client']['id_client'])) {
    ob_end_clean();
    die("Accès refusé");
}

$id_client = $_SESSION['client']['id_client'] ?? null;
$id_reservation = $_GET['id_reservation'] ?? null;
$nom = $_SESSION['client']['nom_client'];
$prenom = $_SESSION['client']['prenom_client'];
if (!$id_client || !$id_reservation) {
    ob_end_clean();
    die("Données manquantes");
}

$dao = new Vue_reservationsDAO($cnx);
$reservations = $dao->getReservationsByClient($id_client);

$reservation = null;
foreach ($reservations as $res) {
    if ($res->getId_reservation() == $id_reservation) {
        $reservation = $res;
        break;
    }
}

if (!$reservation) {
    ob_end_clean();
    die("Réservation introuvable.");
}

// Génération QR code dans un fichier temporaire
$tmpFile = tempnam(sys_get_temp_dir(), 'qr') . '.png';

$qrText = 'https://exemplederedirection.com/verification_ticket.php?id_reservation=' . $reservation->getId_reservation();

QRcode::png($qrText, $tmpFile, 'L', 4, 2);

// Création PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'TICKET DE RESERVATION', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Numero de reservation :', 0, 0);
$pdf->Cell(0, 10, $reservation->getId_reservation(), 0, 1);

$pdf->Cell(50, 10, 'Titulaire :', 0, 0);
$pdf->Cell(0, 10, $prenom . ' ' . $nom, 0, 1);


$pdf->Cell(50, 10, 'Titre :', 0, 0);
$pdf->Cell(0, 10, $reservation->getTitre(), 0, 1);

$pdf->Cell(50, 10, 'Date :', 0, 0);
$pdf->Cell(0, 10, date('d/m/Y H:i', strtotime($reservation->getDate_representation())), 0, 1);

$pdf->Cell(50, 10, 'Salle :', 0, 0);
$pdf->Cell(0, 10, $reservation->getNum_salle(), 0, 1);

$pdf->Ln(15);
$pdf->Cell(0, 10, 'Presenter ce code QR a votre arrivee :', 0, 1);
$pdf->Image($tmpFile, $pdf->GetX() + 60, $pdf->GetY(), 50, 50);

unlink($tmpFile);


ob_end_clean();
$pdf->Output('D', 'ticket.pdf');
exit;