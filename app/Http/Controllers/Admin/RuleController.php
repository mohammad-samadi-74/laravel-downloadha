<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule as VRule;

class RuleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:مشاهده مقام ها')->only('index');
        $this->middleware('can:ایجاد مقام')->only(['create','store']);
        $this->middleware('can:ویرایش مقام')->only(['edit','update']);
        $this->middleware('can:حذف مقام')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه مقام ها');
        $rules = Rule::query();
        if ($keyword = request('search'))
            $rules->where('name','LIKE',"%{$keyword}%")->orWhere('label','LIKE',"%{$keyword}%")->orWhere('id',"{$keyword}");

        $rules = $rules->orderBy('id','DESC')->paginate(20);
        return view('admin.rules.all',compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->seo()->setTitle('صفحه ایجاد مقام جدید');
        return view('admin.rules.create');
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
            'name'=>'required|string|min:3|unique:rules',
            'label'=>'nullable|min:3',
            'permissions.*'=>'nullable|exists:permissions,id'
        ]);

        $rule = Rule::create($validData);
        $rule->permissions()->sync($validData['permissions']);
        alert()->success('مقام با موفقیت ایجاد شد.');
        return redirect(route('admin.rules.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rule $rule
     * @return Response
     */
    public function edit(Rule $rule)
    {
        $this->seo()->setTitle('صفحه ویرایش مقام');
        return view('admin.rules.edit',compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Rule $rule
     * @return Response
     */
    public function update(Request $request, Rule $rule)
    {
        $validData = $request->validate([
            'name'=>['required','string','min:3',\Illuminate\Validation\Rule::unique('rules')->ignore($rule->id)],
            'label'=>'nullable|min:3',
            'permissions.*'=>'nullable|exists:permissions,id'
        ]);

        $rule->update($validData);
        $rule->permissions()->sync($validData['permissions'] ?? []);
        alert()->success('مقام مورد نظر ویرایش شد.');
        return redirect(route('admin.rules.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rule $rule
     * @return Response
     */
    public function destroy(Rule $rule)
    {
        $rule->delete();
        alert()->success('مقام با موفقیت حذف شد.');
        return redirect(route('admin.rules.index'));
    }

    public function info(Rule $rule)
    {
        return view('admin.rules.info',compact('rule'));
    }

    public function setRule(User $user){
        $this->seo()->setTitle('صفحه ویرایش مقام کاربر');
        return view('admin.users.editRule',compact('user'));
    }

    public function editRule(Request $request,User $user){

        $data = $request->validate([
            'rule'=>['nullable',VRule::in(Rule::all()->pluck('id')->toArray())],
            'permissions'=>['nullable','array'],
            'permissions.*'=>[VRule::in(Permission::all()->pluck('id')->toArray())],
        ]);

        $data['rule'] ? $user->rules()->sync($data['rule']) : $user->rules()->detach();
        isset($data['permissions']) ? $user->permissions()->sync($data['permissions']) : $user->permissions()->detach();

        alert()->success('دسترسی ها با موفقیت ویرایش شد.');
        return redirect(route('admin.users.info',$user->id));
    }
}
