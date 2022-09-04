<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:مشاهده کاربران')->only('index');
        $this->middleware('can:ایجاد کاربر')->only(['create','store']);
        $this->middleware('can:ویرایش کاربر')->only(['edit','update']);
        $this->middleware('can:حذف کاربر')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //seo
        $this->seo()->setTitle('بخش کاربران');

        $users = User::query();
        if ($keyword = request('search'))
            $users->where('name','LIKE',"%{$keyword}%")->orWhere('email','LIKE',"%{$keyword}%")->orWhere('id',"{$keyword}");

        $users = $users->orderBy('id','DESC')->paginate(20);
        return view('admin.users.all',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //seo
        $this->seo()->setTitle('ایجاد کاربر جدید');
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
        $validData = $request->validated();
        $validData = $this->change_staff($validData);
        $validData['password'] = bcrypt($validData['password']);
        //create user
        User::create($validData);
        alert()->success('کاربر با موفقیت ایجاد شد.');
        return redirect(route('admin.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //seo
        $this->seo()->setTitle('ویرایش کاربر');
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $updateRequest
     * @param User $user
     * @return Response
     */
    public function update(UserUpdateRequest $updateRequest, User $user)
    {

        $validData = $updateRequest->validated();
        $validData = $this->change_staff($validData);
        if (request()->password){
            $validPassword = request()->validate([
                'password'=>'required|max:255|confirmed',
                'password_confirmation'=>'required'
            ]);
            $validPassword['password'] = bcrypt($validPassword['password']);
            $validData = collect($validData)->merge(collect($validPassword))->toArray();
        }

        $user->update($validData);
        alert()->success('کاربر با موفقیت ویرایش شد.');
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('کاربر با موفقیت حذف شد.');
        return redirect(route('admin.users.index'));
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function userInfo(User $user){
        //seo
        $this->seo()->setTitle('اطلاعات کاربر');
        return view('admin.users.info',compact('user'));
    }

    /**
     * @param array $validData
     * @return array
     */
    protected function change_staff(array $validData)
    {
        request()->is_superuser ? $validData['is_superuser'] = 1 : $validData['is_superuser'] = 0;
        request()->is_staff ? $validData['is_staff'] = 1 : $validData['is_staff'] = 0;
        return $validData;
    }
}
