<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PayPing\Payment;
use PayPing\PayPingException;

class PaymentController extends Controller
{

    public function payping(Request $request)
    {
        $data = $request->all();

        $token = config('services.payping.token');
        $resNumber = Str::random();
        $args = [
            "amount" => 1000,
            "payerName" => auth()->user()->name,
            "returnUrl" => route('paypingCallback'),
            "clientRefId" => $resNumber
        ];

        $payment = new Payment($token);

        try {
            $payment->pay($args);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }

        $order = Order::findOrFail($data['order_id']);
        $order->payments()->create(array_merge($data,['resNumber'=>$resNumber]));
        return redirect($payment->getPayUrl());
    }

    public function paypingCallback()
    {
        $db_payment = \App\Models\Payment::where('resNumber',request()->clientrefid)->firstOrFail();
        $token = config('services.payping.token');

        $payment = new \PayPing\Payment($token);

        try {
            if($payment->verify(request('refid'), 1000)){
                $db_payment->update([
                    'status'=>1
                ]);
                $db_payment->order()->update([
                    'status'=>'paid'
                ]);
                alert()->success('پرداخت با موفقیت انجام شد.');
                return redirect(route('profile').'/4');
            }else{
                alert()->error('پرداخت موفقیت آمیز نبود.');
                return redirect(route('profile').'/4');
            }
        }
        catch (PayPingException $e) {
            $errors = collect(json_decode($e->getMessage(), true));
            alert()->error($errors->first());
            return redirect(route('profile').'/4');
        }
    }
}
