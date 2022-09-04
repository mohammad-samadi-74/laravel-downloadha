<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class AddressController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $url = back()->getTargetUrl();
        return view('profile.address.create',compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'state'=>'required|exists:cities,title',
            'city'=>'required|exists:cities,title',
            'address'=>'required|string',
            'phone'=>'required|regex:/^0[0-9]{2,}[0-9]{7,}$/',
            'cellphone_number'=>'required|regex:/(09)[0-9]{9}/',
            'old_url'=>'nullable'
        ]);

       if (DB::table('cities')->where('title',$data['city'])->where('parent','>',0)->get()[0]->parent != DB::table('cities')->where('title',$data['state'])->where('parent',0)->get()[0]->id)
           return redirect()->back()->withErrors(['state'=>'اطلاعات شهر و استان همخوانی ندارند.']);

       auth()->user()->addresses()->create($data);
       alert()->success('آدرس با موفقیت ثبت شد.');
       return redirect($data['old_url'] ? url($data['old_url']) : route('profile').'/3');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @return void
     */
    public function edit(Address $address)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return void
     */
    public function destroy(Address $address)
    {
        //
    }

    public function getCities(Request $request){

        $state = DB::table('cities')->where('title',$request['state'])->where('parent','0')->get();
        if (! $state){
            return \response(['status'=>'error']);
        }
        $cities = DB::table('cities')->where('parent',$state[0]->id)->get()->pluck('title');
        return \response(['status'=>'success','cities'=>$cities]);
    }
}
