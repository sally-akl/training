<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Validator;
use URL;
use Session;
use Redirect;
use Auth;

class PayPalController extends Controller
{
    private $_api_context;

    public function __construct()
    {

        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function postPaymentWithpaypal(Request $request)
    {
      if(Auth::user())
      {
        $id = $request->pac;
        $type = $request->pay_type;
        $package = \App\Package::find($id);
        $exist_trans = \App\Transactions::where("user_id",Auth::user()->id)
                                   ->where("trainer_id",$package->user->id)
                                   ->where("package_id",$id)
                                   ->where("transfer_payment_type",$type)
                                   ->first();

        if($package !== null)
        {
          if(isset($exist_trans->transfer_date))
          {
            $expire_date = date('Y-m-d', strtotime(date('Y-m-d',strtotime($exist_trans->transfer_date)). ' + '.$package->package_duration.' weeks'));
            if(date('Y-m-d',strtotime($exist_trans->transfer_date)) <= $expire_date)
            {
              return redirect()->back()->withErrors(array("errors"=>array("exist"=>"You already Subscribe to this package")));
            }
          }
          else{
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            Session::put('package_name', $package->package_name);
            Session::put('package_id', $package->id);

            $item_1 = new Item();
            $item_1->setName($package->package_name) /** item name **/
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($package->package_price); /** unit price **/

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($package->package_price);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription($package->package_desc);

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('paypal.status')) /** Specify return URL **/
                ->setCancelUrl(URL::route('paypal.status'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
                /** dd($payment->create($this->_api_context));exit; **/
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error','Connection timeout');
                    return redirect()->back()->withErrors(array("errors"=>array("exist"=>"Connection timeout")));
                    /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                    /** $err_data = json_decode($ex->getData(), true); **/
                    /** exit; **/
                } else {
                    \Session::put('error','Some error occur, sorry for inconvenient');
                    return redirect()->back()->withErrors(array("errors"=>array("exist"=>"Some error occur, sorry for inconvenient")));
                    /** die('Some error occur, sorry for inconvenient'); **/
                }
            }

            foreach($payment->getLinks() as $link) {
                if($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }

            /** add payment ID to session **/
            Session::put('paypal_payment_id', $payment->getId());

            if(isset($redirect_url)) {
                /** redirect to paypal **/
                return Redirect::away($redirect_url);
            }

            \Session::put('error','Unknown error occurred');
            return redirect()->back()->withErrors(array("errors"=>array("exist"=>"Unknown error occurred")));
          }
        }
        else{
            return redirect()->back()->withErrors(array("errors"=>array("exist"=>"Wrong package")));
        }

      }
      return redirect('auth-customer');
    }

    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $pakage_name = Session::get('package_name');
        $package_id = Session::get('package_id');


        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->PayerID) || empty($request->token)) {
            \Session::put('error','Payment failed');
            return redirect("/checkout/".$pakage_name."/".$package_id)->withErrors(array("errors"=>array("exist"=>"Payment failed")));
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {

            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/

          Session::forget('package_name');
          Session::forget('package_id');
          \Session::put('success','Payment success');

          $transaction = new \App\Transactions();
          $transaction->transaction_num = $this->getCode(10);
          $transaction->user_id = Auth::user()->id;
          $transaction->trainer_id  = \App\Package::find($package_id)->user->id;
          $transaction->package_id   =\App\Package::find($package_id)->id;
          $transaction->transfer_date = date("Y-m-d");
          $transaction->is_payable = 1;
          $transaction->transfer_payment_type = "paypal";
          $transaction->paymentToken = $request->PayerID;
          $transaction->paymentId = $payment_id;
          $transaction->amount = \App\Package::find($package_id)->package_price;
          $transaction->save();

          return redirect('my-subscription');
        }
        \Session::put('error','Payment failed');
        Session::forget('package_name');
        Session::forget('package_id');

		  return redirect("/checkout/".$pakage_name."/".$package_id)->withErrors(array("errors"=>array("exist"=>"Payment failed")));
    }
    private  function getCode($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
