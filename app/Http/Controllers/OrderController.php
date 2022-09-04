<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Providers\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function create()
    {
        if (!Cart::all()->count()) {
            return redirect()->back();
        }

        $price = Cart::all()->sum(function ($item) {
            return $item['product']->price * $item['quantity'];
        });

        $order = auth()->user()->orders()->create(['price' => $price]);

        $products = Cart::all()->mapWithKeys(function ($item) {
            return [$item['product']->id => ['quantity' => $item['quantity']]];
        });

        $order->products()->attach($products);

        Cart::empty();
        alert()->success('سفارش شما با موفقیت ثبت شد.');
        return redirect(route('orderDetails', $order->id));
    }

    public function orderDetails(Order $order)
    {
        //seo
        $this->seo()->setTitle('جزییات سفارش');
        return view('payments.orderDetails', compact(['order']));
    }

    public function editOrderDetails(Order $order){
        //seo
        $this->seo()->setTitle('جزییات سفارش');
        return view('payments.editOrderDetails', compact('order'));
    }

    public function cancelOrder(Order $order)
    {
        $order->update(['status' => 'canceled']);
        $order->payments()->delete();
        alert()->success('سفارش با موفقیت کنسل شد.');
        return redirect(url("/profile/3"));
    }

    public function payment(Request $request,Order $order)
    {
        $data = $request->validate([
            'address_id' => 'required',
            'post_method' => ['required', Rule::in(['پست معمولی', 'پست پیشتاز'])],
            'post_date' => 'required|date',
            'payment_method' => ['required', Rule::in(['پرداخت در محل', 'پرداخت آنلاین'])],
            'payment' => ['required_unless:payment_method,پرداخت در محل', Rule::in(['payping', 'parsian'])],
        ]);

        if ($data['payment_method'] == 'پرداخت در محل'){

            if ($order->hasUnpaidPayment()){
                $order->payments()->where('payment_method','پرداخت در محل')->first()->delete();
            }

            $payment = $order->payments()->create(array_merge($data,[
                'status'=>'0',
                'resNumber'=>0
            ]));

            $order->update(['status','preparation']);
            alert()->success('پرداخت با موفقیت ثبت شد.');
            return redirect(route('profile').'/3');

        }else{
            if ($data['payment'] == 'payping'){
                return \redirect(route('payping',array_merge($data,['order_id'=>$order->id])));
            }else{
                \redirect(route('profile').'/3');
            }

        }
    }

}
