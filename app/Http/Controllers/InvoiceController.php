<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Item;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvoiceCreated;
use App\Transaction;

class InvoiceController extends Controller
{
    public function index()
    {
        $this->middleware(['auth']);
        $invoices = Invoice::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(config('platform.file-per-page'));
        return view('invoice.index',['invoices' => $invoices]);
    }

    public function pay(Request $request)
    {
        $this->middleware(['auth']);
        $request_gateway = $request->gateway;
        session(['gateway' => $request_gateway]);
        $invoice = Invoice::findOrFail($request->invoice_id);
        if($invoice->user_id != Auth::user()->id) {
            abort(404);
        } else {
            try {
                $gateway = Gateway::{$request_gateway}();
                $gateway->setCallback(url('invoice/callback', ['id'=>$request->invoice_id]));
                $gateway->price($invoice->total * 10)->ready();
                return $gateway->redirect();
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
            return redirect()->route('invoice.view',['id' => $request->invoice_id]);
        }
    }
    public function payPassword($password, Request $request)
    {
        $request_gateway = $request->gateway;
        session(['gateway' => $request_gateway]);
        $invoice = Invoice::findOrFail($request->invoice_id);
        if($invoice->password != $password) {
            abort(404);
        } else {
            try {
                $gateway = Gateway::{$request_gateway}();
                $gateway->setCallback(route('invoice.callback-password', [$invoice->id,$invoice->password]));
                $gateway->price($invoice->total * 10)->ready();
                return $gateway->redirect();
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
            return redirect()->route('invoice.view-password',[$invoice->id,$invoice->password]);
        }
    }
    public function payLink($id)
    {
        $this->middleware(['auth']);
        $invoice = Invoice::findOrFail($id);
        if($invoice->user_id != Auth::user()->id) {
            abort(404);
        } else {
            $request_gateway = config('platform.default-gateway');
            session(['gateway' => $request_gateway]);
            try {
                $gateway = Gateway::{$request_gateway}();
                $gateway->setCallback(url('invoice/callback', ['id'=>$id]));
                $gateway->price($invoice->total * 10)->ready();
                return $gateway->redirect();
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

            return redirect()->route('invoice.view',['id' => $id]);
        }
    }

    public function payLinkPassword($id, $password)
    {
        $invoice = Invoice::findOrFail($id);
        if($invoice->password != $password) {
            abort(404);
        } else {
            $request_gateway = config('platform.default-gateway');
            session(['gateway' => $request_gateway]);
            try {
                $gateway = Gateway::{$request_gateway}();
                $gateway->setCallback(url('invoice/callback', ['id'=>$id,'password'=>$password]));
                $gateway->price($invoice->total * 10)->ready();
                return $gateway->redirect();
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
            return redirect()->route('invoice.view-password',['id' => $id, 'password' => $password]);
        }
    }

    public function view($id)
    {
        $this->middleware(['auth']);
        $invoice = Invoice::with('records','user')->findOrFail($id);
        if($invoice->user_id != Auth::user()->id && Auth::user()->level != 'admin') {
            abort(404);
        } else {
            return view('invoice.view',['invoice' => $invoice]);
        }
    }

    public function viewPassword($id, $password)
    {
        $invoice = Invoice::with('records','user')->findOrFail($id);
        if($invoice->password != $password) {
            abort(404);
        } else {
            return view('invoice.view-password',['invoice' => $invoice]);
        }
    }

    public function callback(Request $request, $id)
    {
        $this->middleware(['auth']);
        $invoice = Invoice::with('records','user')->findOrFail($id);

        if($invoice->user_id != Auth::user()->id) {
            abort(404);
        } else {
            try {
                $gateway = \Gateway::verify();
                $trackingCode = $gateway->trackingCode();
                $transaction = new Transaction();
                $transaction->account_id = config('gateway.'.session('gateway').'.account_id');
                $transaction->name = Auth::user()->name;
                $transaction->email = Auth::user()->email;
                $transaction->mobile = Auth::user()->mobile;
                $transaction->user_id = Auth::user()->id;
                $transaction->category_id = 13;
                $transaction->invoice_id = $invoice->id;
                $transaction->description = "پرداخت فاکتور شماره:" . $invoice->id;
                $transaction->amount = $invoice->total;
                $transaction->transaction_at = date("Y-m-d H:i:s");
                $transaction->save();
                $invoice->paid_at = date("Y-m-d H:i:s");
                $invoice->status = 'paid';
                $invoice->save();

                foreach($invoice->records as $record) {
                    if($record->item_id) {
                        $item = Item::findOrFail($record->item_id);
                        if($item->factory) {
                            $factory = $item->factory;
                            $factory = new $factory();
                            $factory->create($item, $invoice->user);
                        }
                    }
                }

                $user = User::find($invoice->user_id);
                try {
                    Notification::send($user, new InvoiceCreated($invoice, $user));
                } catch (\Exception $e) {}
                flash('فاکتور با موفقیت پرداخت شد.')->success();
            }  catch (Exception $e) {
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
            return redirect()->route('invoice.view',['id' => $id]);
        }
    }

    public function callbackPassword(Request $request, $id, $password)
    {
        $invoice = Invoice::with('records','user')->findOrFail($id);
        $user = User::findOrFail($invoice->user_id);
        if($invoice->password != $password) {
            abort(404);
        } else {
            try {
                $gateway = \Gateway::verify();
                $trackingCode = $gateway->trackingCode();
                $transaction = new Transaction();
                $transaction->account_id = config('gateway.'.session('gateway').'.account_id');
                $transaction->name = $user->name;
                $transaction->email = $user->email;
                $transaction->mobile = $user->mobile;
                $transaction->user_id = $user->id;
                $transaction->category_id = 13;
                $transaction->invoice_id = $invoice->id;
                $transaction->description = "پرداخت فاکتور شماره:" . $invoice->id;
                $transaction->amount = $invoice->total;
                $transaction->transaction_at = date("Y-m-d H:i:s");
                $transaction->save();

                $invoice->paid_at = date("Y-m-d H:i:s");
                $invoice->status = 'paid';
                $invoice->save();

                foreach($invoice->records as $record) {
                    if($record->item_id) {
                        $item = Item::findOrFail($record->item_id);
                        if($item->factory) {
                            $factory = $item->factory;
                            $factory = new $factory();
                            $factory->create($item, $invoice->user);
                        }
                    }
                }

                $user = User::find($invoice->user_id);
                try {
                    Notification::send($user, new InvoiceCreated($invoice, $user));
                } catch (\Exception $e) {}
                flash('فاکتور با موفقیت پرداخت شد.')->success();
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
            return redirect()->route('invoice.view-password',[$id,$invoice->password]);
        }
    }
}
