@extends('layouts.admin.panel')


@section('custom_css')
<link rel="stylesheet" href="{{url('admin/css/lib/date-picker/bootstrap-datepicker.min.css')}}">

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
  <h3 class="text-primary"> تراکنش جدید</h3>
</div>
<div class="col-md-7 align-self-center">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
    <li class="breadcrumb-item active">تراکنش‌ها</li>
    <li class="breadcrumb-item active">تراکنش جدید </li>
  </ol>
</div>
@endsection



@section('content')
@if(session('success', false))
<div class="alert alert-info text-right">
  تراکنش با موفقیت ایجاد شد. می توانید لیست تراکنش‌ها را از <a href="{{route('admin.transactions.daily.list')}}">این لینک</a> مشاهده کنید.
</div>
@endif
<form action="{{route('admin.transactions.free.store')}}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-outline-primary">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-body">
                <h3 class="card-title m-t-15"> اطلاعات </h3>
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label class="control-label">کاربر </label>
                      <input autocomplete="off" type="text" id="query" name="query" value="{{old('query')}}"
                        placeholder="نام، نام خانوادگی، شماره تلفن یا کد کاربری"
                        class="form-control {{$errors->has('query')?'is-invalid':''}}">
                      @if($errors->has('query'))
                      <small class="form-control-feedback text-danger">{{$errors->first('query')}}</small>
                      @endif
                    </div>
                    <button type="button" onclick="fetch()" class="btn btn-primary">استعلام کاربر</button>
                    <script>
                      function fetch(){
                        const query = $('#query').val();
                        console.log(query);
                        $.ajax({
                          "async": true,
                          "crossDomain": true,
                          "url": "{{route('admin.users.get')}}",
                          "method": "POST",
                          "headers": {
                            "content-type": "application/json",
                            "accept": "application/json"
                          },
                          "processData": false,
                          "data": JSON.stringify({
                            phone: query, full_name: query, id: query, _token: '{{csrf_token()}}'
                          }),
                          success: function (data, text) {
                            const user = data;
                            $('#fetch_info').val(`کاربر ${user.full_name} استعلام شد.`)
                            $('#fetch_id').val(user.id);
                          },
                          error: function (request, status, error) {
                            $('#fetch_info').val(`کاربر مورد نظر موجود نیست`)
                            $('#fetch_id').val('');
                          }
                        })
                      }
                    </script>
                  </div>
                  <div class="col-md-7">
                    <label class="control-label">اطلاعات استعلامی کاربر </label>
                    <input autocomplete="off" type="text" id="fetch_info" name="fetch_info" disabled value="{{old('fetch_info')}}"
                      placeholder="هنوز استعلامی انجام نشده. لطفا روی دکمه استعلام کلیک کنید"
                      class="form-control {{$errors->has('query')?'is-invalid':''}}">
                    <input autocomplete="off" type="number" id="fetch_id" name="fetch_id" value="{{old('fetch_id')}}" hidden />
                    @if($errors->has('fetch_id'))
                    <small class="form-control-feedback text-danger">{{$errors->first('fetch_id')}}</small>
                    @endif
                  </div>
                </div>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">نوع تراکنش </label>
                      <select name="type" class="form-control ">
                        <option value="1" {{old('type', '') == 1? 'selected': ''}}>افزایش اعتبار</option>
                        <option value="-1" {{old('type', '') == -1? 'selected': ''}}>کاهش اعتبار</option>
                      </select>
                      @if($errors->has('type'))
                        <small class="form-control-feedback text-danger">{{$errors->first('type')}}</small>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">مبلغ مورد نظر(ریال) </label>
                      <input autocomplete="off" type="number" id="amount" name="amount" value="{{old('amount')}}"
                        class="form-control {{$errors->has('amount')?'is-invalid':''}}">
                      @if($errors->has('amount'))
                      <small class="form-control-feedback text-danger">{{$errors->first('amount')}}</small>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">شیوه اطلاع‌رسانی به کاربر </label>
                      <select name="message_type" class="form-control ">
                        <option value="2" {{old('message_type', '') == 2? 'selected': ''}}>نوتیفیکیشن</option>
                        <option value="1" {{old('message_type', '') == 1? 'selected': ''}}>نوتیفیکیشن و پیامک</option>
                        <option value="3" {{old('message_type', '') == 3? 'selected': ''}}>پیامک</option>
                      </select>
                      @if($errors->has('message_type'))
                        <small class="form-control-feedback text-danger">{{$errors->first('message_type')}}</small>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">توضیحات </label>
                      <input autocomplete="off" type="text" placeholder="توضیحاتی درباره دلیل این تراکنش. توضیحات وارد شده برای کاربر ارسال خواهد شد." id="description" name="description"
                        class="form-control {{$errors->has('description')?'is-invalid':''}}"
                        value="{{old('description')}}">
                      @if($errors->has('description'))
                      <small class="form-control-feedback text-danger">{{$errors->first('description')}}</small>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-actions text-right" style="margin-top:20px">
                  <button type="submit" class="btn btn-info"> ذخیره <i class="fa fa-check"></i> </button>
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


@section('custom_js')
<script src="{{url('admin/js/lib/date-picker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('admin/js/lib/date-picker/bootstrap-datepicker.fa.min.js')}}"></script>
<script>
  $(document).ready(function() {
      $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:"1300:1400"
      });
    });
</script>
@endsection