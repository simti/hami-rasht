@extends('layouts.admin.panel')

@section('custom_css')
  <link href="https://static.neshan.org/api/web/v1/leaflet/1.3.3/leaflet.css" rel="stylesheet" type="text/css">
  <script src="https://static.neshan.org/api/web/v1/leaflet/1.3.3/leaflet.js" type="text/javascript"></script>
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
      <h3 class="text-primary"> نمایش آشپزخانه</h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">آشپزخانه</li>
          <li class="breadcrumb-item active">نمایش </li>
      </ol>
  </div>
@endsection

@section('content')
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
                                  <input  type="text" id="first_name" disabled name="first_name" value="{{$kitchen->user->first_name}}" class="form-control">
                              </div>
                          </div>
                          <div class="col-md-7">
                              <div class="form-group">
                                  <label class="control-label">نام خانوادگی    </label>
                                  <input type="text" id="last_name" disabled name="last_name" value="{{$kitchen->user->last_name}}" class="form-control">
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">کدملی </label>
                              <input type="text" id="id_number" disabled name="id_number" value="{{$kitchen->id_number}}" class="form-control" >
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">شماره شناسنامه </label>
                              <input type="text" id="birth_certificate_id" disabled name="birth_certificate_id" value="{{$kitchen->birth_certificate_id}}" class="form-control" >
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">شماره همراه </label>
                              <input type="text" id="mobile" disabled name="mobile" class="form-control" maxlength="11" value="{{$kitchen->user->phone}}">
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">ایمیل  </label>
                              <input type="email" id="email" disabled name="email" class="form-control" value="{{$kitchen->user->email_str}}" >
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
                            <select disabled name="gender" class="form-control">
                                <option value="1" {{$kitchen->gender == '1'? 'selected': ''}}>مرد</option>
                                <option value="2" {{$kitchen->gender == '2'? 'selected': ''}}>زن</option>
                            </select>
                          </div>
                        </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">تاریخ  تولد </label>
                              <input type="text" id="birth_date" value="{{$kitchen->user->birth_date}}"  disabled name="birth_date" class="form-control datepicker" >
                            </div>
                              {{-- <div class="form-group">
                                <select disabled name="birth_day"  value="{{old('birth_day')}}" class="form-control  simti_birthdate">
                                  <option value="">روز</option>
                                  @for($i=1;$i<32;$i++)
                                    <option value={{$i}} {{old('birth_day', '') == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                  @endfor
                                </select>
                                <select disabled name="birth_month" value="{{old('birth_month')}}" class="form-control  simti_birthdate">
                                  <option value="">ماه</option>
                                  @for($i=1;$i<13;$i++)
                                    <option value={{$i}} {{old('birth_month', '') == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                  @endfor
                                </select>
                                <select disabled name="birth_year" value="{{old('birth_year')}}" class="form-control  simti_birthdate">
                                  <option value="">سال</option>
                                  @for($i=1397;$i>1299;$i--)
                                    <option value={{$i}} {{old('birth_year', '') == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                  @endfor
                                </select>
                              </div> --}}
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
      <div class="card card-outline-primary">
          <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12">
                              @if($kitchen->creator)
                                @if($kitchen->creator->isAdmin())
                                  <div class="form-group">
                                    <label class="control-label">سازنده </label>
                                    <input  type="text" disabled value="{{$kitchen->creator->full_name}}" class="form-control">
                                  </div>
                                @else
                                  <div class="form-group">
                                    <label class="control-label">سازنده </label>
                                    <input  type="text" disabled value="{{$kitchen->creator->full_name}} - از درخواست همکاری" class="form-control">
                                  </div>
                                @endif
                              @else
                                <div class="form-group">
                                  <label class="control-label">سازنده </label>
                                  <input  type="text" disabled value="از طریق صفحه درخواست همکاری" class="form-control">
                                </div>
                              @endif

                              <div class="form-group">
                                <label class="control-label">نوع آشپزخانه </label>
                                <input  type="text" disabled value="{{$kitchen->level_str}}" class="form-control">
                              </div>
                            </div>
                        </div>
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
                          <input type="text" id="certificate_number" disabled name="certificate_number" value="{{$kitchen->certificate_number_str}}" class="form-control">
                        </div>
                      </div>
                        <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="certificate_date">تاریخ صدور</label>
                          <input   type="text" id="certificate_date" value="{{$kitchen->certificate_date_str}}" disabled name="certificate_date" class="form-control datepicker" autocomplete="off" />
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">تاریخ اتمام اعتبار </label>
                          <input type="text" id="certificate_expire" value="{{$kitchen->certificate_expire_str}}" disabled name="certificate_expire" class="form-control datepicker" >
                      </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                        <label class="control-label"> ضمیمه </label>
                        <img class="col-md-12" src="{{$kitchen->certificate_pic_url}}" />
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
                                    <input type="text" id="title" disabled name="title" value="{{$kitchen->title}}" class="form-control" >
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">کدپستی </label>
                                    <input type="text" id="zip_code" disabled name="zip_code" value="{{$kitchen->zip_code}}" class="form-control" >
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">شماره تلفن </label>
                                    <input type="text" id="phone" disabled name="phone" value="{{$kitchen->phone}}" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                {{--  has-success  --}}
                                <div class="form-group">
                                    <label class="control-label">نوع مالکیت</label>
                                    <select disabled name="tenant" class="form-control ">
                                        <option value="2"  {{$kitchen->tenant == "2"? 'selected': ''}}>ملک شخصی</option>
                                        <option value="3"  {{$kitchen->tenant == "3"? 'selected': ''}}>ملک اجاره ای</option>
                                        <option value="4"  {{$kitchen->tenant == "4"? 'selected': ''}}>ملک رهنی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                {{--  has-success  --}}
                                <div class="form-group">
                                    <label class="control-label">محله</label>
                                    <select disabled name="area_id" class="form-control ">
                                        @foreach($areas as $area)
                                          <option value="{{$area->id}}" {{$kitchen->area_id == $area->id? 'selected': ''}}>{{$area->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-9">
                              <div class="form-group">
                                <label class="control-label">آدرس  </label>
                                <input type="text" id="address" name="address" disabled value="{{$kitchen->address}}" class="form-control">
                              </div>
                            </div>
                            
                            <div class="col-md-12">
                              <label class="control-label">مختصات</label>
                              <div id="map" style="width: 100%; height: 250px; background: #eee; border: 2px solid #aaa;"></div>
                              <input id="lat" type="hidden" value="{{$kitchen->lat}}" name="lat">
                              <input id="lon" type="hidden" value="{{$kitchen->lon}}" name="lon">
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="form-actions text-left" style="margin-top:20px">
                @if($kitchen->status == App\kitchen::PENDING)
                  <a class="btn btn-success" href="{{route('admin.kitchens.pending.accept', ['kitchen' => $kitchen])}}"> قبول درخواست <i class="fa fa-check"></i> </a>
                  <a class="btn btn-warning" href="{{route('admin.kitchens.pending.refuse', ['kitchen' => $kitchen])}}"> رد درخواست <i class="fa fa-times"></i> </a>
                @else
                <a class="btn btn-success" href="{{route('admin.kitchens.create')}}"> افزودن <i class="fa fa-pencil"></i> </a>
                @endif
                <a class="btn btn-primary" href="{{route('admin.kitchens.edit', ['kitchen' => $kitchen])}}"> ویرایش <i class="fa fa-pencil"></i> </a>
                <a class="btn btn-danger"  href="{{route('admin.kitchens.delete', ['id' => $kitchen->id])}}" onclick="return confirm('آیا اطمینان دارید؟');"> حذف <i class="fa fa-times"></i> </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('custom_js')    
<script type="text/javascript">
  let lat = {{$kitchen->lat}};
  let lon = {{$kitchen->lon}};
  // default location
  var myMap = new L.Map('map', {
          key: 'web.AybxFD5rFrSRDTs9tS6teqXZxwnXRxPs51ZLE5cj',
          center: [lat, lon],
          zoom: 16,
          traffic: false
      });
      var marker = L.marker([lat, lon]).addTo(myMap);
      
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
          lat = position.coords.latitude;
          lon = position.coords.longitude
          myMap.setView(L.latLng(lat, lon));
          marker = L.marker([lat, lon]).addTo(myMap);
      });
  }
  var popup = L.popup();
</script>
@endsection