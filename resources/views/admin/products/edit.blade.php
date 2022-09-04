@component('admin.layouts.content',['title'=>'ویرایش محصول '])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده محصولات')
            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">صفحه محصول ها</a></li>
        @endcan
        @can('ایجاد محصول')
            <li class="breadcrumb-item"><a href="{{route('admin.products.create')}}">صفحه ایجاد محصول جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ویرایش محصول</li>
    @endslot

    @slot('script')
        <script>
            $('#categories').select2({placeholder: 'دسته بندی ها را انتخاب کنید.'})

            $('textarea').focus(function () {
                let id = $(this).attr('id')
                CKEDITOR.replace(id)
            })

            $('#categories').select2({placeholder: 'دسته بندی ها را انتخاب کنید.'});

            $('textarea').focus(function () {
                let id = $(this).attr('id');
                CKEDITOR.replace(id);
            });

            $('#add_product_attribute').click(function () {

                let attribute_section = $('#attribute_section');
                let id = attribute_section.children().length;
                let attributes = $('.attributes').data('attributes');

                attribute_section.append(
                    createNewAttr({
                        attributes,
                        values: [],
                        id
                    })
                );

                $('.attribute-select').select2({tags: true});

            })

            let createNewAttr = ({attributes, values, id}) => {
                return `
                        <div class="row" id="attribute-${id}">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="">عنوان ویژگی</label>
                                    <select name="attributes[${id}][name]" class="attribute-select form-control" onchange="changeAttributeValues(event,${id})">
                                        <option value="">انتخاب کنید</option>
                                        ${
                    attributes.map(function(item){
                        return `<option value="${item}">${item}</option>`
                    })
                }
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="">مقدار ویژگی</label>
                                    <select name="attributes[${id}][value]" class="attribute-select form-control">
                                        <option value="">انتخاب کنید</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">اقدامات</label>
                                    <div>
                                        <button class="btn btn-sm btn-warning " type="button" onclick="document.getElementById('attribute-${id}').remove()">
                                            حذف ویژگی
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                `
            }

            let changeAttributeValues = (event , id) => {
                let valueBox = $(`select[name='attributes[${id}][value]']`);

                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type' : 'application/json'
                    }
                })

                $.ajax({
                    type : 'POST',
                    url : "/admin/attribute/values",
                    data : JSON.stringify({
                        name : event.target.value
                    }),
                    success : function(res) {
                        if (res.status === 'success'){
                            valueBox.html(`
                                <option selected value="">انتخاب کنید</option>
                                ${
                                res.attributes.map(function (item) {
                                    return `<option value="${item}">${item}</option>`
                                })
                            }
                            `);

                            $('.attribute-select').select2({ tags : true });
                        }
                    }
                });
            }

            $('.attribute-select').select2({tags: true});
        </script>
    @endslot


    <div class="card" id="admin-products">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ایجاد محصول جدید</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body px-4">
            <div class="attributes" data-attributes="{{json_encode(\App\Models\Attribute::all()->pluck('name'))}}"></div>
            <form action="{{route('admin.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                @endforeach
            @endif
            <!-- errors -->

                <!-- name filed -->
                <div class="form-group">
                    <label for="name">عنوان محصول</label>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder="نام محصول را وارد کنید." value="{{old('name',$product->name)}}">
                </div>
                <!-- name filed -->

                <!-- description fields -->
                <div class="form-group mb-4">
                    <label for="description">توضیحات محصول</label>
                    <textarea class="form-control" name="description" id="description" placeholder="توضیحات محصول را وارد کنید.">{{old('description',$product->description)}}</textarea>
                </div>
                <!-- description fields -->

                <!-- price filed -->
                <div class="form-group">
                    <label for="price">قیمت محصول</label>
                    <input type="text" class="form-control" name="price" id="price"
                           placeholder="قیمت محصول را وارد کنید." value="{{old('price',$product->price)}}">
                </div>
                <!-- price filed -->

                <!-- inventory filed -->
                <div class="form-group">
                    <label for="inventory">موجودی محصول</label>
                    <input type="text" class="form-control" name="inventory" id="inventory"
                           placeholder="موجودی محصول را وارد کنید." value="{{old('inventory',$product->inventory)}}">
                </div>
                <!-- inventory filed -->

                <!-- wallpaper filed -->
                <div class="form-group">
                    <label for="wallpaper">تصویر محصول</label>
                    @if($product->wallpaper && file_exists(public_path($product->wallpaper)))
                        <div class="row ">
                            <div class="col-2 my-1 bg-light shadow-md p-2 mx-2">
                                <img src="/{{$product->wallpaper}}" class="img-fluid" alt="تصویر">
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control" name="wallpaper" id="wallpaper" placeholder="تصویر محصول را انتخاب کنید." value="{{old('wallpaper',$product->wallpaper)}}">
                </div>
                <!-- wallpaper filed -->

                <!-- gallery filed -->
                <div class="form-group">
                    <label for="images">گالری تصاویر محصول</label>
                    @if($images = $product->images)
                        <div class="row bg-light shadow-sm">
                            @foreach($images as $image)
                                @if(file_exists(public_path($image->image)))
                                    <div class="col-2 p-2">
                                        <img src="/{{$image->image}}" class="img-fluid" alt="تصویر">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <input type="file" class="form-control" name="images[]" id="images"
                           placeholder="تصاویر محصول را انتخاب کنید." value="{{old('wallpaper')}}" multiple>
                </div>
                <!-- gallery filed -->

                <!-- categories filed -->
                <div class="form-group">
                    <label for="categories">دسته بندی ها</label>
                    <select class="form-control" name="categories[]" id="categories" multiple>
                        @foreach(\App\Models\Category::where('parent_id','>','0')->get() as  $cat)
                            <option
                                value="{{$cat->id}}" {{in_array($cat->id,$product->categories()->pluck('id')->toArray()) ? 'selected' : ''}}>{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- categories filed -->

                <!-- attributes -->
                <h6>ویژگی های محصول</h6>
                <hr>
                <div id="attribute_section">
                    @foreach($product->attributes as $attribute)
                        <div class="row" id="attribute-{{$loop->index}}">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="">عنوان ویژگی</label>
                                    <select name="attributes[{{$loop->index}}][name]" class="attribute-select form-control" onchange="changeAttributeValues(event,{{$loop->index}})">
                                        <option value="">انتخاب کنید</option>
                                        @foreach(\App\Models\Attribute::all() as $attr)
                                            <option value="{{$attr->name}}" {{$attr->name == $attribute->name ? 'selected' : '' }}>{{$attr->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="">مقدار ویژگی</label>
                                    <select name="attributes[{{$loop->index}}][value]" class="attribute-select form-control">
                                        @foreach($attribute->values as $value)
                                            <option value="{{$value->value}}" {{$value->id == $attribute->pivot->value_id ? 'selected' : '' }}>{{$value->value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">اقدامات</label>
                                    <div>
                                        <button class="btn btn-sm btn-warning " type="button" onclick="document.getElementById('attribute-{{$loop->index}}').remove()">
                                            حذف ویژگی
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-sm btn-danger mt-2 mb-4" type="button" id="add_product_attribute">ویژگی جدید
                </button>
                <!-- attributes -->

                <!-- tags filed -->
                <div class="form-group">
                    <label for="tags">تگ های محصول</label>
                    <input type="text" class="form-control" name="tags" id="tags"
                           placeholder="تگ های محصول را وارد کنید.تگ هارا با ویرگول از هم جدا کنید." value="{{old('tags',$product->tags)}}">
                </div>
                <!-- tags filed -->

                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ویرایش محصول</button>
                    <a href="{{route('admin.products.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

