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
    <h3 class="text-primary"> افزودن هزینه</h3>
</div>
<div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
        <li class="breadcrumb-item active">مددجو</li>
        <li class="breadcrumb-item active">جدید </li>
    </ol>
</div>
@endsection

@section('content')
<form action="{{route('donees.store')}}" method="POST" enctype="multipart/form-data">
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
                                        <div class="row p-t-20">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">حامی</label>
                                                    <script>
                                                        $(document).ready(function(){
                              $("#donors").on("changed.bs.select",
                                function(e, clickedIndex, newValue, oldValue) {
                                  let id = this.value;
                                  var settings = {
                                    "async": true,
                                    "crossDomain": true,
                                    "url": "{{route('transactions.related_donees')}}?id="+id,
                                    "method": "GET",
                                    "headers": {
                                        "accept": "application/json",
                                        "content-type": "application/json"
                                    },
                                    "processData": false,
                                  }
                                  $.ajax(settings).done(function (response) {
                                    console.log(response)
                                    let content = ``;
                                      for(let i =0;i<response.length;i++){
                                        let donee = response[i]
                                        content+=`
                                          <option value="${donee.id}">${donee.full_name}</option>
                                        `
                                      }
                                    $('#donees_list').html(content)
                                  });
                                })
                              });
                                                    </script>
                                                    <select id="donors" class="selectpicker form-control"
                                                        data-style="simti_o" name="donors[]" data-live-search="true">
                                                        @foreach(App\Donor::has('donees')->Active()->get() as $donor)
                                                        <option value="{{$donor->id}}">{{$donor->full_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('donors'))
                                                    <small
                                                        class="form-control-feedback text-danger">{{$errors->first('donors')}}</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">مددجو</label>
                                                    <select id="donees_list" name="donees" class="form-control">
                                                        @if(App\Donor::Active()->count()>0)
                                                        @foreach(App\Donor::first()->donees as $donee)
                                                        <option value="{{$donee->id}}">{{$donee->full_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @if($errors->has('periods'))
                                                    <small
                                                        class="form-control-feedback text-danger">{{$errors->first('periods')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">دوره زمانی </label>
                                                    <select name="period" id="period" class="form-control">
                                                        @foreach(App\Period::orderBy('created_at','asc')->get() as
                                                        $period)
                                                        <option value="{{$period->id}}"
                                                            {{ in_array($period->id, old('periods', []))? 'selected': ''}}
                                                            onclick="test()">{{$period->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('periods'))
                                                    <small
                                                        class="form-control-feedback text-danger">{{$errors->first('periods')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions text-left" style="margin-top:80px">
                                            <button type="button" class="btn btn-success" onclick="fetch_info()"> ثبت <i
                                                    class="fa fa-check"></i> </button>
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
    let donor,donee,period,money,non_money,donation_type,transaction_calc_type;
      transaction_calc_type = "{{env('TRANSACTION')}}";
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

      function fetch_info(){
        open_modal();
        donor = Number($('.selectpicker').val());
        donee = Number($("#donees_list").val());
        period = Number($("#period").val());

        var settings = {
          "async": true,
          "crossDomain": true,
          "url": `{{route('transactions.fetch_info')}}?donor_id=${donor}&donee_id=${donee}`,
          "method": "GET",
          "headers": {
              "accept": "application/json",
              "content-type": "application/json"
          },
          "processData": false,
        }
        $.ajax(settings).done(function (response) {
          console.log(response)
          if(transaction_calc_type == "last_record"){
            $("#donee_name").html(response.donee.full_name)
            $("#bank_account").html(response.donee.bank_account_number)
            $("#bank_account_owner").html(response.donee.bank_account_owner)
            $("#money_amount").html(response.money_amount)
            money = response.money_amount
            $("#non_money_amount").html(response.non_money_detail=="null"?'-':response.non_money_detail)
            non_money = response.non_money_detail
            $("#donation_type").html(response.type==1?'نقدی':'غیر نقدی')
            donation_type = response.type
          }else{
            $("#donee_name").html(response.full_name)
            $("#bank_account").html(response.bank_account_number)
            $("#bank_account_owner").html(response.bank_account_owner)
            $("#money_amount").html(response.pivot.money_amount)
            money = response.pivot.money_amount
            $("#non_money_amount").html(response.pivot.non_money_detail=="null"?'-':response.pivot.non_money_detail)
            non_money = response.pivot.non_money_detail
            $("#donation_type").html(response.pivot.donation_type==1?'نقدی':'غیر نقدی')
            donation_type = response.pivot.donation_type
          }
        });
      }

      function save_transaction(){
        var settings = {
          "async": true,
          "crossDomain": true,
          "url": `{{route('transactions.store')}}?donor=${donor}&donee=${donee}&period=${period}&type=${donation_type}&money=${money}&non_money=${non_money}`,
          "method": "GET",
          "headers": {
              "accept": "application/json",
              "content-type": "application/json"
          },
          "processData": false,
        }
        $.ajax(settings).done(function (response) {
          console.log(response)
          if(response=="already existed!"){
            close_modal();
            toast_alert("تراکنشی برای این ممدجو و حامی در این دوره ثبت شده است!","true")
          }else{
            close_modal();
            toast_alert("هزینه با موفقیت ثبت شد.","false")
            setTimeout(function() { location.replace("{{route('transactions.index')}}") }, 2000);
          }
          //reset text infos
          $("#donee_name").html('')
          $("#bank_account").html('')
          $("#bank_account_owner").html('')
          $("#money_amount").html('')
          $("#non_money_amount").html('')
          $("#donation_type").html('')
        });
      }
</script>
<div class="simti_overlay"></div>
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
            <div class="form-group" i>
                <label class="control-label"> نوع کمک: </label>
                <span id="donation_type"></span>
            </div>
            <div class="form-group" i>
                <label class="control-label"> مبلغ (ریال): </label>
                <span id="money_amount"></span>
            </div>
            <div class="form-group">
                <label class="control-label">شرح کمک: </label>
                <span id="non_money_amount"></span>
            </div>
        </div>
    </div>
    <button class="btn btn-primary modal-submit" onclick="save_transaction()">تایید و ثبت</button>
    <button class="btn btn-primary modal-submit" onclick="close_modal()">بازگشت</button>
</div>

@endsection
