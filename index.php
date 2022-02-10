<?php

require_once('pdf/examples/tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetProtection(array('print', 'copy'), '', null, 0, null);


$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('jharkhandstatepharmacycouncil');
$pdf->setTitle('Certificate');
$pdf->setSubject('jharkhandstatepharmacycouncil');
$pdf->setKeywords('jharkhandstatepharmacycouncil');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set certificate file
$certificate = 'file://'.realpath('cert/kau.cer');
$privatekey = 'file://'.realpath('cert/kauencr.cer');
$certificate = 'file://'.realpath('cert/1/signed.crt');
$privatekey = 'file://'.realpath('cert/1/mykey.key');

$info = array(
    'Name' => 'testing123',
    'Location' => 'ISB',
    'Reason' => 'Testing TCPDF',
    'ContactInfo' => 'http://www.tcpdf.org',
);

// set document signature
$pdf->setSignature($certificate, $privatekey, 'testing@123', '', 2, $info);


// set font
$pdf->setFont('times', 'BI', 20);

// add a page
$pdf->AddPage();
$pdf->setJPEGQuality(75);

//$html = file_get_contents('file:///C:/xampp/htdocs/pdf/generated/Document.html');

$html=<<<EOD
<style>
    *,div,span,p{
        margin: 0;
    }
    p{margin: 0;}
    .clr{color: #4F5798;}
</style>
<span style="font-size: 15px; color: #4F5798;">Transaction No : <u>201124822537</u></span>
<div style="font-size: 29px; font-weight: bold; text-align:center;text-decoration: underline" class="clr">JHARKHAND STATE PHARMACY <br> COUNCIL RANCHI</div>
<div style="font-size: 16px; font-weight: bold; text-align:center; color: #4F5798;">Renewal Certificate Under Section 34(3) of the Pharmacy Act. 1948 as amended by Act. 24 of 1959 </div>
EOD;
$pdf->Image('generated/Document_files/photo_164241572761e5466f80e89.jpeg', 175, 15, 30, 30, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
$html .=<<<EOD
<div class="clr" style="font-size: 18px; display: flex">
    <span style="float: left; width: 200px;">Receipt. No. : <u>00001</u></span> _______________________________
    <span style="float: right; margin-left: 100px;">Date : <u>05-02-2022</u></span>
</div>

<p class="clr" style="font-size: 22px;">
    <span>Received Rs. <u style="font-size: 20px">200.00        </u>	(In words) <u style="font-size: 20px">Two Hundred Rupees         </u></span><br>
    <span>From Shri <u style="font-size: 20px">KAUSHLENDRA KUMAR</u></span> Address <br>
    <u style="font-size: 20px">AT-HARIHAR SINGH ROAD, NEAR PATNA KHATAL MORABADI, P.S-BARIATU, DIST.-RANCHI, JHARKHAND-834008</u>
    on account of Renewal of Registration
    No.	<u style="font-size: 20px">03020</u>
    of	<u style="font-size: 20px">22-05-2018</u>
    upto 31.12.2022 and this receipt is issued in token of Renewal of the said Registration.
</p>
EOD;

//$html .=<<<EOD

//EOD;
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date("H:m:s").'+05:30';

$html .=<<<EOD
<table  cellspacing="3" cellpadding="4">
    <tr>
        <th align="left" style="float: left;">
            
    </th>
        <th align="right" style="float: right;">
            <table>
                <tr>
                    <td style="float: right; font-size: 10px;font-family: “Arial”">
                        Digitally signed by<br>
                        KAUSHLENDRA KUMAR<br>
                        Date: {$date}<br>
                        {$time}<br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <span style="font-family: “Arial Bold”, sans-serif; font-size:14px;">Registrar-cum-Secretary </span>
                    </td>
                </tr>
                <tr style="font-family: “Arial”, sans-serif; font-size:13px;">
                    <td>
                    Jharkhand State Pharmacy Council<br>
                    Bariatu, Ranchi-834009(Jharkhand)
                    </td>
                </tr>
            </table>
        </th>
    </tr>
</table>
EOD;


$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Image('http://localhost:8080/pdf/generated/Document_files/tick.png', 147, 142, 15, 15, 'PNG');
$pdf->Image('http://localhost:8080/pdf/generated/Document_files/stamp.png', 10, 137, 50, 35, 'PNG');
$pdf->setSignatureAppearance(149, 143, 47, 15);


$pdf->lastPage();


$path = "C:/xampp/htdocs/pdf/generated/test.pdf";
echo $pdf->Output($path, 'F');