<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:مشاهده دسترسی ها')->only('index');
        $this->middleware('can:ایجاد دسترسی')->only(['create', 'store']);
        $this->middleware('can:ویرایش دسترسی')->only(['edit', 'update']);
        $this->middleware('can:حذف دسترسی')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه دسترسی ها');
        $permissions = Permission::query();
        if ($keyword = request('search'))
            $permissions->where('name','LIKE',"%{$keyword}%")->orWhere('label','LIKE',"%{$keyword}%")->orWhere('id',"{$keyword}");

        $permissions = $permissions->orderBy('id','DESC')->paginate(20);
        return view('admin.permissions.all', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->seo()->setTitle('صفحه ایجاد دسترسی جدید');
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|string|min:3|unique:permissions',
            'label' => 'nullable|min:3'
        ]);

        Permission::create($validData);
        alert()->success('دسترسی با ویرایش ایجاد شد.');
        return redirect(route('admin.permissions.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return Response
     */
    public function edit(Permission $permission)
    {
        $this->seo()->setTitle('صفحه ویرایش دسترسی');
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Permission $permission
     * @return Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validData = $request->validate([
            'name' => ['required', 'string', 'min:3', Rule::unique('permissions')->ignore($permission->id)],
            'label' => 'nullable|min:3'
        ]);

        $permission->update($validData);
        alert()->success('دسترسی با ویرایش ایجاد شد.');
        return redirect(route('admin.permissions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        alert()->success('دسترسی با موفقیت حذف شد.');
        return redirect(route('admin.permissions.index'));
    }
}
