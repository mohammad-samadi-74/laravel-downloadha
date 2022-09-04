<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @param Request $request
     * @return void
     */
    public function edit(Address $address,Request $request)
    {
        $user_id = User::findOrFail($request['user_id'])->id;
        return view('admin.users.editAddress',compact(['address','user_id']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Address $address
     * @return void
     */
    public function update(Request $request, Address $address)
    {

        $data = $request->validate([
            'user_id'=>'required',
            'state'=>'required|exists:cities,title',
            'city'=>'required|exists:cities,title',
            'address'=>'required|string',
            'phone'=>'required|regex:/^0[0-9]{2,}[0-9]{7,}$/',
            'cellphone_number'=>'required|regex:/(09)[0-9]{9}/',
        ]);

        $user = User::findOrFail($data['user_id']);

        if (DB::table('cities')->where('title',$data['city'])->where('parent','>',0)->get()[0]->parent != DB::table('cities')->where('title',$data['state'])->where('parent',0)->get()[0]->id)
            return redirect()->back()->withErrors(['state'=>'اطلاعات شهر و استان همخوانی ندارند.']);

        $address->update($data);
        alert()->success('آدرس با موفقیت ویرایش شد.');
        return redirect(route('admin.users.info',$user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return Response
     */
    public function destroy(Address $address)
    {
        if ($address->payments()->count()){
            alert()->warning(" لطفا ابتدا پرداخت های مربوطه را ویرایش کنید.","امکان حذف ادرس وجود ندارد");
            return redirect()->back();
        }else{
            $address->delete();
            alert()->success("آدرس با موفقیت حذف شد.");
            return redirect()->back();
        }
    }
}
