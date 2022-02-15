<?php
require 'vendor/autoload.php';

use Htlw3r\Pettracker\Model\Owner;

$myOwner = new Owner('TLA', '06767690278');

//$data = 'Name: ' . $myOwner->getName() . ' Phonenumber: ' . $myOwner->getPhonenumber();
$data = "Hello! My name is HONEYPIE, I'm the Cat of {$myOwner->getName()}, please call {$myOwner->getPhonenumber()} - he'll be so glad!";

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($data)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    //   ->logoPath('/assets/symfony.png')
    ->labelText('This is the label')
    ->labelFont(new NotoSans(20))
    ->labelAlignment(new LabelAlignmentCenter())
    ->build();

// Directly output the QR code
header('Content-Type: ' . $result->getMimeType());
echo $result->getString();

//// Save it to a file
//$result->saveToFile(__DIR__.'/qrcode.png');
//
//// Generate a data URI to include image data inline (i.e. inside an <img> tag)
//$dataUri = $result->getDataUri();

