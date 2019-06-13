@extends('layouts.admin.panel')
@section('page_title')
  <div class="col-md-5 align-self-center">
      <h3 class="text-primary">داشبورد</h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">داشبورد</li>
      </ol>
  </div>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="card p-30">
        <div class="media">
          <div class="media-left meida media-middle">
            <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
          </div>
          <div class="media-body media-text-right">
            <h2>{{currency_to_per(20)}} نفر</h2>
            <p class="m-b-0">حامی ها</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-30">
        <div class="media">
          <div class="media-left meida media-middle">
            <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
          </div>
          <div class="media-body media-text-right">
            <h2>{{eng_to_per(10)}} نفر</h2>
            <p class="m-b-0">مددجو ها</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-30">
        <div class="media">
          <div class="media-left meida media-middle">
            <span><i class="fa fa-home f-s-40 color-warning"></i></span>
          </div>
          <div class="media-body media-text-right">
            <h2>{{eng_to_per(5)}} عدد</h2>
            <p class="m-b-0">آشپزخانه ها</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-30">
        <div class="media">
          <div class="media-left meida media-middle">
            <span><i class="fa fa-user f-s-40 color-danger"></i></span>
          </div>
          <div class="media-body media-text-right">
            <h2>{{eng_to_per(4)}} نفر</h2>
            <p class="m-b-0">مشتری ها</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-30">
        <div class="media">
          <div class="media-left meida media-middle">
            <span><i class="fa fa-usd f-s-40 color-info"></i></span>
          </div>
          <div class="media-body media-text-right">
            <h2>{{eng_to_per(3)}} ریال</h2>
            <p class="m-b-0">درآمد نذری امروز</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-30">
        <div class="media">
          <div class="media-left meida media-middle">
            <span><i class="fa fa-gratipay f-s-40 color-success"></i></span>
          </div>
          <div class="media-body media-text-right">
            <h2>{{eng_to_per(2)}} عدد</h2>
            <p class="m-b-0">نذری‌های امروز</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-30">
        <div class="media">
          <div class="media-left meida media-middle">
            <span><i class="fa fa-edit f-s-40 color-primary"></i></span>
          </div>
          <div class="media-body media-text-right">
            <h2>{{eng_to_per(8)}} نفر</h2>
            <p class="m-b-0">ثبت نام‌های امروز</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-30">
        <div class="media">
          <div class="media-left meida media-middle">
            <span><i class="fa fa-handshake-o f-s-40 color-warning"></i></span>
          </div>
          <div class="media-body media-text-right">
            <h2>{{eng_to_per(6)}} نفر</h2>
            <p class="m-b-0">درخواست‌های همکاری امروز</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="card simti_responsive_table_no_padding" style="padding:5px !important">
              <div class="card-body p-b-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link active show" data-toggle="tab" href="#normal_order" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-home"></i>  --}}
                        <br>  معمولی
                      </span>
                      <span class="hidden-xs-down"> سفارش معمولی </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link show" data-toggle="tab" href="#activeOrder" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-home"></i>  --}}
                        <br>پیش سفارش
                      </span>
                      <span class="hidden-xs-down">پیش سفارش </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link" data-toggle="tab" href="#receiveOrder" role="tab" aria-selected="false">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-user"></i>  --}}
                        <br>نذری
                      </span>
                      <span class="hidden-xs-down"> نذری</span>
                    </a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane p-20 active show" id="normal_order" role="tabpanel">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size:14px !important" >
                          <thead>
                            <tr>
                              <th># سفارش</th>
                              <th>زمان تحویل</th>
                              <th>وضعیت</th>
                              <th>جزئیات</th>
                            </tr>
                          </thead>
                          <tbody id="active-orders-content">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane p-20 show" id="activeOrder" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th># سفارش</th>
                                    <th>زمان تحویل</th>
                                    <th>وضعیت</th>
                                    <th>جزئیات</th>
                                  </tr>
                                </thead>
                                <tbody id="active-pre_order-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                  <div class="tab-pane p-20" id="receiveOrder" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th># سفارش</th>
                                    <th>زمان تحویل</th>
                                    <th>وضعیت</th>
                                    <th>جزئیات</th>
                                  </tr>
                                </thead>
                                <tbody id="active-recite-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-12">
          <div class="card simti_responsive_table_no_padding" style="padding:5px !important">
              <div class="card-body p-b-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link active show" data-toggle="tab" href="#pending_kitchen" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-home"></i>  --}}
                        <br>  در انتظار تایید
                      </span>
                      <span class="hidden-xs-down"> در انتظار تایید  </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link show" data-toggle="tab" href="#edit_pending_kitchen" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-home"></i>  --}}
                        <br>در انتظار ویرایش 
                      </span>
                      <span class="hidden-xs-down">در انتظار ویرایش  </span>
                    </a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane p-20 active show" id="pending_kitchen" role="tabpanel">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size:14px !important">
                          <thead>
                            <tr>
                              <th>نام آشپزخانه </th>
                              <th>محله</th>
                              <th>جزئیات</th>
                            </tr>
                          </thead>
                          <tbody id="pending_kitchens-content">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane p-20 show" id="edit_pending_kitchen" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th>نام آشپزخانه </th>
                                    <th>محله</th>
                                    <th>جزئیات</th>
                                  </tr>
                                </thead>
                                <tbody id="edited_pending_kitchens-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="card simti_responsive_table_no_padding" style="padding:5px !important">
              <div class="card-body p-b-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link active show" data-toggle="tab" href="#suggested_food" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-home"></i>  --}}
                        <br>  پیشنهاد غذا
                      </span>
                      <span class="hidden-xs-down"> پیشنهاد غذا </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link show" data-toggle="tab" href="#suggested_menu" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-home"></i>  --}}
                        <br>پیشنهاد منو
                      </span>
                      <span class="hidden-xs-down">پیشنهاد منو </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link" data-toggle="tab" href="#suggested_include" role="tab" aria-selected="false">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-user"></i>  --}}
                        <br>پیشنهاد ترکیبات
                      </span>
                      <span class="hidden-xs-down"> پیشنهاد ترکیبات</span>
                    </a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane p-20 active show" id="suggested_food" role="tabpanel">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size:14px !important">
                          <thead>
                            <tr>
                              <th>نام</th>
                              <th>تایید/لغو</th>
                            </tr>
                          </thead>
                          <tbody id="suggested_food-content">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane p-20 show" id="suggested_menu" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th>نام</th>
                                    <th>تایید/لغو</th>
                                  </tr>
                                </thead>
                                <tbody id="suggested_menu-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                  <div class="tab-pane p-20" id="suggested_include" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th>نام</th>
                                    <th>تایید/لغو</th>
                                  </tr>
                                </thead>
                                <tbody id="suggested_include-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-12">
          <div class="card simti_responsive_table_no_padding" style="padding:5px !important">
              <div class="card-body p-b-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link active show" data-toggle="tab" href="#pending_cm" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        {{--  <i class="ti-home"></i>  --}}
                        <br>  معمولی
                      </span>
                      <span class="hidden-xs-down">  نظرات </span>
                    </a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane p-20 active show" id="pending_cm" role="tabpanel">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size:14px !important">
                          <thead>
                            <tr>
                              <th>کاربر </th>
                              <th>نظر</th>
                              <th style="text-align:center">تایید / رد</th>
                            </tr>
                          </thead>
                          <tbody id="cm-content">
                          </tbody>
                        </table>
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
  <script>
    function toTimeFormat(seconds) {
      const date = new Date(seconds * 1000);
      const hh = date.getUTCHours();
      const mm = date.getUTCMinutes();
      const ss = ("0" + date.getUTCSeconds()).slice(-2);
      if (hh) {
        return `${hh}:${("0" + mm).slice(-2)}:${ss}`;
      }
      return `${mm}:${ss}`;
    }
    function fetch_normal_orders(){
      var settings = {
          "async": true,
          "crossDomain": true,
          "url": "{{route('admin.orders.active.dashboard_fetch')}}?type={{App\Order::NORMAL}}",
          "method": "GET",
          "headers": {
              "accept": "application/json",
              "content-type": "application/json"
          },
          "processData": false,
          "data": ''
      }
      $.ajax(settings).done(function (response) {
          let content = '';
          if(response.length == 0){
            content +=
              '<tr>'+
              '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" >سفارش فعال جدیدی وجود ندارد</th>'+
              '</tr>';
            $('#active-orders-content').html(content);
          }else{
            
            for(let i=0; i<response.length; i++){
              let order = response[i];
              let difference = order.serve_time - (parseInt(new Date().getTime()/1000))
              let splitted = toTimeFormat(difference).split(":")
             
              content +=`
                <tr>
                  <td data-title="# سفارش">${order.id_str}</td>
                  <td data-title="زمان تحویل "><span>${difference<=0?'<span style="color:red">گذشته</span>':splitted.length ==2? splitted[0]+":"+splitted[1]:"00:"+splitted[0]}</span></td>
                  <td data-title="وضعیت "><span>${order.status_str}</span></td>
                  <td><span><a href="{{route('admin.orders.show')}}/${order.id}"><button id="status_btn" class="btn btn-primary btn-primary-transparent" >مشاهده</button></a></span></td>
                </tr>
              `;
            }
            $('#active-orders-content').html(content);
            $("#active-orders-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.orders.index')}}">مشاهده همه ></a></p>`)
          }
      });
    }
    function fetch_pre_orders(){
      var settings = {
          "async": true,
          "crossDomain": true,
          "url": "{{route('admin.orders.active.dashboard_fetch')}}?type={{App\Order::DEMAND}}",
          "method": "GET",
          "headers": {
              "accept": "application/json",
              "content-type": "application/json"
          },
          "processData": false,
          "data": ''
      }
      $.ajax(settings).done(function (response) {
          let content = '';
          if(response.length == 0){
            content +=
              '<tr>'+
              '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" >سفارش فعال جدیدی وجود ندارد</th>'+
              '</tr>';
            $('#active-pre_order-content').html(content);
          }else{
            
            for(let i=0; i<response.length; i++){
              let order = response[i];
              let difference = order.serve_time - (parseInt(new Date().getTime()/1000))
              let splitted = toTimeFormat(difference).split(":")
             
              content +=`
                <tr>
                  <td data-title="# سفارش">${order.id_str}</td>
                  <td data-title="زمان تحویل "><span>${difference<=0?'<span style="color:red">گذشته</span>':splitted.length ==2? splitted[0]+":"+splitted[1]:"00:"+splitted[0]}</span></td>
                  <td data-title="وضعیت "><span>${order.status_str}</span></td>
                  <td><span><a href="{{route('admin.orders.show')}}/${order.id}"><button id="status_btn" class="btn btn-primary btn-primary-transparent" >مشاهده</button></a></span></td>
                </tr>
              `;
            }
            $('#active-pre_order-content').html(content);
            $("#active-pre_order-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.orders.index')}}">مشاهده همه ></a></p>`)
          }
      });
    }
    function fetch_recite_orders(){
      var settings = {
          "async": true,
          "crossDomain": true,
          "url": "{{route('admin.orders.active.dashboard_fetch')}}?type={{App\Order::RECITE}}",
          "method": "GET",
          "headers": {
              "accept": "application/json",
              "content-type": "application/json"
          },
          "processData": false,
          "data": ''
      }
      $.ajax(settings).done(function (response) {
          let content = '';
          if(response.length == 0){
            content +=
              '<tr>'+
              '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" >سفارش فعال جدیدی وجود ندارد</th>'+
              '</tr>';
            $('#active-recite-content').html(content);
          }else{
            
            for(let i=0; i<response.length; i++){
              let order = response[i];
              let difference = order.serve_time - (parseInt(new Date().getTime()/1000))
              let splitted = toTimeFormat(difference).split(":")
             
              content +=`
                <tr>
                  <td data-title="# سفارش">${order.id_str}</td>
                  <td data-title="زمان تحویل "><span>${difference<=0?'<span style="color:red">گذشته</span>':splitted.length ==2? splitted[0]+":"+splitted[1]:"00:"+splitted[0]}</span></td>
                  <td data-title="وضعیت "><span>${order.status_str}</span></td>
                  <td><span><a href="{{route('admin.orders.show')}}/${order.id}"><button id="status_btn" class="btn btn-primary btn-primary-transparent" >مشاهده</button></a></span></td>
                </tr>
              `;
            }
            $('#active-recite-content').html(content);
            $("#active-recite-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.orders.index')}}">مشاهده همه ></a></p>`)
          }
      });
    }
    function fetch_pending_kitchens(){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.kitchens.pending.dashboard_fetch')}}",
        "method": "GET",
        "headers": {
          "accept": "application/json",
          "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }

      $.ajax(settings).done(function (response) {
        let content = '';
        if(response.length == 0){
          content +=
            '<tr>'+
            '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" > درخواست جدیدی وجود ندارد</th>'+
            '</tr>';
          $('#pending_kitchens-content').html(content);
        }else{
          
          for(let i=0; i<response.length; i++){
            let pending = response[i];
           
            content +=`
              <tr>
                <td data-title="نام آشپزخانه">${pending.title}</td>
                <td data-title="محله"><span>${pending.area.title}</span></td>
                <td><span><a href="{{route('admin.kitchens.show')}}/${pending.id}"><button id="status_btn" class="btn btn-primary btn-primary-transparent" >مشاهده</button></a></span></td>
              </tr>
            `;
          }
          $('#pending_kitchens-content').html(content);
          $("#pending_kitchens-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.kitchens.index')}}">مشاهده همه ></a></p>`)
        }
      });


    }
    function fetch_edited_kitchens(){

      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.kitchens.edited.dashboard_fetch')}}",
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }

      $.ajax(settings).done(function (response) {
        let content = '';
        if(response.length == 0){
          content +=
            '<tr>'+
            '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" > درخواست جدیدی وجود ندارد</th>'+
            '</tr>';
          $('#edited_pending_kitchens-content').html(content);
        }else{
          
          for(let i=0; i<response.length; i++){
            let edited = response[i]
            content +=`
              <tr>
                <td data-title="نام آشپزخانه">${edited.title}</td>
                <td data-title="محله"><span>${edited.area.title}</span></td>
                <td><span><a href="{{route('admin.kitchens.show')}}/${edited.id}"><button id="status_btn" class="btn btn-primary btn-primary-transparent" >مشاهده</button></a></span></td>
              </tr>
            `;
          }
          $('#edited_pending_kitchens-content').html(content);
          $("#edited_pending_kitchens-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.kitchens.index')}}">مشاهده همه ></a></p>`)
        }
      });
    }
    function fetch_food_suggestions(){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.kinds.dashboard_fetch')}}",
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      } 
      $.ajax(settings).done(function (response) {
        let content = '';
        if(response.length == 0){
          content +=
            '<tr>'+
            '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" > پیشنهاد جدیدی وجود ندارد</th>'+
            '</tr>';
          $('#suggested_food-content').html(content);
        }else{
          for(let i=0; i<response.length; i++){
            let tag = response[i]
            content +=`
              <tr>
                <td data-title="نام غذا">${tag.title}</td>
                <td data-title="تایید/لغو" class="td_btn_custom_width">
                  <button type="button" class="btn btn-primary btn-primary-transparent btn-sm" onclick="accept_kind(`+ tag.id +`)"><i class="fa fa-check"></i></button>
                  <button type="button" class="btn btn-primary btn-primary-transparent btn-sm" onclick="refuse_kind(`+tag.id+`)"><i class="fa fa-times"></i></button>
                </td>
              </tr>
            `;
          }
          $('#suggested_food-content').html(content);
          $("#suggested_food-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.suggests.index')}}">مشاهده همه ></a></p>`)
        }
      });
    }
    function fetch_menu_suggestions(){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.menues.dashboard_fetch')}}",
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      } 
      $.ajax(settings).done(function (response) {
        let content = '';
        if(response.length == 0){
          content +=
            '<tr>'+
            '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" > پیشنهاد جدیدی وجود ندارد</th>'+
            '</tr>';
          $('#suggested_menu-content').html(content);
        }else{
          for(let i=0; i<response.length; i++){
            let tag = response[i]
            content +=`
              <tr>
                <td data-title="نام غذا">${tag.title}</td>
                <td data-title="تایید/لغو" class="td_btn_custom_width">
                  <button type="button" class="btn btn-primary btn-primary-transparent btn-sm" onclick="accept_menue(`+ tag.id +`)"><i class="fa fa-check"></i></button>
                  <button type="button" class="btn btn-primary btn-primary-transparent btn-sm" onclick="refuse_menue(`+tag.id+`)"><i class="fa fa-times"></i></button>
                </td>
              </tr>
            `;
          }
          $('#suggested_menu-content').html(content);
          $("#suggested_menu-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.suggests.index')}}">مشاهده همه ></a></p>`)
        }
      });
    }
    function fetch_include_suggestions(){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.includes.dashboard_fetch')}}",
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      } 
      $.ajax(settings).done(function (response) {
        let content = '';
        if(response.length == 0){
          content +=
            '<tr>'+
            '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" > پیشنهاد جدیدی وجود ندارد</th>'+
            '</tr>';
          $('#suggested_include-content').html(content);
        }else{
          for(let i=0; i<response.length; i++){
            let tag = response[i]
            content +=`
              <tr>
                <td data-title="نام غذا">${tag.title}</td>
                <td data-title="تایید/لغو" class="td_btn_custom_width">
                  <button type="button" class="btn btn-primary btn-primary-transparent btn-sm" onclick="accept_include(`+ tag.id +`)"><i class="fa fa-check"></i></button>
                  <button type="button" class="btn btn-primary btn-primary-transparent btn-sm" onclick="refuse_include(`+tag.id+`)"><i class="fa fa-times"></i></button>
                </td>
              </tr>
            `;
          }
          $('#suggested_include-content').html(content);
          $("#suggested_include-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.suggests.index')}}">مشاهده همه ></a></p>`)
        }
      });
    }
    function fetch_comments(){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.comments.pending.dashboard_fetch')}}",
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }
      $.ajax(settings).done(function (response) {
        let content = '';
        if(response.length == 0){
          content +=
            '<tr>'+
            '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" > نظر جدیدی وجود ندارد</th>'+
            '</tr>';
          $('#cm-content').html(content);
        }else{
          for(let i=0; i<response.length; i++){
            let comment = response[i]
            content +=`
              <tr>
                <td data-title="کاربر">${comment.user.full_name}</td>
                <td data-title="نظر">${comment.comment}</td>
                <td data-title="تایید / رد" class="td_btn_custom_width">
                  <button type="button" class="btn btn-primary btn-primary-transparent btn-sm" onclick="accept_comment(`+ comment.id +`)"><i class="fa fa-check"></i></button>
                  <button type="button" class="btn btn-primary btn-primary-transparent btn-sm" onclick="refuse_comment(`+comment.id+`)"><i class="fa fa-times"></i></button>
                </td>
              </tr>
            `;
          }
          $('#cm-content').html(content);
          $("#cm-content").parent().parent().append(`<p style="padding: 40px 0px 0 0px;text-align: center;"><a style="color:#5c4ac7" href="{{route('admin.comments.list')}}">مشاهده همه ></a></p>`)
        }
      });

    }
    function accept_kind(id){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.accept')}}?id=" + id,
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }
      $.ajax(settings).done(function (response) {
        if(response == 'done')
          toast_alert("پیشنهاد غذا ثبت شد","false")
          fetch_food_suggestions() 
      });
    }
    function refuse_kind(id){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.refuse')}}?id=" + id,
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }
      $.ajax(settings).done(function (response) {
        if(response == 'done')
          toast_alert("پیشنهاد غذا رد شد","true")
          fetch_food_suggestions() 
      });
    }
    function accept_includes(id){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.accept')}}?id=" + id,
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }
      $.ajax(settings).done(function (response) {
        if(response == 'done')
          toast_alert("پیشنهاد ترکیب ثبت شد","false")
          fetch_include_suggestions() 
      });
    }
    function refuse_includes(id){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.refuse')}}?id=" + id,
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }
      $.ajax(settings).done(function (response) {
        if(response == 'done')
          toast_alert("پیشنهاد ترکیب رد شد","true")
          fetch_include_suggestions() 
      });
    }
    function accept_menue(id){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.accept')}}?id=" + id,
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }
      $.ajax(settings).done(function (response) {
        if(response == 'done')
          toast_alert("پیشنهاد منو ثبت شد","false")
          fetch_menu_suggestions()  
      });
    }
    function refuse_menue(id){
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('admin.suggests.refuse')}}?id=" + id,
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "content-type": "application/json"
        },
        "processData": false,
        "data": ''
      }
      $.ajax(settings).done(function (response) {
        if(response == 'done')
          toast_alert("پیشنهاد منو رد شد","true")
          fetch_menu_suggestions() 
      });
    }
    function accept_comment(rate_id){
      var settings = {
          "async": true,
          "crossDomain": true,
          "url": "{{route('admin.comments.accept')}}?rate_id=" + rate_id,
          "method": "GET",
          "headers": {
              "accept": "application/json",
              "content-type": "application/json"
          },
          "processData": false,
          "data": ''
      }
      $.ajax(settings).done(function (response) {
        if(response == 'done!'){
          toast_alert("نظر کاربر تایید شد","false");
          fetch_comments()
        }else{;
        }
      });
    }
    function refuse_comment(rate_id){
      var settings = {
          "async": true,
          "crossDomain": true,
          "url": "{{route('admin.comments.refuse')}}?rate_id=" + rate_id,
          "method": "GET",
          "headers": {
              "accept": "application/json",
              "content-type": "application/json"
          },
          "processData": false,
          "data": ''
      }
      $.ajax(settings).done(function (response) {
        if(response == 'done!'){
          toast_alert("نظر کاربر رد شد","true");
          fetch_comments();
        }else{
        }
      });
    }


    $(document).ready(function(){
      fetch_normal_orders();
      fetch_pre_orders();
      fetch_recite_orders();
      fetch_pending_kitchens();
      fetch_edited_kitchens();
      fetch_food_suggestions();
      fetch_menu_suggestions();
      fetch_include_suggestions();
      fetch_comments();
    });
  </script>
@endsection

 