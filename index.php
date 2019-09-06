<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Jawira\CaseConverter\Convert;
use num8er\TranzWarePaymentGateway\CurrencyCodes;
use Payment\LiqPayPG;
use Payment\TWPG;

require_once 'vendor\autoload.php';

//$pg = new LiqPayPG('i86522744837', 'HQEVZCsB8K3GRIb1lfEhlT0h8jnWmlwlI5CscbXK');
//
////$result = $pg->createOrder([
////    'currency'      => 'EUR',
////    'amount'        => 0.01,
////    'description'   => 'Test payment',
////    'orderId'       => mt_rand(10000000, 99999999)
////]);
////
////echo '<pre>'; print_r($result); echo '</pre>';
//
//$now = new \DateTime();
//
//echo '<pre>'; print_r($now->sub(new \DateInterval('P1100D'))->format('Y-m-d')); echo '</pre>';
//
//$result = $pg->getOrders([
//    'from'  => 1471261995000,
//    'to'    => 1471261996000
//]);
//
//echo '<pre>'; print_r($result); echo '</pre>';
//
//$result = $pg->getOrderStatus([
//    'orderId' => '12345.а'
//]);
//
//echo '<pre>'; print_r($result); echo '</pre>';

$callbackUrl = 'sandbox.loc';

$twpg = new TWPG(
    'https://twecp.privatbank.lv:8443/Exec',
    'I0LVPRFA',
    $callbackUrl,
    $callbackUrl,
    $callbackUrl
);

$twpg->setCertificate(
    __DIR__ . "\certificates\i0lvprfa.cer",
    __DIR__ . "\certificates\i0lvprfa.pem",
    'AAPRfLmn2Sm5ww6T'
);

$twpg->setDebugFile(__DIR__ . '\debug.log');

//$response = $twpg->createOrder([
//    'amount'        => 1,
//    'currency'      => CurrencyCodes::EUR,
//    'description'   => 'Test payment'
//]);
//
//echo '<pre>'; print_r($response); echo '</pre>';

//$str = str_replace('_', '', 'PRE_AUTH');

$value = 'PRE_aUTH';
$rus = new Convert($value);
echo $rus->toPascal();   // output: оченьПриятно

//$response = $twpg->getOrderStatus([
//    'orderId'   => '',
//    'sessionId' =>
//]);
//
//echo '<pre>'; print_r($response); echo '</pre>';


