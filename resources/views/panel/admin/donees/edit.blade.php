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
      <h3 class="text-primary"> افزودن مددجو</h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">مددجو</li>
          <li class="breadcrumb-item active">جدید </li>
      </ol>
  </div>
@endsection

@section('content')
  <form id="donee_form" action="{{route('donees.update',$donee->id)}}" method="POST" enctype="multipart/form-data" >
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
                                  <input autocomplete="off" type="text" id="full_name" name="full_name" value="{{old('full_name',$donee->full_name)}}" class="form-control {{$errors->has('full_name')?'is-invalid':''}}">
                                  @if($errors->has('full_name'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('full_name')}}</small>
                                  @endif
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">نام پدر   </label>
                                <input autocomplete="off" type="text" id="father_name" name="father_name" value="{{old('father_name',$donee->father_name)}}" class="form-control {{$errors->has('father_name')?'is-invalid':''}}">
                                @if($errors->has('father_name'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('father_name')}}</small>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">کدملی </label>
                              <input autocomplete="off" maxlength="10" type="text" id="national_id" name="national_id" value="{{old('national_id',$donee->national_id)}}" class="form-control {{$errors->has('national_id')?'is-invalid':''}}" onkeyup="onlyNumber(this)" >
                              @if($errors->has('national_id'))
                                <small class="form-control-feedback text-danger">{{$errors->first('national_id')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">شماره شناسنامه </label>
                              <input autocomplete="off" type="text" id="birth_certificate_id" name="birth_certificate_id" value="{{old('birth_certificate_id',$donee->birth_certificate_id)}}" class="form-control {{$errors->has('birth_certificate_id')?'is-invalid':''}}" onkeyup="onlyNumber(this)" >
                              @if($errors->has('birth_certificate_id'))
                                <small class="form-control-feedback text-danger">{{$errors->first('birth_certificate_id')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">شماره تلفن  </label>
                              <input autocomplete="off" type="text" id="phone" name="phone" class="form-control {{$errors->has('phone')?'is-invalid':''}}" value="{{old('phone',$donee->phone)}}" onkeyup="onlyNumber(this)" >
                              @if($errors->has('phone'))
                                <small class="form-control-feedback text-danger">{{$errors->first('phone')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">شماره همراه </label>
                              <input autocomplete="off" type="text" id="mobile" name="mobile" class="form-control {{$errors->has('mobile')?'is-invalid':''}}" maxlength="11" value="{{old('mobile',$donee->mobile)}}" onkeyup="onlyNumber(this)">
                              @if($errors->has('mobile'))
                                <small class="form-control-feedback text-danger">{{$errors->first('mobile')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                              {{--  has-success  --}}
                              <div class="form-group">
                                <label class="control-label">جنسیت</label>
                                <select name="gender" class="form-control">
                                    <option value="1" {{old('gender', $donee->gender) == '1'? 'selected': ''}}>مرد</option>
                                    <option value="2" {{old('gender', $donee->gender) == '2'? 'selected': ''}}>زن</option>
                                </select>
                                @if($errors->has('gender'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('gender')}}</small>
                                @endif
                              </div>
                            </div>
                          
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">میزان تحصیلات  </label>
                              <input autocomplete="off" type="text" id="education" name="education" value="{{old('education',$donee->education)}}" class="form-control {{$errors->has('education')?'is-invalid':''}}" >
                              @if($errors->has('education'))
                                <small class="form-control-feedback text-danger">{{$errors->first('education')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label">تاریخ  تولد </label>
                                <input autocomplete="off" type="text" autocomplete="off" id="birth_date" value="{{old('birth_date',App\Drivers\Time::jdate('Y-m-d', $timestamp = $donee->birth_date, $none = '', $time_zone = 'Asia/Tehran', $tr_num = 'en'))}}"  name="birth_date" class="form-control datepicker" >
                                @if($errors->has('birth_date'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('birth_date')}}</small>
                                @endif
                              </div>
                            </div>
                      </div>
                      <!--/row-->
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">آدرس</label>
                                <input autocomplete="off" type="text" id="address" name="address" class="form-control {{$errors->has('address')?'is-invalid':''}}"  value="{{old('address',$donee->address)}}" >
                                @if($errors->has('address'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('address')}}</small>
                                @endif
                              </div>
                            </div>
                          <!--/span-->
                        <!--/span-->
                      </div>
                      <!--/row-->
                      <!--/row-->
                      
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
                    <h3 class="box-title m-t-7">۲) اطلاعات بانکی</h3>
                    <hr>
                    <div class="row p-t-20">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">شماره حساب</label>
                          <input autocomplete="off" type="text" id="bank_account_number" name="bank_account_number" value="{{old('bank_account_number',$donee->bank_account_number )}}" class="form-control" onkeyup="onlyNumber(this)">
                          @if($errors->has('bank_account_number'))
                            <small class="form-control-feedback text-danger">{{$errors->first('bank_account_number')}}</small>
                          @endif
                        </div>
                      </div>
                        <!--/span-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">شماره کارت</label>
                          <input autocomplete="off" maxlength="16" type="text" id="bank_card_number" name="bank_card_number" value="{{old('bank_card_number',$donee->bank_card_number)}}" class="form-control" onkeyup="onlyNumber(this)">
                          @if($errors->has('bank_card_number'))
                            <small class="form-control-feedback text-danger">{{$errors->first('bank_card_number')}}</small>
                          @endif
                        </div>
                      </div>
                        <!--/span-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">صاحب حساب</label>
                          <input autocomplete="off" type="text" id="bank_account_owner" name="bank_account_owner" value="{{old('bank_account_owner',$donee->bank_account_owner)}}" class="form-control" >
                          @if($errors->has('bank_account_owner'))
                            <small class="form-control-feedback text-danger">{{$errors->first('bank_account_owner')}}</small>
                          @endif
                        </div>
                      </div>
                        <!--/span-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">نام بانک</label>
                          <input autocomplete="off" type="text" id="bank_name" name="bank_name" value="{{old('bank_name',$donee->bank_name)}}" class="form-control">
                          @if($errors->has('bank_name'))
                            <small class="form-control-feedback text-danger">{{$errors->first('bank_name')}}</small>
                          @endif
                        </div>
                      </div>
                        <!--/span-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">شعبه</label>
                          <input autocomplete="off" type="text" id="bank_branch_name" name="bank_branch_name" value="{{old('bank_branch_name',$donee->bank_branch_name)}}" class="form-control">
                          @if($errors->has('bank_branch_name'))
                            <small class="form-control-feedback text-danger">{{$errors->first('bank_branch_name')}}</small>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card card-outline-primary">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-body">
                    <h3 class="box-title m-t-7">3) اطلاعات پرونده</h3>
                    <hr>
                    <div class="row p-t-20">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">شماره پرونده </label>
                            <input autocomplete="off" type="text" id="file_number" name="file_number" value="{{old('file_number',$donee->file_number)}}"  class="form-control {{$errors->has('file_number')?'is-invalid':''}}" onkeyup="onlyNumber(this)">
                            @if($errors->has('file_number'))
                              <small class="form-control-feedback text-danger">{{$errors->first('file_number')}}</small>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">تاریخ شروع فعالیت </label>
                          <input autocomplete="off" type="text" autocomplete="off" id="membership_start_date" value="{{old('membership_start_date', App\Drivers\Time::jdate('Y-m-d', $timestamp = $donee->membership_start_date, $none = '', $time_zone = 'Asia/Tehran', $tr_num = 'en'))}}"  name="membership_start_date" class="form-control datepicker" >
                          @if($errors->has('membership_start_date'))
                            <small class="form-control-feedback text-danger">{{$errors->first('membership_start_date')}}</small>
                          @endif
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-4">
                          {{--  has-success  --}}
                          <div class="form-group">
                            <label class="control-label">واحد سازمانی</label>
                            <select name="organization_branch" class="form-control">
                                <option value="1" {{old('organization_branch',$donee->organization_branch) == '1'? 'selected': ''}}>توانبخشی</option>
                                <option value="2" {{old('organization_branch',$donee->organization_branch) == '2'? 'selected': ''}}>اجتماعی </option>
                                <option value="3" {{old('organization_branch',$donee->organization_branch) == '3'? 'selected': ''}}>پیشگیری </option>
                            </select>
                            @if($errors->has('organization_branch'))
                              <small class="form-control-feedback text-danger">{{$errors->first('organization_branch')}}</small>
                            @endif
                          </div>
                        </div>
                        <!--/span-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">تعداد افراد معلول خانواده</label>
                          <input autocomplete="off" type="number" id="number_of_disabled_members_in_family" name="number_of_disabled_members_in_family" value="{{old('number_of_disabled_members_in_family',$donee->number_of_disabled_members_in_family)}}" class="form-control" onkeyup="onlyNumber(this)">
                          @if($errors->has('number_of_disabled_members_in_family'))
                            <small class="form-control-feedback text-danger">{{$errors->first('number_of_disabled_members_in_family')}}</small>
                          @endif
                        </div>
                      </div>
                        <!--/span-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">تعداد افراد خانواده</label>
                          <input autocomplete="off" type="number" id="number_of_family_members" name="number_of_family_members" value="{{old('number_of_family_members',$donee->number_of_family_members)}}" class="form-control" onkeyup="onlyNumber(this)">
                          @if($errors->has('number_of_family_members'))
                            <small class="form-control-feedback text-danger">{{$errors->first('number_of_family_members')}}</small>
                          @endif
                        </div>
                      </div>
                        <!--/span-->
                      <div class="col-md-4">
                        {{--  has-success  --}}
                        <div class="form-group">
                          <label class="control-label">معلول</label>
                          <select name="disabled" class="form-control">
                              <option value="1" {{old('disabled',$donee->disabled) == '1'? 'selected': ''}}>می باشد</option>
                              <option value="2" {{old('disabled',$donee->disabled) == '2'? 'selected': ''}}>نمی باشد</option>
                          </select>
                          @if($errors->has('disabled'))
                            <small class="form-control-feedback text-danger">{{$errors->first('disabled')}}</small>
                          @endif
                        </div>
                      </div>

                      <div class="col-md-4">
                        {{--  has-success  --}}
                        <div class="form-group">
                          <label class="control-label">نوع خروجی</label>
                          <select name="output_type" class="form-control">
                              <option value="1" {{old('output_type', $donee->output_type) == '1'? 'selected': ''}}>بانک</option>
                              <option value="2" {{old('output_type', $donee->output_type) == '2'? 'selected': ''}}> درون سازمانی</option>
                          </select>
                          @if($errors->has('output_type'))
                            <small class="form-control-feedback text-danger">{{$errors->first('output_type')}}</small>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <!--/span-->
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="control-label">علت حمایت</label>
                          <input autocomplete="off" type="text" id="reasons_to_help" name="reasons_to_help" value="{{old('reasons_to_help',$donee->reasons_to_help)}}" class="form-control">
                          @if($errors->has('reasons_to_help'))
                            <small class="form-control-feedback text-danger">{{$errors->first('reasons_to_help')}}</small>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">&nbsp;</label><br>
                            <button type="button" class="btn btn-primary" onclick="open_modal()">افزودن حامی</button>
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
                                            <th>حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody id="donors-content">
                                        @foreach ($donee->donors as $index=>$donor)
                                          <tr id="donees-content">
                                            <td data-title="مددجو">{{$donor->full_name}}</td>
                                            <td data-title="کمک نقدی">{{$donor->pivot->money_amount}}</td>
                                            <td data-title="کمک غیرنقدی">{{$donor->pivot->non_money_detail=='null'||$donor->pivot->non_money_detail==null||$donor->pivot->non_money_detail==''?'-':$donor->pivot->non_money_detail}}</td>
                                            <td  style="cursor:pointer;color: #5c4ac7;    font-size: larger;" >
                                              <i class="fa fa-trash" aria-hidden="true" onclick="remove_donor({{$index}})"></i>
                                              &nbsp;&nbsp;
                                              <i class="fa fa-edit" aria-hidden="true" onclick="open_edit_modal({{$index}})" style="    margin-top: 3px;"></i>
                                            </td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    <div class="form-actions text-left" style="margin-top:80px">
                        <button type="submit" class="btn btn-success" onclick="submit_form()"> بروزرسانی اطلاعات <i class="fa fa-check"></i> </button>
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
      var all_donors = @json($all_donors);
      let donors_belongs_to_donee = @json($donee->donors);
      let donors = []
      for(let i=0;i<donors_belongs_to_donee.length;i++){
        let obj = {}
        obj.id = donors_belongs_to_donee[i].id;
        obj.name = donors_belongs_to_donee[i].full_name;
        obj.type = donors_belongs_to_donee[i].pivot.donation_type;
        obj.money = donors_belongs_to_donee[i].pivot.money_amount;
        obj.non_money = donors_belongs_to_donee[i].pivot.non_money_detail;
        donors[i] = obj
      }
  </script>
  <script>
      function open_modal(){
        $('.menu_title').val('')
        $('.simti_overlay').show();
        $('#new_modal').show();
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
      function disable_input_edit(){
        if(Number($("#support_type_edit").val())==1){
          $("#support_amount_edit").removeAttr("disabled")
          $("#support_description_edit").val('')
          $("#support_description_edit").attr("disabled",true)
        }else{
          $("#support_amount_edit").attr("disabled",true)
          $("#support_amount_edit").val(0);
          $("#support_description_edit").removeAttr("disabled")
        }
      }
      function remove_donor(index){
        donors.splice(index,1)
        //update table
        render_donors(donors)
      }

      //modal close on outside
      $(document).ready(function() {
        $('.simti_overlay').click(function(){
          close_modal()
        })
      })
      //store donors
      function add_donor(){
        let donor = {};
        //check for uniqueness
        if(donors.length>0){
          if(typeof(donors.find(donor => donor.id == $('#donor').val())) != "object"){
            //get selected full_name
            for(let i = 1; i <=all_donors.length;i++){
              if(all_donors[i-1].id == Number($('#donor').val())){
                donor.name = all_donors[i-1].full_name;
              }
            }
            //get values
            donor.id = $('#donor').val()
            donor.type = $("#support_type").val()
            donor.money = $("#support_amount").val()
            donor.non_money = $("#support_description").val()

            //add to object
            donors[donors.length] = donor

            //update table
            render_donors(donors)
            $("#support_amount").val('')
            $("#support_description").val('')
            close_modal()
          }else{
            toast_alert("این مددجو قبلا اضافه شده است","true");
          }
        }else{
          //get selected full_name
          for(let i = 1; i <=all_donors.length;i++){
            if(all_donors[i-1].id == Number($('#donor').val())){
              donor.name = all_donors[i-1].full_name;
            }
          }
          //get values
          donor.id = $('#donor').val()
          donor.type = $("#support_type").val()
          donor.money = $("#support_amount").val()
          donor.non_money = $("#support_description").val()

          //add to object
          donors[donors.length] = donor

          //update table
          render_donors(donors);
          $("#support_amount").val('')
          $("#support_description").val('')
          close_modal()
        }
      }

      function open_edit_modal(index) {
        
        $("#support_amount_edit").removeAttr("disabled");
        //initiate values
        $("#support_type_edit").val(donors[index].type)
        $("#support_amount_edit").val(donors[index].money);
        $("#support_description_edit").val(donors[index].non_money)
        $("#donor_edit").val(donors[index].id);
        $("#donor_edit").selectpicker('render');
        if(Number(donors[index].type) == 1){
          $("#support_amount_edit").removeAttr("disabled")
          $("#support_description_edit").attr("disabled",true)
        }else{
          $("#support_amount_edit").attr("disabled",true)
          $("#support_description_edit").removeAttr("disabled");
        }
        
        
        $("#donor-update-button").attr("onclick", `update_donor(${index})`)
            //open box
        $('.simti_overlay').fadeIn("slow");
        $('#edit_modal').fadeIn("slow");
        $('body').addClass('stop-scrolling')
      }

      function update_donor(index){
        let found = donors.find(donor => donor.id == $('#donor_edit').val());
  
        if(typeof(found) == "undefined"){
          //get selected full_name
          for(let i = 1; i <=all_donors.length;i++){
            if(all_donors[i-1].id == Number($('#donor_edit').val())){
              donors[index].name = all_donors[i-1].full_name;
            }
          }
          //get values
          donors[index].id = $('#donor_edit').val()
          donors[index].type = $("#support_type_edit").val()
          donors[index].money = $("#support_amount_edit").val()
          donors[index].non_money = $("#support_description_edit").val()

        }else{
          if(found.id == donors[index].id){
            donors[index].type = $("#support_type_edit").val()
            donors[index].money = $("#support_amount_edit").val()
            donors[index].non_money = $("#support_description_edit").val()
          }else{
            toast_alert("این مددجو قبلا اضافه شده است","true");
          }
        }

        //update table
        render_donors(donors)
        $("#support_amount_edit").val('')
        $("#support_description_edit").val('')
        close_modal()
      }
      

      function submit_form(){
        let content=``;
        for(let i=0;i<donors.length;i++){
          content+=`
            <input type="hidden" name="donors[${i}][id]" value="${donors[i].id}">
            <input type="hidden" name="donors[${i}][type]" value="${donors[i].type}">
            <input type="hidden" name="donors[${i}][money]" value="${donors[i].money}">
            <input type="hidden" name="donors[${i}][no_money]" value="${donors[i].non_money}">
          `
        }

        $("#donee_form").append(content)

        $("#donee_form").submit();


      }

      function render_donors(list){
        let content = '';
        for(let i =0;i<list.length;i++){
          content+=`
            <tr id="donors-content">
              <td data-title="مددجو">${list[i].name}</td>
              <td data-title="کمک نقدی">${list[i].money}</td>
              <td data-title="کمک غیرنقدی">${list[i].non_money==''?'-': list[i].non_money}</td>
              <td data-title="عملیات" style="cursor:pointer;color: #5c4ac7;    font-size: larger;">
                <i class="fa fa-trash" aria-hidden="true" onclick="remove_donor(${i})"></i>
                &nbsp;&nbsp;
                <i class="fa fa-edit" aria-hidden="true" onclick="open_edit_modal(${i})" style="    margin-top: 3px;"></i>
              </td>
              
            </tr>
          `
        }
        $("#donors-content").html(content)
      }
  </script>
  <div  class="simti_overlay"></div>
  <div id="new_modal" class="simti_modal visible">
    <div class="simti_modal_title">
      <h2 class="modal-title">منوی جدید</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">حامی</label>
            <select id="donor" class="selectpicker form-control" data-style="simti_o" name="donors[]" data-live-search="true">
              @foreach($all_donors as $donor)
                <option value="{{$donor->id}}" {{ in_array($donor->id, old('donors', []))? 'selected': ''}}>{{$donor->full_name}}</option>
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
    <button class="btn btn-primary modal-submit" onclick="add_donor()">افزودن</button>
  </div>
  <div id="edit_modal" class="simti_modal visible">
    <div class="simti_modal_title">
      <h2 class="modal-title">ویرایش مددجو</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">مددجو</label>
            <select id="donor_edit" class="selectpicker form-control" data-style="simti_o" name="donors[]" data-live-search="true">
              @foreach($all_donors as $donor)
                <option value="{{$donor->id}}" {{ in_array($donor->id, old('donors', []))? 'selected': ''}}>{{$donor->full_name}}</option>
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
                <select id="support_type_edit" class="form-control" onchange="disable_input_edit()">
                    <option value="1">نقدی</option>
                    <option value="2">غیر نقدی</option>
                    <option value="3">خدمات</option>
                </select>
              </div>
        </div> 
        <div class="col-md-12">
          <div class="form-group" i >
            <label class="control-label" > مبلغ (ریال)</label>
            <input autocomplete="off" type="number" id="support_amount_edit" class="form-control" >
          </div>

          <div class="form-group">
            <label class="control-label" >شرح کمک</label>
            <textarea row="3" id="support_description_edit" class="form-control" style="height:auto !important" disabled></textarea>
          </div>
        </div>
    </div>
    <button id="donor-update-button" class="btn btn-primary modal-submit" >ویرایش</button>
  </div>

@endsection