<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Shirazsoft\Gateway\Gateway;
use Shirazsoft\Gateway\Irankish\IrankishException;
use Shirazsoft\Gateway\Payir\PayirSendException;
use Shirazsoft\Gateway\Saderat\SaderatException;
use Shirazsoft\Gateway\Sadad\SadadException;
use Shirazsoft\Gateway\Mellat\MellatException;
use Shirazsoft\Gateway\Saman\SamanException;
use Shirazsoft\Gateway\Zarinpal\ZarinpalException;
use Shirazsoft\Gateway\Pasargad\PasargadErrorException;
use Shirazsoft\Gateway\Parsian\ParsianErrorException;
use Shirazsoft\Gateway\Paypal\PaypalException;
use Shirazsoft\Gateway\Payir\PayirReceiveException;
use Shirazsoft\Gateway\JahanPay\JahanPayException;
use Shirazsoft\Gateway\Exceptions\RetryException;
use Shirazsoft\Gateway\Exceptions\PortNotFoundException;
use Shirazsoft\Gateway\Exceptions\InvalidRequestException;
use Shirazsoft\Gateway\Exceptions\NotFoundTransactionException;

class PaymentController extends Controller
{
    public function user()
    {

    }

    public function userCallback(Request $request)
    {

    }

    public function index(Request $request)
    {
        $gateway = \App\Gateway::find($request->gateway_id);
        if($gateway) {
            echo "Good Gateway";
            $string = $gateway->id .",". $gateway->payment_password .",". $request->amount .",". $request->gateway_order_id ."," . $request->gateway_callback;
            if(password_verify($string, $request->hash)) {

                $transaction = Transaction::ofGateway($gateway->id)->where('gateway_order_id', $request->gateway_order_id);
                if($transaction->first()) {
                    return view('payment.index',['code'=> '3', 'message' => 'تراکنش پیشتر پرداخت شده است.','gateway_callback' => $request->gateway_callback]);
                } else {
                    try {
                        $request_gateway = $gateway->gateway;
                        $bank_gateway = Gateway::{$request_gateway}();
                        $bank_gateway->setCallback(url('payment/callback'));
                        $bank_gateway->price($request->amount)->ready();

                        $refId =  $bank_gateway->refId();
                        $transID = $bank_gateway->transactionId();

                        session(['gateway' => $request_gateway]);
                        session(['gateway_id' => $gateway->id]);
                        session(['email' => $request->amount]);
                        session(['amount' => $request->gateway_order_id]);
                        session(['gateway_callback' => $request->gateway_callback]);

                        return $bank_gateway->redirect();
                    } catch (Exception $e) {
                        flash($e->getMessage())->error();
                    }catch (IrankishException $e) {
                        flash($e->getMessage())->error();
                    } catch (SaderatException $e) {
                        flash($e->getMessage())->error();
                    } catch (PayirSendException $e) {
                        flash($e->getMessage())->error();
                    } catch (SadadException $e) {
                        flash($e->getMessage())->error();
                    } catch (MellatException $e) {
                        flash($e->getMessage())->error();
                    } catch (SamanException $e) {
                        flash($e->getMessage())->error();
                    } catch (ZarinpalException $e) {
                        flash($e->getMessage())->error();
                    } catch (PasargadErrorException $e) {
                        flash($e->getMessage())->error();
                    } catch (ParsianErrorException $e) {
                        flash($e->getMessage())->error();
                    } catch (PaypalException $e) {
                        flash($e->getMessage())->error();
                    } catch (JahanPayException $e) {
                        flash($e->getMessage())->error();
                    }

                }

            } else {
                return view('payment.index',['code'=> '2', 'message' => 'رمز وارد شده اشتباه است.','gateway_callback' => $request->gateway_callback]);
            }
        } else {
            return view('payment.index',['code'=> '1', 'message' => 'چنین درگاهی وجود ندارد.','gateway_callback' => $request->gateway_callback]);
        }
    }

    public function callback(Request $request)
    {
        try {

            $gateway = \App\Gateway::find(session('gateway_id'));

            $bank_gateway = \Gateway::verify();
            $trackingCode = $bank_gateway->trackingCode();
            $transaction = new Transaction();
            $transaction->account_id = config('gateway.'.session('gateway').'.account_id');
            $transaction->gateway = session('gateway');
            $transaction->user_id = $gateway->user_id;
            $transaction->amount = session('amount');
            $transaction->category_id = config('platform.payment-category-id');
            $transaction->transaction_at = date("Y-m-d H:i:s");
            $transaction->save();

            flash('پرداخت با موفقیت انجام شد.')->success();
            return view('payment.callback',['trackingCode'=>$trackingCode,'transaction_id'=>$transaction->id,'code'=>'0','message'=>'پرداخت با موفقیت انجام شد.']);
        } catch (Exception $e) {
            flash($e->getMessage())->error();
        } catch (IrankishException $e) {
            flash($e->getMessage())->error();
        } catch (SaderatException $e) {
            flash($e->getMessage())->error();
        } catch (PayirReceiveException $e) {
            flash($e->getMessage())->error();
        } catch (SadadException $e) {
            flash($e->getMessage())->error();
        } catch (MellatException $e) {
            flash($e->getMessage())->error();
        } catch (SamanException $e) {
            flash($e->getMessage())->error();
        } catch (ZarinpalException $e) {
            flash($e->getMessage())->error();
        } catch (PasargadErrorException $e) {
            flash($e->getMessage())->error();
        } catch (ParsianErrorException $e) {
            flash($e->getMessage())->error();
        } catch (PaypalException $e) {
            flash($e->getMessage())->error();
        } catch (JahanPayException $e) {
            flash($e->getMessage())->error();
        }catch (RetryException $e) {
            flash($e->getMessage())->error();
        } catch (PortNotFoundException $e) {
            flash($e->getMessage())->error();
        } catch (InvalidRequestException $e) {
            flash($e->getMessage())->error();
        } catch (NotFoundTransactionException $e) {
            flash($e->getMessage())->error();
        }
        return redirect()->route('free-pay');
    }
}
