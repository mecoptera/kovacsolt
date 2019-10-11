<?php

namespace Webacked\SimplePay;

use Exception;
use Illuminate\Support\Facades\Config;
use Webacked\Cart\Facades\Cart;

require_once 'SimplePayV21.php';

class SimplePay {
  function test() {
    $config = Config::get('simple-pay');

    // new SimplePayStart instance
    $trx = new SimplePayStart;
    //add config data
    $trx->addConfig($config);

    $cart = Cart::get();

    foreach ($cart as $item) {
      $trx->addItems(array(
        'ref' => $item['product']->id,
        'title' => $item['product']->name,
        'description' => $item['product']->id,
        'amount' => $item['quantity'],
        'price' => $item['product']->discountPrice,
        'tax' => 0
      ));
    }

    $trx->addData('shippingCost', 1200);

    //add transaction data
    $trx->addData('currency', 'HUF');
    $trx->addData('total', '100');
    $trx->addData('orderRef', str_replace(array('.', ':', '/'), "", @$_SERVER['SERVER_ADDR']) . @date("U", time()) . rand(1000, 9999));
    $trx->addData('customer', 'v2 START Tester');
    $trx->addData('customerEmail', 'sdk_test@otpmobil.com');
    $trx->addData('language', 'HU');
    $timeoutInSec = 600;
    $trx->addData('timeout ', date("c", time() + $timeoutInSec));
    $trx->addData('methods', array('CARD'));
    $trx->addData('url', $config['URL']);
    // invoice
    $trx->addGroupData('invoice', 'name', 'SimplePay V2 Tester');
    $trx->addGroupData('invoice', 'company', '');
    $trx->addGroupData('invoice', 'country', 'hu');
    $trx->addGroupData('invoice', 'state', 'Budapest');
    $trx->addGroupData('invoice', 'city', 'Budapest');
    $trx->addGroupData('invoice', 'zip', '1111');
    $trx->addGroupData('invoice', 'address', 'Address 1');
    $trx->addGroupData('invoice', 'address2', '');
    $trx->addGroupData('invoice', 'phone', '06203164978');
    // delivery
    $trx->addGroupData('delivery', 'name', 'SimplePay V2 Tester');
    $trx->addGroupData('delivery', 'company', '');
    $trx->addGroupData('delivery', 'country', 'hu');
    $trx->addGroupData('delivery', 'state', 'Budapest');
    $trx->addGroupData('delivery', 'city', 'Budapest');
    $trx->addGroupData('delivery', 'zip', '1111');
    $trx->addGroupData('delivery', 'address', 'Address 1');
    $trx->addGroupData('delivery', 'address2', '');
    $trx->addGroupData('delivery', 'phone', '06203164978');

    $trx->formDetails['element'] = 'button';
    //create transaction in SimplePay system
    $trx->runStart();

    return $trx->returnData['paymentUrl'];
  }
}
