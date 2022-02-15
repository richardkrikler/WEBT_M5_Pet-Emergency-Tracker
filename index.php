<?php

require 'vendor/autoload.php';

use Htlw3r\Pettracker\Model\Owner;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


if (isset($_GET['name']) && isset($_GET['phonenumber'])) {
    $myOwner = new Owner($_GET['name'], $_GET['phonenumber']);

    $data = "Hello! My name is HONEYPIE, I'm the Cat of {$myOwner->getName()}, please call {$myOwner->getPhonenumber()} - he'll be so glad!";

    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data($data)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->labelText('This is the label')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->build();

    header('Content-Type: ' . $result->getMimeType());
    echo $result->getString();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet-Emergency-Tracker</title>
    <link href="dist/output.css" rel="stylesheet">
</head>
<body>

<form method="get">
    <input type="text" name="name">
    <input type="text" name="phonenumber">
    <input type="submit" value="Submit">
</form>

</body>
</html>

