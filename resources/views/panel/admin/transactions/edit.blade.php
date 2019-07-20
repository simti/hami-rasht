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
      <h3 class="text-primary"> افزودن هزینه</h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">مددجو</li>
          <li class="breadcrumb-item active">جدید </li>
      </ol>
  </div>
@endsection

@section('content')
  <form action="{{route('transactions.update',$transaction->id)}}" method="POST" enctype="multipart/form-data" >
  @csrf
  @method('PATCH')
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-outline-primary">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-body">
                    <h3 class="box-title m-t-7">ویرایش هزینه </h3>
                    <hr>
                    <div class="row p-t-20">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">حامی</label>
                          <input type="text" disabled class="form-control" value="{{$transaction->donor->full_name}}">
                        </div>
                      </div> 
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">مددجو</label>
                          <input type="text" disabled class="form-control" value="{{$transaction->donee->full_name}}">
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">دوره زمانی </label>
                          <input type="text" disabled class="form-control" value="{{$transaction->period->title}}">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">نوع کمک </label>
                          <select name="type" id="type" class="form-control" onchange="disable_input()">
                            <option value="1" {{$transaction->type==1?'selected':''}}>نقدی</option>
                            <option value="2" {{$transaction->type==2?'selected':''}}>غیرنقدی</option>
                            <option value="3" {{$transaction->type==3?'selected':''}}>خدمات</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">هزینه نقدی </label>
                          <input id="support_amount" class="form-control" {{$transaction->type==1?'':'disabled'}} name="money_amount" type="number" value="{{$transaction->type==1?$transaction->money_amount:0}}" >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">کمک غیرنقدی </label>
                          <textarea id="support_description" class="form-control" {{$transaction->type>1?'':'disabled'}} name="non_money_detail" style="height:auto !important;">{{$transaction->type>1?$transaction->non_money_detail:''}}</textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">نوع خروجی</label>
                          <select name="output_type" class="form-control">
                              <option value="1" {{old('output_type', $transaction->output_type) == '1'? 'selected': ''}}>بانک</option>
                              <option value="2" {{old('output_type', $transaction->output_type) == '2'? 'selected': ''}}> درون سازمانی</option>
                          </select>
                          @if($errors->has('output_type'))
                            <small class="form-control-feedback text-danger">{{$errors->first('output_type')}}</small>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="form-actions text-left" style="">
                      <button type="submit" class="btn btn-success"> بروزرسانی اطلاعات <i class="fa fa-check"></i> </button>
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
@section('custom_js')
  <script src="{{url('admin/js/lib/bootstrap-select/bootstrap-select.min.js')}}"></script>    
@endsection
@section('custom_modal')
  <script>
      let donor,donee,period,money,non_money,donation_type;
      function open_modal(){
        $('.menu_title').val('')
        $('.simti_overlay').show();
        $('#new_simti_modal').show();
        $('body').addClass('stop-scrolling')
      }
      function close_modal(){
        $('.simti_overlay').hide();
        $('.simti_modal').hide();
        $('body').removeClass('stop-scrolling')
      }

      function disable_input(){
        if(Number($("#type").val())==1){
          $("#support_amount").removeAttr("disabled")
          $("#support_description").val('')
          $("#support_description").attr("disabled",true)
        }else{
          $("#support_amount").attr("disabled",true)
          $("#support_amount").val(0);
          $("#support_description").removeAttr("disabled")
        }
      }
  </script>
  <div  class="simti_overlay"></div>
  <div id="new_simti_modal" class="simti_modal visible">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">نام مددجو: </label>
              <span id="donee_name"></span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">اطلاعات بانکی: </label>
              <span id="bank_account"></span>
            </div>
            <div class="form-group">
                <label class="control-label">صاحب حساب : </label>
                <span id="bank_account_owner"></span>
              </div>
          </div>
        <div class="col-md-12">
            <div class="form-group" i >
                <label class="control-label" > نوع کمک:  </label>
                <span id="donation_type"></span>
              </div>
          <div class="form-group" i >
            <label class="control-label" > مبلغ (ریال): </label>
            <span id="money_amount"></span>
          </div>
          <div class="form-group">
            <label class="control-label" >شرح کمک: </label>
            <span id="non_money_amount"></span>
          </div>
        </div>
    </div>
    <button class="btn btn-primary modal-submit" onclick="save_transaction()">تایید و ثبت</button>
    <button class="btn btn-primary modal-submit" onclick="close_modal()">بازگشت</button>
  </div>

@endsection