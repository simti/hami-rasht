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
      <h3 class="text-primary"> ویرایش آشپزخانه</h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">آشپزخانه</li>
          <li class="breadcrumb-item active">ویرایش </li>
      </ol>
  </div>
@endsection

@section('content')
<form action="{{route('admin.kitchens.update', ['kitchen' => $kitchen])}}" method="POST" enctype="multipart/form-data">
  @csrf
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
                                  <input autocomplete="off" type="text" id="first_name" name="first_name" value="{{old('first_name', $kitchen->user->first_name)}}" class="form-control" >
                                  @if($errors->has('first_name'))
                                    <small class="form-control-feedback">{{$errors->first('first_name')}}</small>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-7">
                              <div class="form-group">
                                  <label class="control-label">نام خانوادگی    </label>
                                  <input autocomplete="off" type="text" id="last_name" name="last_name" value="{{old('last_name', $kitchen->user->last_name)}}" class="form-control" >
                                  @if($errors->has('last_name'))
                                    <small class="form-control-feedback">{{$errors->first('last_name')}}</small>
                                  @endif
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">کدملی </label>
                              <input autocomplete="off" type="text" id="id_number" name="id_number" value="{{old('id_number', $kitchen->id_number)}}" class="form-control" onkeyup="onlyNumber(this)">
                              @if($errors->has('id_number'))
                                <small class="form-control-feedback">{{$errors->first('id_number')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">شماره شناسنامه </label>
                              <input autocomplete="off" type="text" id="birth_certificate_id" name="birth_certificate_id" value="{{old('birth_certificate_id', $kitchen->birth_certificate_id)}}" class="form-control" onkeyup="onlyNumber(this)">
                              @if($errors->has('birth_certificate_id'))
                                <small class="form-control-feedback">{{$errors->first('birth_certificate_id')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">شماره همراه </label>
                              <input autocomplete="off" type="text" id="mobile" name="mobile" maxlength="11" class="form-control" value="{{old('mobile', $kitchen->user->phone)}}" onkeyup="onlyNumber(this)" >
                              @if($errors->has('mobile'))
                                <small class="form-control-feedback">{{$errors->first('mobile')}}</small>
                              @endif
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">ایمیل  </label>
                              <input autocomplete="off" type="email" id="email" name="email" class="form-control" value="{{old('email', $kitchen->user->email == 'NuLL'? '' : $kitchen->user->email)}}" >
                              @if($errors->has('email'))
                                <small class="form-control-feedback">{{$errors->first('email')}}</small>
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
                            <select name="gender" class="form-control">
                                <option value="1" {{old('gender', $kitchen->gender) == '1'? 'selected': ''}}>مرد</option>
                                <option value="2" {{old('gender', $kitchen->gender) == '2'? 'selected': ''}}>زن</option>
                            </select>
                            @if($errors->has('gender'))
                              <small class="form-control-feedback">{{$errors->first('gender')}}</small>
                            @endif
                          </div>
                        </div>
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">تاریخ  تولد </label>
                              <input  type="text" id="birth_date" value="{{old('birth_date', $kitchen->user->birth_date)}}" name="birth_date" class="form-control datepicker" autocomplete="off" >
                              @if($errors->has('birth_date'))
                                <small class="form-control-feedback text-danger">{{$errors->first('birth_date')}}</small>
                              @endif
                            </div>
                            {{-- <div class="form-group">
                              <select name="birth_day" class="form-control simti_birthdate">
                                <option value="">روز</option>
                                @for($i=1;$i<32;$i++)
                                  <option value={{$i}} {{old('birth_day', $kitchen->user->birth_date_day) == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                @endfor
                              </select>
                              <select name="birth_month" class="form-control simti_birthdate">
                                <option value="">ماه</option>
                                @for($i=1;$i<13;$i++)
                                  <option value={{$i}} {{old('birth_month', $kitchen->user->birth_date_month) == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                @endfor
                              </select>
                              <select name="birth_year" class="form-control simti_birthdate">
                                <option value="">سال</option>
                                @for($i=1397;$i>1299;$i--)
                                  <option value={{$i}} {{old('birth_year', $kitchen->user->birth_date_year) == $i? 'selected': ''}}>{{App\Drivers\ConvertNumber::EnglishToPersian($i)}}</option>
                                @endfor
                              </select>
                              @if($errors->has('birth_year'))
                                <small class="form-control-feedback">{{$errors->first('birth_year')}}</small>
                              @endif
                              @if($errors->has('birth_month'))
                                <small class="form-control-feedback">{{$errors->first('birth_month')}}</small>
                              @endif
                              @if($errors->has('birth_day'))
                                <small class="form-control-feedback">{{$errors->first('birth_day')}}</small>
                              @endif
                            </div> --}}
                          </div>
                          <!--/span-->
                      </div>
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
                                <input autocomplete="off" type="text" id="certificate_number" name="certificate_number" value="{{old('certificate_number', $kitchen->certificate_number_str)}}" class="form-control" onkeyup="onlyNumber(this)" >
                                @if($errors->has('certificate_number'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('certificate_number')}}</small>
                                @endif
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="certificate_date">تاریخ صدور</label>
                                <input autocomplete="off" type="text" id="certificate_date" value="{{old('certificate_date', $kitchen->certificate_date_str)}}" name="certificate_date" class="form-control datepicker" autocomplete="off" />
                                @if($errors->has('certificate_date'))
                                  <small class="form-control-feedback text-danger">{{$errors->first('certificate_date')}}</small>
                                @endif
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">تاریخ اتمام اعتبار </label>
                                <input autocomplete="off" type="text" id="certificate_expire" value="{{old('certificate_expire', $kitchen->certificate_expire_str)}}" name="certificate_expire" class="form-control datepicker" autocomplete="off" >
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
                                  <input autocomplete="off" type="file" class="custom-file-input" id="certificate-pic" name="certificate_pic">
                                  <label class="custom-file-label" for="certificate-pic">عکس کارت</label>
                                  @if($errors->has('certificate_pic'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('certificate_pic')}}</small>
                                  @endif
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 behdasht_card" style="">
                                  <a target="tab" href="{{$kitchen->certificate_pic_url}}"><img src="{{$kitchen->certificate_pic_url}}" style="width:100%"></a>
                                </div>
                              </div>
                            </div>
      
                              {{--  <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Membership</label>
                                      <div class="form-check">
                                          <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" class="custom-control-input" id="customRadio" name="example" value="customEx">
                                              <label class="custom-control-label" for="customRadio">Custom radio 1</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" class="custom-control-input" id="customRadio2" name="example" value="customEx">
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
                                        <input autocomplete="off" type="text" id="title" name="title" value="{{old('title', $kitchen->title)}}" class="form-control">
                                        @if($errors->has('title'))
                                          <small class="form-control-feedback">{{$errors->first('title')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">کدپستی </label>
                                        <input autocomplete="off" type="text" id="zip_code" name="zip_code" value="{{old('zip_code', $kitchen->zip_code)}}" class="form-control" >
                                        @if($errors->has('zip_code'))
                                          <small class="form-control-feedback">{{$errors->first('zip_code')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">شماره تلفن </label>
                                        <input autocomplete="off" type="text" id="phone" name="phone" value="{{old('phone', $kitchen->phone)}}" class="form-control" >
                                        @if($errors->has('phone'))
                                          <small class="form-control-feedback">{{$errors->first('phone')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    {{--  has-success  --}}
                                    <div class="form-group">
                                        <label class="control-label">نوع مالکیت</label>
                                        <select name="tenant" class="form-control">
                                            <option value="2"  {{old('tenant', $kitchen->tenant) == "2"? 'selected': ''}}>ملک شخصی</option>
                                            <option value="3"  {{old('tenant', $kitchen->tenant) == "3"? 'selected': ''}}>ملک اجاره ای</option>
                                            <option value="4"  {{old('tenant', $kitchen->tenant) == "4"? 'selected': ''}}>ملک رهنی</option>
                                        </select>
                                        @if($errors->has('tenant'))
                                          <small class="form-control-feedback">{{$errors->first('tenant')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{--  has-success  --}}
                                    <div class="form-group">
                                        <label class="control-label">محله</label>
                                        <select name="area_id" class="form-control" onchange="update_map(this)">
                                            @foreach($areas as $area)
                                              <option value="{{$area->id}}" data-lat="{{$area->lat}}" data-lon="{{$area->lon}}" {{old('area_id', $kitchen->area_id) == $area->id? 'selected': ''}}>{{$area->title}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('area_id'))
                                          <small class="form-control-feedback">{{$errors->first('area_id')}}</small>
                                        @endif
                                    </div>

                                    <script>
                                      function update_map(obj){
                                        let latitude = obj.options[obj.selectedIndex].getAttribute('data-lat');
                                        let longtitude = obj.options[obj.selectedIndex].getAttribute('data-lon');
                                        $("#lat").val(latitude);
                                        $("#lon").val(longtitude);
                                        myMap.setView(new L.LatLng(latitude, longtitude));
                                        marker.setLatLng(new L.LatLng(latitude, longtitude));
                                      }
                                    </script>
                                </div>
                            <!--/span-->
                              <div class="col-md-9">
                                <div class="form-group">
                                  <label class="control-label">آدرس  </label>
                                  <input autocomplete="off" type="text" id="address" name="address" value="{{old('address', $kitchen->address)}}" class="form-control {{$errors->has('address')?'is-invalid':''}}">
                                  @if($errors->has('address'))
                                    <small class="form-control-feedback text-danger">{{$errors->first('address')}}</small>
                                  @endif
                                </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-12">
                                <label class="control-label">مختصات</label>
                                <div id="map" style="width: 100%; height: 250px; background: #eee; border: 2px solid #aaa;"></div>
                                <input id="lat" type="hidden" value="{{old('lat', $kitchen->lat)}}" name="lat">
                                <input id="lon" type="hidden" value="{{old('lon', $kitchen->lon)}}" name="lon">
                              </div>
                              <!--/span-->
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-actions text-left" style="margin-top:20px">
                      <button type="submit" class="btn btn-success"> دخیره تغییرات <i class="fa fa-check"></i> </button>
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

  <script type="text/javascript">
    let lat = {{old('lat', $kitchen->lat)}};
    let lon = {{old('lon', $kitchen->lon)}};
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
    myMap.on('click', onMapClick);
    function onMapClick(e) {
        {{--  popup
        .setLatLng(e.latlng)
        .setContent(e.latlng.toString())
        .openOn(myMap);  --}}
        marker.setLatLng(e.latlng);
        $("#lat").val(e.latlng.lat);
        $("#lon").val(e.latlng.lng);
    }
    
  </script>

  <script src="{{url('admin/js/lib/date-picker/bootstrap-datepicker.min.js')}}"></script>

  <script src="{{url('admin/js/lib/date-picker/bootstrap-datepicker.fa.min.js')}}"></script>

  <script>
    $(document).ready(function() {
      $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        format: 'yyyy-mm-dd',
        yearRange:"1300:1400",
      });
    });
  </script>
    
@endsection