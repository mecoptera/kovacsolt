<?php

namespace Webacked\SimplePay;

use Webacked\Cart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SimplePayController extends Controller {
  public function index() {
    $cart = Cart::get();

    return view('simplepay::index', [
      'cart' => $cart,
      'priceTotal' => Cart::priceTotal(),
      'simplePayForm' => $this->createSimplePayForm($cart)
    ]);
  }

  public function backref() {
    return view('simplepay::backref', [ 'backref' => $this->createBackref() ]);
  }

  private function createSimplePayForm($cart) {
    require_once __DIR__.'/../vendor/config.php';
    require_once __DIR__.'/../vendor/SimplePayment.class.php';

    $orderCurrency = 'HUF';
    $testOrderId = Str::uuid();

    $lu = new SimpleLiveUpdate($config, $orderCurrency);
    $lu->setField("ORDER_REF", $testOrderId);

    foreach ($cart as $item) {
      $lu->addProduct(array(
        'name' => $item['product']->name,
        'code' => $item['product']->id,
        'info' => $item['product']->id,
        'price' => $item['product']->price,
        'vat' => 0,
        'qty' => $item['quantity']
      ));
    }

    //Billing data
    $lu->setField("BILL_FNAME", "Tester");
    $lu->setField("BILL_LNAME", "SimplePay Nogui");
    $lu->setField("BILL_EMAIL", "sdk_test@otpmobil.com");
    $lu->setField("BILL_PHONE", "36201234567");
    //$lu->setField("BILL_COMPANY", "Company name");                // optional
    //$lu->setField("BILL_FISCALCODE", " ");                        // optional
    $lu->setField("BILL_COUNTRYCODE", "HU");
    $lu->setField("BILL_STATE", "State");
    $lu->setField("BILL_CITY", "City");
    $lu->setField("BILL_ADDRESS", 'First line address');
    //$lu->setField("BILL_ADDRESS2", "Second line address");        // optional
    $lu->setField("BILL_ZIPCODE", "1234");

    //Delivery data
    $lu->setField("DELIVERY_FNAME", "Tester");
    $lu->setField("DELIVERY_LNAME", "SimplePay Nogui");
    $lu->setField("DELIVERY_EMAIL", "");
    $lu->setField("DELIVERY_PHONE", "36201234567");
    $lu->setField("DELIVERY_COUNTRYCODE", "HU");
    $lu->setField("DELIVERY_STATE", "State");
    $lu->setField("DELIVERY_CITY", "City");
    $lu->setField("DELIVERY_ADDRESS", "First line address");
    //$lu->setField("DELIVERY_ADDRESS2", "Second line address");    // optional
    $lu->setField("DELIVERY_ZIPCODE", "1234");

    $display = $lu->createHtmlForm('SimplePayForm', 'button', 'Fizetés', 'btn btn-primary');
    $lu->errorLogger();

    return $display;
  }

  private function createBackref() {
    require_once __DIR__.'/../vendor/config.php';
    require_once __DIR__.'/../vendor/translations.php';
    require_once __DIR__.'/../vendor/SimplePayment.class.php';

    $orderCurrency = (isset($_REQUEST['order_currency'])) ? $_REQUEST['order_currency'] : 'N/A';
    $orderRef = (isset($_REQUEST['order_ref'])) ? $_REQUEST['order_ref'] : 'N/A';

    $backref = new SimpleBackRef($config, $orderCurrency );
    $backref->order_ref = $orderRef;

    $links = "";
    if($backref->checkResponse()){
      $backStatus = $backref->backStatusArray;
      $message = '';
      //CCVISAMC
      if ($backStatus['PAYMETHOD'] == 'Visa/MasterCard/Eurocard') {
        $message .= '<b><font color="green">' . SUCCESSFUL_CARD_AUTHORIZATION . '</font></b><br/>';
        if ($backStatus['ORDER_STATUS'] == 'IN_PROGRESS') {
          $message .= '<b><font color="green">' . WAITING_FOR_IPN . '</font></b><br/>';
        } elseif ($backStatus['ORDER_STATUS' ] == 'PAYMENT_AUTHORIZED') {
          $message .= '<b><font color="green">' . WAITING_FOR_IPN . '</font></b><br/>';
        } elseif ($backStatus['ORDER_STATUS'] == 'COMPLETE') {
          $message .= '<b><font color="green">' . CONFIRMED_IPN . '</font></b><br/>';
        }
      }
      //WIRE
      elseif ($backStatus['PAYMETHOD'] == 'Bank/Wire transfer') {
        $message = '<b><font color="green">' . SUCCESSFUL_WIRE . '</font></b><br/>';
        if ($backStatus['ORDER_STATUS'] == 'PAYMENT_AUTHORIZED' || $backStatus['ORDER_STATUS'] == 'COMPLETE') {
          $message .= '<b><font color="green">' . CONFIRMED_WIRE . '</font></b><br/>';
        }
      }
      $links .= '<a href="irn.php?order_ref=' . $backStatus['REFNOEXT'] . '&payrefno=' . $backStatus['PAYREFNO'] . '&ORDER_AMOUNT=1207&AMOUNT=1207&ORDER_CURRENCY=' . $orderCurrency . '">IRN</a>';
      $links .= ' | <a href="idn.php?order_ref=' . $backStatus['REFNOEXT'] . '&payrefno=' . $backStatus['PAYREFNO'] . '&ORDER_AMOUNT=1207&ORDER_CURRENCY=' . $orderCurrency . '">IDN</a>';
    } else {
      $backStatus = $backref->backStatusArray;
      $message = '<b><font color="red">' . UNSUCCESSFUL_TRANSACTION . '</font></b><br/>';
      $message .= '<b><font color="red">' . END_OF_TRANSACTION . '</font></b><br/>';
      $message .= UNSUCCESSFUL_NOTICE . '<br/><br/>';
    }

    $links .= ' | <a href="ios.php?simpleid=' . $backStatus['PAYREFNO'] . '&order_ref=' . $backStatus['REFNOEXT'] . '&ORDER_CURRENCY=' . $orderCurrency . '">IOS</a>';
    $message .= 'PAYREFNO: <b>' . $backStatus['PAYREFNO'] . '</b><br/>';
    $message .= 'ORDER ID: <b>' . $backStatus['REFNOEXT'] . '</b><br/>';
    $message .= 'BACKREF DATE: <b>' . $backStatus['BACKREF_DATE'] . '</b><br/>';
    $backref->errorLogger();

    return $message.$links;
  }
}
