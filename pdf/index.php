<?php

require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtmlFile('https://www.18jorissen.co.za/app/admin_print_invoice.php?id=1');
// $dompdf->loadHtmlFile('http://localhost:8080/18J/getQuotation.php?id=6');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();