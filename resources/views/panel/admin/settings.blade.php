@extends('layouts.admin.panel')
@section('custom_css')
<link href="{{url('admin/css/lib/bootstrap-select/bootstrap-select.min.css?v=3')}}" rel="stylesheet" />
<style>
    .form-control:focus {
        color: #000000;
    }

    .form-control {
        color: #000000;
    }
</style>
@endsection
@section('page_title')
<div class="col-md-5 align-self-center">
    <h3 class="text-primary">تنظیمات</h3>
</div>
<div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
        <li class="breadcrumb-item active">تنظیمات</li>
    </ol>
</div>
@endsection

@section('content')
<form action="{{route('settings.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-body">
                                        <h3 class="box-title m-t-7">ثبت هزینه جدید</h3>
                                        <hr>
                                        {{App\Drivers\Enviroment::get('TRANSACTION')}}
                                        <div class="row p-t-20">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">نوع محاسبه تراکنش</label>
                                                    <select name="type" id="period" class="form-control">
                                                        <option value="0"
                                                            {{env('TRANSACTION')=="last_record"?'selected':''}}>
                                                            تراکنش
                                                            قبلی
                                                        </option>
                                                        <option value="1"
                                                            {{env('TRANSACTION')=="profile"?'selected':''}}>پروفایل
                                                            مددجو</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions text-left" style="margin-top:80px">
                                            <button type="submit" class="btn btn-success">
                                                ذخیره<i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection