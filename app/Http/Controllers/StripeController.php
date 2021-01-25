<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;

class StripeController extends Controller
{

  public function payform($type , $id)
  {
     return view('paymentstripe',compact("id","type"));
  }
  public function postPaymentStripe(Request $request)
  {
      $validator = Validator::make($request->all(), [
      'card_no' => 'required',
      'ccExpiryMonth' => 'required',
      'ccExpiryYear' => 'required',
      'cvvNumber' => 'required',
      //'amount' => 'required',
      ]);
      if ($validator->fails())
        return redirect()->back()->withErrors($validator->errors())->withInput();

      $pakage_name = $request->pakage_name;
      $package_id = $request->package_id;
      $amount = $request->amount;
      $visa_master = $request->pay_type;

      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      \Stripe\Charge::create ([
             "amount" => $amount * 100,
             "currency" => 'USD',
             "source" => $request->stripeToken,
             "description" => "package name : ".$request->pakage_name
      ]);
      $transaction = new \App\Transactions();
      $transaction->transaction_num = $this->getCode(10);
      $transaction->user_id = Auth::user()->id;
      $transaction->trainer_id  =\App\Package::find($package_id)->user->id;
      $transaction->package_id   =\App\Package::find($package_id)->id;
      $transaction->transfer_date = date("Y-m-d");
      $transaction->is_payable = 1;
      $transaction->transfer_payment_type = $visa_master;
      $transaction->paymentToken = "none";
      $transaction->paymentId = "none";
      $transaction->amount =  \App\Package::find($package_id)->package_price;
      $transaction->save();
      return redirect('my-subscription');
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
