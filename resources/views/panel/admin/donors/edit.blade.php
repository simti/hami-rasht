@extends('layouts.admin.panel')

@section('custom_css')
  <link rel="stylesheet" href="{{url('admin/css/lib/date-picker/bootstrap-datepicker.min.css')}}">
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
      <h3 class="text-primary"> ویرایش حامی</h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">حامی</li>
          <li class="breadcrumb-item active">جدید </li>
      </ol>
  </div>
@endsection

@section('content')
  <form action="{{route('donors.update',$donor->id)}}" method="POST" id="donor_form" enctype="multipart/form-data" >
  @csrf
  @method('PATCH')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-outline-primary">
        <div class="card-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="form-body">
                      <h3 class="card-title m-t-15">۱) اطلاعات شخصی</h3>
                      <hr>
                      <div class="row p-t-20">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">نام و نام خانوادگی    </label>
                                  <input autocomplete="off" type="text" id="full_name" name="full_name" value="{{old('full_name',$donor->full_name)}}" class="form-control {{$errors->has('full_name')?'is-invalid':''}}">
                                  @if($errors->has('full_name'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('full_name')}}</small>
                                  @endif
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">نام پدر   </label>
                                <input autocomplete="off" type="text" id="father_name" name="father_name" value="{{old('father_name',$donor->father_name)}}" class="form-control {{$errors->has('father_name')?'is-invalid':''}}">
                                @if($errors->has('father_name'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('father_name')}}</small>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">کدملی </label>
                              <input autocomplete="off" maxlength="10" type="text" id="national_id" name="national_id" value="{{old('national_id',$donor->national_id)}}" class="form-control {{$errors->has('national_id')?'is-invalid':''}}" onkeyup="onlyNumber(this)" >
                              @if($errors->has('national_id'))
                                <small class="form-control-feedback text-danger">{{$errors->first('national_id')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">شماره شناسنامه </label>
                              <input autocomplete="off" maxlength="10" type="text" id="birth_certificate_id" name="birth_certificate_id" value="{{old('birth_certificate_id',$donor->birth_certificate_id)}}" class="form-control {{$errors->has('birth_certificate_id')?'is-invalid':''}}" onkeyup="onlyNumber(this)" >
                              @if($errors->has('birth_certificate_id'))
                                <small class="form-control-feedback text-danger">{{$errors->first('birth_certificate_id')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">ملیت  </label>
                                  <input autocomplete="off" type="text" id="nationality" name="nationality" value="{{old('nationality',$donor->nationality)}}" class="form-control {{$errors->has('nationality')?'is-invalid':''}}">
                                  @if($errors->has('nationality'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('nationality')}}</small>
                                  @endif
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">شماره تلفن  </label>
                              <input autocomplete="off" maxlength="11" type="text" id="phone" name="phone" class="form-control {{$errors->has('phone')?'is-invalid':''}}" value="{{old('phone',$donor->phone)}}" onkeyup="onlyNumber(this)" >
                              @if($errors->has('phone'))
                                <small class="form-control-feedback text-danger">{{$errors->first('phone')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">شماره همراه </label>
                              <input autocomplete="off" type="text" id="mobile" name="mobile" class="form-control {{$errors->has('mobile')?'is-invalid':''}}" maxlength="11" value="{{old('mobile',$donor->mobile)}}" onkeyup="onlyNumber(this)">
                              @if($errors->has('mobile'))
                                <small class="form-control-feedback text-danger">{{$errors->first('mobile')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">استان </label>
                                  <input autocomplete="off" type="text" id="state" name="state" value="{{old('state',$donor->state)}}" class="form-control {{$errors->has('state')?'is-invalid':''}}">
                                  @if($errors->has('state'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('state')}}</small>
                                  @endif
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">شهر  </label>
                                  <input autocomplete="off" type="text" id="city" name="city" value="{{old('city',$donor->city)}}" class="form-control {{$errors->has('city')?'is-invalid':''}}">
                                  @if($errors->has('city'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('city')}}</small>
                                  @endif
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">دین  </label>
                                <input autocomplete="off" type="text" id="religion" name="religion" value="{{old('religion',$donor->religion)}}" class="form-control {{$errors->has('religion')?'is-invalid':''}}">
                                @if($errors->has('religion'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('religion')}}</small>
                                @endif
                            </div>
                        </div>
                          
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">میزان تحصیلات  </label>
                              <input autocomplete="off" type="text" id="education" name="education" value="{{old('education',$donor->education)}}" class="form-control {{$errors->has('education')?'is-invalid':''}}" >
                              @if($errors->has('education'))
                                <small class="form-control-feedback text-danger">{{$errors->first('education')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label">شغل </label>
                                <input autocomplete="off" type="text" id="job" name="job" value="{{old('job',$donor->job)}}" class="form-control {{$errors->has('job')?'is-invalid':''}}" >
                                @if($errors->has('job'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('job')}}</small>
                                @endif
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">آدرس</label>
                                <input autocomplete="off" type="text" id="address" name="address" class="form-control {{$errors->has('address')?'is-invalid':''}}" value="{{old('address',$donor->address)}}" >
                                @if($errors->has('address'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('address')}}</small>
                                @endif
                              </div>
                            </div>
                            <!--/span-->
                          <!--/span-->
                      </div>
                      <!--/row-->
                      <div class="row">
                        <div class="col-md-4">
                          {{--  has-success  --}}
                          <div class="form-group">
                            <label class="control-label">جنسیت</label>
                            <select name="gender" class="form-control">
                                <option value="1" {{old('gender',$donor->gender) == '1'? 'selected': ''}}>مرد</option>
                                <option value="2" {{old('gender',$donor->gender) == '2'? 'selected': ''}}>زن</option>
                            </select>
                            @if($errors->has('gender'))
                              <small class="form-control-feedback text-danger">{{$errors->first('gender')}}</small>
                            @endif
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                          {{--  has-success  --}}
                          <div class="form-group">
                            <label class="control-label">وضعیت تاهل</label>
                            <select name="marital_status" class="form-control">
                                <option value="1" {{old('marital_status',$donor->marital_status) == '1'? 'selected': ''}}>متاهل</option>
                                <option value="2" {{old('marital_status',$donor->marital_status) == '2'? 'selected': ''}}>مجرد</option>
                            </select>
                            @if($errors->has('marital_status'))
                              <small class="form-control-feedback text-danger">{{$errors->first('marital_status')}}</small>
                            @endif
                          </div>
                        </div>
                          <!--/span-->
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">تاریخ  تولد </label>
                            <input autocomplete="off" type="text" autocomplete="off" id="birth_date" value="{{old('birth_date',App\Drivers\Time::jdate('Y-m-d', $timestamp = $donor->birth_date, $none = '', $time_zone = 'Asia/Tehran', $tr_num = 'en'))}}"  name="birth_date" class="form-control datepicker" >
                            @if($errors->has('birth_date'))
                              <small class="form-control-feedback text-danger">{{$errors->first('birth_date')}}</small>
                            @endif
                          </div>
                        </div>
                        <!--/span-->
                      </div>
                      
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-outline-primary">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-body">
                    <h3 class="box-title m-t-7">2) اطلاعات پرونده</h3>
                    <hr>
                    <div class="row p-t-20">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">تاریخ شروع همکاری </label>
                          <input autocomplete="off" type="text" autocomplete="off" id="cooperation_start_date" value="{{old('cooperation_start_date',App\Drivers\Time::jdate('Y-m-d', $timestamp = $donor->cooperation_start_date, $none = '', $time_zone = 'Asia/Tehran', $tr_num = 'en'))}}"  name="cooperation_start_date" class="form-control datepicker" >
                          @if($errors->has('cooperation_start_date'))
                            <small class="form-control-feedback text-danger">{{$errors->first('cooperation_start_date')}}</small>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label"> مدت همکاری مدنظر</label>
                          <input autocomplete="off" type="number" id="duration_of_support" name="duration_of_support" value="{{old('duration_of_support',$donor->duration_of_support)}}" class="form-control" step="0.5">
                          @if($errors->has('duration_of_support'))
                            <small class="form-control-feedback text-danger">{{$errors->first('duration_of_support')}}</small>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label><br>
                          <button type="button" class="btn btn-primary" onclick="open_modal()">افزودن مددجو</button>
                        </div>
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>مددجو</th>
                                            <th>کمک نقدی</th>
                                            <th>کمک غیرنقدی</th>
                                            <th class="text-center">حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody id="donees-content">
                                        @foreach ($donor->donees as $index=>$donee)
                                          <tr id="donees-content">
                                            <td data-title="مددجو">{{$donee->full_name}}</td>
                                            <td data-title="کمک نقدی">{{$donee->pivot->money_amount}}</td>
                                            <td data-title="کمک غیرنقدی">{{$donee->pivot->non_money_detail=='null'||$donee->pivot->non_money_detail==''?'-':$donee->pivot->non_money_detail}}</td>
                                            <td class="text-center" style="cursor:pointer;color: #5c4ac7;    font-size: larger;"  onclick="remove_donee({{$index}})"><i class="fa fa-trash" aria-hidden="true"></i></td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    <div class="form-actions text-left" style="margin-top:80px">
                      <a class="btn btn-warning" href="{{route('donors.index')}}">بازگشت</a> 
                      <button type="button" class="btn btn-success" onclick="submit_form()">بروزرسانی اطلاعات<i class="fa fa-check"></i> </button>
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

  <script src="{{url('admin/js/lib/date-picker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{url('admin/js/lib/date-picker/bootstrap-datepicker.fa.min.js')}}"></script>
  <script src="{{url('admin/js/lib/bootstrap-select/bootstrap-select.min.js')}}"></script>
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

@section('custom_modal')
  <script>

      var all_donees = @json($all_donees);
      let donees_belongs_to_donor = @json($donor->donees);
      let donees = [];
      for(let i=0;i<donees_belongs_to_donor.length;i++){
        let obj = {}
        obj.id = donees_belongs_to_donor[i].id;
        obj.name = donees_belongs_to_donor[i].full_name;
        obj.type = donees_belongs_to_donor[i].pivot.donation_type;
        obj.money = donees_belongs_to_donor[i].pivot.money_amount;
        obj.non_money = donees_belongs_to_donor[i].pivot.non_money_detail;
        donees[i] = obj
      }
  </script>
  <script>
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
        if(Number($("#support_type").val())==1){
          $("#support_amount").removeAttr("disabled")
          $("#support_description").val('')
          $("#support_description").attr("disabled",true)
        }else{
          $("#support_amount").attr("disabled",true)
          $("#support_amount").val(0);
          $("#support_description").removeAttr("disabled")
        }
      }
      function remove_donee(index){
        donees.splice(index,1)
        //update table
        let content = '';
        for(let i =0;i<donees.length;i++){
          content+=`
            <tr id="donees-content">
              <td data-title="مددجو">${donees[i].name}</td>
              <td data-title="کمک نقدی">${donees[i].money}</td>
              <td data-title="کمک غیرنقدی">${donees[i].non_money==null||donees[i].non_money==''?'-': donees[i].non_money}</td>
              <td style="cursor:pointer;color: #5c4ac7;    font-size: larger;" class="text-center"  onclick="remove_donee(${i})"><i class="fa fa-trash" aria-hidden="true"></i></td>
            </tr>
          `
        }
        $("#donees-content").html(content)
      }

      //modal close on outside
      $(document).ready(function() {
        $('.simti_overlay').click(function(){
          close_modal()
        })
      })
      //store donees

      function add_donee(){
        let donee = {};
        //get selected full_name
        for(let i = 1; i <=all_donees.length;i++){
          if(all_donees[i-1].id == Number($('.selectpicker').val())){
            donee.name = all_donees[i-1].full_name;
          }
        }
        //get values
        donee.id = $('.selectpicker').val()
        donee.type = $("#support_type").val()
        donee.money = $("#support_amount").val()
        donee.non_money = $("#support_description").val()

        //add to object
        donees[donees.length] = donee

        //update table
        let content = '';
        for(let i =0;i<donees.length;i++){
          content+=`
            <tr id="donees-content">
              <td data-title="مددجو">${donees[i].name}</td>
              <td data-title="کمک نقدی">${donees[i].money}</td>
              <td data-title="کمک غیرنقدی">${donees[i].non_money==null||donees[i].non_money==''?'-': donees[i].non_money}</td>
              <td data-title="حذف" style="cursor:pointer;color: #5c4ac7;    font-size: larger;" onclick="remove_donee(${i})"><i class="fa fa-trash" aria-hidden="true"></i></td>
            </tr>
          `
        }
        $("#donees-content").html(content)
        $("#support_amount").val('')
        $("#support_description").val('')
        close_modal()
      }

      function submit_form(){
        let content=``;
        for(let i=0;i<donees.length;i++){
          content+=`
            <input type="hidden" name="donees[${i}][id]" value="${donees[i].id}">
            <input type="hidden" name="donees[${i}][type]" value="${donees[i].type}">
            <input type="hidden" name="donees[${i}][money]" value="${donees[i].money}">
            <input type="hidden" name="donees[${i}][no_money]" value="${donees[i].non_money}">
          `
        }

        $("#donor_form").append(content)
        $("#donor_form").submit();


      }
  </script>
  <div  class="simti_overlay"></div>
  <div id="new_simti_modal" class="simti_modal visible">
    <div class="simti_modal_title">
      <h2 class="modal-title">مددجوی جدید</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">مددجو</label>
            <select class="selectpicker form-control" data-style="simti_o" name="donors[]" data-live-search="true">
              @foreach($all_donees as $donee)
                <option value="{{$donee->id}}" {{ in_array($donee->id, old('donors', []))? 'selected': ''}}>{{$donee->full_name}}</option>
              @endforeach
            </select>
            @if($errors->has('donors'))
              <small class="form-control-feedback text-danger">{{$errors->first('donors')}}</small>
            @endif
          </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">نوع حمایت</label>
                <select id="support_type" class="form-control" onchange="disable_input()">
                    <option value="1">نقدی</option>
                    <option value="2">غیر نقدی</option>
                    <option value="3">خدمات</option>
                </select>
              </div>
        </div> 
        <div class="col-md-12">
          <div class="form-group" i >
            <label class="control-label" > مبلغ (ریال)</label>
            <input autocomplete="off" type="number" id="support_amount" class="form-control" >
          </div>

          <div class="form-group">
            <label class="control-label" >شرح کمک</label>
            <textarea row="3" id="support_description" class="form-control" style="height:auto !important" disabled></textarea>
          </div>
        </div>
    </div>
    <button class="btn btn-primary modal-submit" onclick="add_donee()">افزودن</button>
  </div>

  {{--  <div id="edit_simti_modal" class="simti_modal visible">
    <div class="simti_modal_title">
      <h2 class="modal-title">منو ویرایش</h2>
    </div>
    <div class="row">
      <input autocomplete="off" id="edit_title" class="col-md-10 col-sm-10 col-xs-10 menu_title" style="margin:auto" type="text" placeholder="نام منو">
    </div>
    <div class="row">
        <div class="col-md-10 col-sm-10 col-xs-10 icon_droplist_container" >
            <span style="font-size: smaller;">انتخاب آیکن :</span>
            <div id="my-icon-select2"></div>
        </div>
    </div>
    <button class="btn btn-primary modal-submit" onclick="update_menu()">ثبت</button>
  </div>  --}}
@endsection