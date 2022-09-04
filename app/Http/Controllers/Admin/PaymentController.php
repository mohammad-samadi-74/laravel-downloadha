<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:مشاهده پرداخت ها');
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه پرداخت ها');
        $payments = Payment::orderBy('id','DESC')->paginate(20);
        return view('admin.payments.all',compact('payments'));
    }

}
