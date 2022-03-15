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

$phoneCheck = true;

if (isset($_GET['name']) && isset($_GET['phonenumber'])) {
    $myOwner = new Owner($_GET['name'], $_GET['phonenumber']);
    $phoneCheck = $myOwner->isPhoneNumberValid();

    if ($phoneCheck) {
        $data = "Hello! I'm the Pet of {$myOwner->getName()}, please call {$myOwner->getPhonenumber()} - he/she'll be so glad!";

        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($data)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->labelText('Pet-Emergency-Tracker')
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())
            ->build();

        header('Content-Type: ' . $result->getMimeType());
        echo $result->getString();
    }
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

<div class="min-h-screen flex justify-center items-center flex-col bg-amber-100">
    <div class="bg-amber-600 rounded-md p-10 drop-shadow-md my-10 mx-10 sm:w-5/12 w-11/12">
        <h1 class="sm:text-5xl text-4xl font-bold text-amber-300 text-center">
            Pet Emergency Tracker
        </h1>
    </div>

    <?php
    if (!$phoneCheck) {
        echo <<<PHONE_ERROR
    <div role="alert" class="bg-amber-600 rounded-md drop-shadow-md m-5 sm:w-5/12 w-11/12">
        <div class="bg-red-500 text-white font-bold rounded-t-md px-4 py-2">
            Error
        </div>
        <div class="border border-t-0 border-red-400 rounded-b-md bg-red-100 px-4 py-3 text-red-700">
            <p>Incorrect Phone Number!</p>
        </div>
    </div>
PHONE_ERROR;
    }
    ?>

    <form method="get"
          class="bg-amber-600 rounded-md p-10 drop-shadow-md text-4xl my-10 mx-10 flex flex-col sm:w-7/12 w-11/12">
        <input type="text" name="name"
               class="bg-amber-100 p-5 rounded-md drop-shadow-md placeholder-amber-400 text-amber-600"
               placeholder="Name" required>
        <input type="text" name="phonenumber"
               class="bg-amber-100 my-10 p-5 rounded-md drop-shadow-md placeholder-amber-400 text-amber-600"
               placeholder="Phone-number" required>
        <input type="submit" value="Submit"
               class="bg-amber-400 p-5 font-bold text-amber-700 rounded-md drop-shadow-md hover:drop-shadow-xl ease-in duration-200">
    </form>
</div>

</body>
</html>

