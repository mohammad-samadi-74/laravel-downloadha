@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="bg-white shadow-sm rounded  breadcrumb px-4 py-2 rtl">
                        {{ $breadCrumb }}
                    </ol>
                </div>
            </div><!-- /.row -->
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{ $slot }}
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('script')
    {{$script ?? ''}}
@endsection
