<?php

namespace Webacked\SimplePay;

use Exception;
use Illuminate\Support\Facades\Config;
use Webacked\Cart\Facades\Cart;

require_once 'SimplePayV21.php';

class SimplePay {
  function test($order) {
    $config = Config::get('simple-pay');

    // new SimplePayStart instance
    $trx = new SimplePayStart;
    //add config data
    $trx->addConfig($config);

    $billingData = json_decode($order->billing_data, true);
    $shippingData = json_decode($order->shipping_data, true);
    $cart = Cart::get();
    $timeoutInSec = 600;

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
    $trx->addData('total', Cart::price());
    $trx->addData('orderRef', $order->order_id);
    $trx->addData('customer', 'v2 START Tester');
    $trx->addData('customerEmail', $billingData['email']);
    $trx->addData('language', 'HU');
    $trx->addData('timeout ', date("c", time() + $timeoutInSec));
    $trx->addData('methods', array('CARD'));
    $trx->addGroupData('urls', 'success', $config['URL_SUCCESS']);
    $trx->addGroupData('urls', 'fail', $config['URL_FAIL']);
    $trx->addGroupData('urls', 'cancel', $config['URL_CANCEL']);
    $trx->addGroupData('urls', 'timeout', $config['URL_TIMEOUT']);

    // invoice
    $trx->addGroupData('invoice', 'name', $billingData['name']);
    $trx->addGroupData('invoice', 'country', 'HU');
    $trx->addGroupData('invoice', 'city', $billingData['city']);
    $trx->addGroupData('invoice', 'zip', $billingData['zip']);
    $trx->addGroupData('invoice', 'address', $billingData['address']);
    $trx->addGroupData('invoice', 'address2', '');
    $trx->addGroupData('invoice', 'phone', $billingData['phone']);

    // delivery
    $trx->addGroupData('delivery', 'name', $shippingData['name']);
    $trx->addGroupData('delivery', 'country', 'HU');
    $trx->addGroupData('delivery', 'city', $shippingData['city']);
    $trx->addGroupData('delivery', 'zip', $shippingData['zip']);
    $trx->addGroupData('delivery', 'address', $shippingData['address']);
    $trx->addGroupData('delivery', 'address2', '');
    $trx->addGroupData('delivery', 'phone', $shippingData['phone']);

    $trx->formDetails['element'] = 'button';
    //create transaction in SimplePay system
    $trx->runStart();

    return $trx->returnData['paymentUrl'];
  }
}
