<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:مشاهده سفارش ها')->only(['index','info']);
        $this->middleware('can:ویرایش سفارش')->only(['edit', 'update']);
        $this->middleware('can:حذف سفارش')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه سفارش ها');
        $orders = Order::query();
        if ($keyword = request('search'))
            $orders->where('status','LIKE',"%{$keyword}%")->orWhere('tracking_serial','LIKE',"%{$keyword}%")->orWhere('id',"{$keyword}");
        if ($keyword = request('type')){
            $orders->orWhere('status','=',"{$keyword}");
        }

        $orders = $orders->orderBy('id','DESC')->paginate(20);
        return view('admin.orders.all',compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        $this->seo()->setTitle('صفحه ویرایش سفارش');
        return view('admin.orders.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        $validData = $request->validate([
           'status'=>'required',
           'tracking_serial'=>'nullable'
        ]);

        $order->update($validData);
        alert()->success('کاربر با موفقیت ویرایش شد.');
        return redirect(route('admin.orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        alert()->success('سفارش با موفقیت حذف شد.');
        return redirect(route('admin.orders.index'));
    }

    /**
     * @param Order $order
     * @return Application|Factory|View
     */
    public function info(Order $order){
        $this->seo()->setTitle('صفحه جزییات سفارش');
        return view('admin.orders.info',compact('order'));
    }
}
