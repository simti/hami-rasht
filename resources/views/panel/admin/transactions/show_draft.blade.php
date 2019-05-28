@extends('layouts.admin.panel')

@section('custom_css')
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
      <h3 class="text-primary"> افزودن آشپزخانه</h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">آشپزخانه</li>
          <li class="breadcrumb-item active">مشاهده </li>
      </ol>
  </div>
@endsection
@section('content')
  @if(session('success'))
    
    toast_alert("درخواست شما با موفقیت ثبت شد. پس از تایید کارشناسان اعمال خواهد شد","false")
  @endif
  @if(session('requested'))
   
    toast_alert(" شما در گذشته درخواست دیگری برای ویرایش اطلاعات خود ثبت کرده اید که هنوز توسط کارشناسان تایید نشده است. پس از تایید درخواست قبلی شما اجازه ثبت درخواست دیگری خواهید داشت.","false")
  @endif
  <div class="row">
    <div class="col-lg-4">
      <div class="card card-outline-primary">
        <div class="card-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="form-body">
                      <h3 class="card-title m-t-15">۱) اطلاعات شخصی</h3>
                      <hr>
                      <div class="row p-t-20">
                          <div class="col-md-5">
                              <div class="form-group">
                                  <label class="control-label">نام </label>
                                  <input  type="text" id="first_name" name="first_name" disabled value="{{old('first_name', $draft->first_name)}}" class="form-control {{$errors->has('first_name')?'is-invalid':''}}">
                                  @if($errors->has('first_name'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('first_name')}}</small>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-7">
                              <div class="form-group">
                                  <label class="control-label">نام خانوادگی    </label>
                                  <input type="text" id="last_name" name="last_name" disabled value="{{old('last_name', $draft->last_name)}}" class="form-control {{$errors->has('last_name')?'is-invalid':''}}">
                                  @if($errors->has('last_name'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('last_name')}}</small>
                                  @endif
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">کدملی </label>
                              <input type="text" id="id_number" name="id_number" disabled value="{{old('id_number', $draft->id_number)}}" class="form-control {{$errors->has('id_number')?'is-invalid':''}}" >
                              @if($errors->has('id_number'))
                                <small class="form-control-feedback text-danger">{{$errors->first('id_number')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">شماره شناسنامه </label>
                              <input type="text" id="birth_certificate_id" name="birth_certificate_id" disabled value="{{old('birth_certificate_id', $draft->birth_certificate_id)}}" class="form-control {{$errors->has('birth_certificate_id')?'is-invalid':''}}">
                              @if($errors->has('birth_certificate_id'))
                                <small class="form-control-feedback text-danger">{{$errors->first('birth_certificate_id')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">شماره همراه </label>
                              <input type="text" id="mobile" name="mobile" class="form-control {{$errors->has('mobile')?'is-invalid':''}}" disabled value="{{old('mobile', $draft->mobile)}}">
                              @if($errors->has('mobile'))
                                <small class="form-control-feedback text-danger">{{$errors->first('mobile')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">ایمیل  </label>
                              <input type="email" id="email" name="email" class="form-control {{$errors->has('email')?'is-invalid':''}}" disabled value="{{old('email', $draft->email)}}">
                              @if($errors->has('email'))
                                <small class="form-control-feedback text-danger">{{$errors->first('email')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                      </div>
                      <!--/row-->
                      <div class="row">
                        <div class="col-md-12">
                          {{--  has-success  --}}
                          <div class="form-group">
                            <label class="control-label">جنسیت</label>
                            <select name="gender" disabled class="form-control custom-select">
                                <option value="1" {{old('gender', $draft->gender) == '1'? 'selected': ''}}>مرد</option>
                                <option value="2" {{old('gender', $draft->gender) == '2'? 'selected': ''}}>زن</option>
                            </select>
                            @if($errors->has('gender'))
                              <small class="form-control-feedback text-danger">{{$errors->first('gender')}}</small>
                            @endif
                          </div>
                        </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <label class="control-label">تاریخ تولد</label>
                              <div class="form-group">
                                <select name="birth_day"  disabled class="form-control custom-select {{$errors->has('birth_day')?'is-invalid':''}} simti_birthdate">
                                  <option value="">روز</option>
                                  @for($i=1;$i<32;$i++)
                                    <option value={{$i}} {{old('birth_day', $draft->birth_date_day) == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                  @endfor
                                </select>
                                <select name="birth_month" disabled class="form-control custom-select {{$errors->has('birth_month')?'is-invalid':''}} simti_birthdate">
                                  <option value="">ماه</option>
                                  @for($i=1;$i<13;$i++)
                                    <option value={{$i}} {{old('birth_month', $draft->birth_date_month) == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                  @endfor
                                </select>
                                <select name="birth_year" disabled class="form-control custom-select {{$errors->has('birth_year')?'is-invalid':''}} simti_birthdate">
                                  <option value="">سال</option>
                                  @for($i=1397;$i>1299;$i--)
                                    <option value={{$i}} {{old('birth_year', $draft->birth_date_year) == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                  @endfor
                                </select>
                                @if($errors->has('birth_year'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('birth_year')}}</small>
                                @endif
                                @if($errors->has('birth_month'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('birth_month')}}</small>
                                @endif
                                @if($errors->has('birth_day'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('birth_day')}}</small>
                                @endif
                              </div>
                          </div>
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
    <div class="col-lg-8">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-outline-primary">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-body">
                    <h3 class="box-title m-t-7">۲) اطلاعات مجوز بهداشت</h3>
                    <hr>
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">شماره کارت بهداشت</label>
                                <input type="text" id="certificate_number" disabled value="{{old('certificate_number', $draft->certificate_number_str)}}" name="certificate_number" class="form-control">
                                @if($errors->has('certificate_number'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('certificate_number')}}</small>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">تاریخ صدور </label>
                                <input type="text" id="certificate_date" disabled value="{{old('certificate_date', $draft->certificate_date_str)}}" name="certificate_date" class="form-control">
                                @if($errors->has('certificate_date'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('certificate_date')}}</small>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">تاریخ اتمام اعتبار </label>
                                <input type="text" id="certificate_expire" disabled value="{{old('certificate_expire', $draft->certificate_expire_str)}}" name="certificate_expire" class="form-control">
                                @if($errors->has('certificate_expire'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('certificate_expire')}}</small>
                                @endif
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <label class="control-label"> ضمیمه </label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="certificate-pic" disabled name="certificate_pic">
                                    <label class="custom-file-label" for="certificate-pic">عکس کارت</label>
                                    @if($errors->has('certificate_pic'))
                                      <small class="form-control-feedback text-danger">{{$errors->first('certificate_pic')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{--  <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Membership</label>
                                <div class="form-check">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="customRadio" disabled name="example" value="customEx">
                                        <label class="custom-control-label" for="customRadio">Custom radio 1</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="customRadio2" disabled name="example" value="customEx">
                                        <label class="custom-control-label" for="customRadio2">Custom radio 2</label>
                                    </div> 
                                </div>
                            </div>
                        </div>  --}}
                        <!--/span-->
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
                        <h3 class="card-title m-t-7">۳) اطلاعات آشپزخانه</h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">نام آشپزخانه </label>
                                    <input type="text" id="title" disabled name="title" value="{{old('title', $draft->title)}}" class="form-control {{$errors->has('title')?'is-invalid':''}}" >
                                    @if($errors->has('title'))
                                      <small class="form-control-feedback text-danger">{{$errors->first('title')}}</small>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">کدپستی </label>
                                    <input type="text" id="zip_code" disabled name="zip_code" value="{{old('zip_code', $draft->zip_code)}}" class="form-control {{$errors->has('zip_code')?'is-invalid':''}}" >
                                    @if($errors->has('zip_code'))
                                      <small class="form-control-feedback text-danger">{{$errors->first('zip_code')}}</small>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">شماره تلفن </label>
                                    <input type="text" id="phone" disabled name="phone" value="{{old('phone', $draft->phone)}}" class="form-control {{$errors->has('phone')?'is-invalid':''}}">
                                    @if($errors->has('phone'))
                                      <small class="form-control-feedback text-danger">{{$errors->first('phone')}}</small>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                {{--  has-success  --}}
                                <div class="form-group">
                                    <label class="control-label">نوع مالکیت</label>
                                    <select disabled name="tenant" class="form-control custom-select {{$errors->has('tenant')?'is-invalid':''}}">
                                        <option value="2"  {{old('tenant', $draft->tenant) == "2"? 'selected': ''}}>ملک شخصی</option>
                                        <option value="3"  {{old('tenant', $draft->tenant) == "3"? 'selected': ''}}>ملک اجاره ای</option>
                                        <option value="4"  {{old('tenant', $draft->tenant) == "4"? 'selected': ''}}>ملک رهنی</option>
                                    </select>
                                    @if($errors->has('tenant'))
                                      <small class="form-control-feedback text-danger">{{$errors->first('tenant')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                {{--  has-success  --}}
                                <div class="form-group">
                                    <label class="control-label">محله</label>
                                    <select disabled name="area_id" class="form-control custom-select {{$errors->has('area_id')?'is-invalid':''}}">
                                      @foreach($areas as $area)
                                        <option value="{{$area->id}}" {{old('area_id', $draft->area_id) == $area->value? 'selected': ''}}>{{$area->title}}</option>
                                      @endforeach
                                    </select>
                                    @if($errors->has('area_id'))
                                      <small class="form-control-feedback text-danger">{{$errors->first('area_id')}}</small>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-9">
                              <div class="form-group">
                                <label class="control-label">آدرس  </label>
                                <input type="text" id="address" disabled name="address" value="{{old('address', $draft->address)}}" class="form-control {{$errors->has('address')?'is-invalid':''}}">
                                @if($errors->has('address'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('address')}}</small>
                                @endif
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12">
                              <label class="control-label">مختصات</label>
                              <img style="width:100%" src="https://api.neshan.org/v2/static?key=service.rbuUrufajh7dL2qdKW7w61TSogG9gnwHz1B0vRaP&type=dreamy&zoom=16&center={{$draft->lat}},{{$draft->lon}}&width=900&height=300&marker=red">
                            </div>
                            <!--/span-->
                        </div>
                      </div>
                  </div>
              </div>
              <div class="form-actions text-left" style="margin-top:20px">
                  <a href="{{route('admin.kitchens.draft.accept', ['draft' => $draft])}}" class="btn btn-success"> تایید تغییرات <i class="fa fa-check"></i> </a>
                  <a href="{{route('admin.kitchens.draft.refuse', ['draft' => $draft])}}" class="btn btn-danger"> رد تغییرات <i class="fa fa-check"></i> </a>
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
    
@endsection