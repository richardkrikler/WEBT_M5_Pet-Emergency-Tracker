<?php

require 'vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


$data = '+43 1 22 33 444';

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($data)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->build();

// Directly output the QR code
header('Content-Type: ' . $result->getMimeType());
echo $result->getString();

// Save it to a file
//$result->saveToFile(__DIR__.'/qrcode.png');

// Generate a data URI to include image data inline (i.e. inside an <img> tag)
//$dataUri = $result->getDataUri();

