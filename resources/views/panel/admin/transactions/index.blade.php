@extends('layouts.admin.panel')
@section('page_title')
  <div class="col-md-5 align-self-center">
      <h3 class="text-primary">مدیریت آشپزخانه ها </h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">آشپزخانه ها</li>
      </ol>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-m-12">
      <div class="card simti_responsive_table_no_padding">
        <div class="card-body p-b-0">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs customtab" role="tablist">
              <li class="nav-item simti_tab_33"> <a class="nav-link active" data-toggle="tab" href="#kitchens" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i><br>اشپزخانه ها</span> <span class="hidden-xs-down"> لیست اشپزخانه ها </span></a> </li>
              <li class="nav-item simti_tab_33"> <a class="nav-link" data-toggle="tab" href="#accept" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i><br>نشده تایید</span> <span class="hidden-xs-down"> در انتظار تایید </span></a> </li>
              <li class="nav-item simti_tab_33"> <a class="nav-link" data-toggle="tab" href="#edit" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i><br>تایید ویرایش</span> <span class="hidden-xs-down"> در انتظار تایید ویرایش</span></a> </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane  p-20 active" id="kitchens" role="tabpanel">
                <div class="col-lg-12">
                    <div class="row" style="margin-bottom:40px;">
                        <div class="col-md-6 text-right" style="margin:5px 0;">
                          <div id="example_filter" class="dataTables_filter">
                            <label>
                              <input autocomplete="off" type="text" onChange="kitchen_term_changed(this)" placeholder="جستجوی آشپزخانه..." aria-controls="example">
                            </label>
                          </div>
                        </div>
                        {{--  <div class="col-md-6 text-left">
                          <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">فیلتر براساس
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(-45px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <li><a onclick="new_food()" href="#">غذای جدید</a></li>
                                <li><a onclick="new_menu()" href="#">منوی جدید</a></li>
                                <li><a onclick="new_include()" href="#">ترکیب جدید</a></li>
                            </ul>
                          </div>
                        </div>  --}}
                      </div>
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class=" ">ردیف</th>
                                    <th class=" text-center">نام آشپزخانه</th>
                                    <th class=" text-center"> کد آشپزخانه </th>
                                    <th class=" text-center"> امتیاز </th>
                                    <th class=" text-center">  عملیات </th>
                                </tr>
                            </thead>
                            <tbody id="kitchens-content">
                            </tbody>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 text-center pagination_area" id="kitchens-pagination">
                        </div>
                    </div>
                    <script>
                        let kitchens_page = 0;
                        let kitchens_count = 0;
                        let kitchens_term = '';
                        // fetch the kitchens
                        function fetch_kitchens(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.kitchens.accepted.fetch')}}?page=" + kitchens_page + "&term=" + kitchens_term,
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
                                    '    <td class="row_col_10" colspan="5"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                                    '</tr>';
                                  $('#kitchens-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let kitchen = response[i];
                                      content += `
                                        <tr>
                                            <td data-title="ردیف" class="row_col_10"  scope="row" >`+ (i+1) +`</th>
                                            <td data-title="نام آشپزخانه" class="simti_td_center">`+ kitchen.title +`</td>
                                            <td data-title="کد آشپزخانه" class="simti_td_center">`+ kitchen.id_str +`</td>
                                            <td data-title="امتیاز" class="simti_td_center">`+ kitchen.score +`</td>
                                            <td data-title="عملیات" class="td_btn_custom_width">
                                                <div class="dropdown simti_test">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">عملیات&nbsp;&nbsp;<span class="caret"></span></button>
                                                    <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(120px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                      `+
                                                        ((kitchen.level == 1)?
                                                        `<li><a onclick="return confirm(\'آیا اطمینان دارید؟\') ?whole_saler(`+kitchen.id+`):\'\'" href="#">ویژه</a></li>`:
                                                        `<li><a onclick="return confirm(\'آیا اطمینان دارید؟\') ?small(`+kitchen.id+`):\'\'" href="#">معمولی</a></li>`)
                                      +`
                                      `+
                                                        ((kitchen.status == 2)?
                                                        `<li><a onclick="return confirm(\'آیا اطمینان دارید؟\') ?inactive(`+kitchen.id+`):\'\'" href="#">مخفی کردن</a></li>`:
                                                        `<li><a onclick="return confirm(\'آیا اطمینان دارید؟\') ?active(`+kitchen.id+`):\'\'" href="#">فعال کردن</a></li>`)
                                      +`
                                      `+
                                                        ((kitchen.is_new == 2)?
                                                        `<li><a onclick="return confirm(\'آیا اطمینان دارید؟\') ?is_new(`+kitchen.id+`):\'\'" href="#">جدید</a></li>`:
                                                        `<li><a onclick="return confirm(\'آیا اطمینان دارید؟\') ?arc_is_new(`+kitchen.id+`):\'\'" href="#">غیرجدید</a></li>`)
                                      +`
                                                        <li><a href="{{route('admin.kitchens.edit')}}/`+kitchen.id+`">ویرایش</a></li>
                                                        <li><a href="{{route('admin.kitchens.show')}}/`+ kitchen.id +`">مشاهده</a></li>
                                                        <li><a onclick="return confirm(\'آیا اطمینان دارید؟\') ?remove(`+kitchen.id+`):\'\'" href="#">حذف</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>`;
                                  }
                                  $('#kitchens-content').html(content);
                                }
                            });
                        }

                        // count the kitchens
                        function pagination_kitchens(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.kitchens.accepted.count')}}?term=" + kitchens_term,
                                "method": "GET",
                                "headers": {
                                    "accept": "application/json",
                                    "content-type": "application/json"
                                },
                                "processData": false,
                                "data": ''
                            }
                            $.ajax(settings).done(function (response) {
                                kitchens_count = response;
                                let last_page = Math.ceil(kitchens_count/10)-1;
                                let content = '';
                                if(kitchens_page > 1)
                                    content += '...';
                                for(let i=Math.max(0, kitchens_page-1); i<=Math.min(kitchens_page+1, last_page); i++){
                                  if(i==kitchens_page){
                                    content += ' <button onclick="load_kitchen('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                  }else{
                                    content += ' <button onclick="load_kitchen('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                  }
                                }
                                if(kitchens_page < last_page-1)
                                    content += '...';
                                $('#kitchens-pagination').html(content);
                            });
                        }
                        function load_kitchen(page){
                            kitchens_page = page;
                            fetch_kitchens();
                            pagination_kitchens();
                        }
                        $(document).ready(function(){
                            load_kitchen(0);
                        });

                        function kitchen_term_changed(e){
                          kitchens_term = e.value;
                          load_kitchen(0);
                        }

                        /**
                          action functions
                         */
                        function whole_saler(kitchen_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.kitchens.wholesaler')}}?id=" + kitchen_id,
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
                              toast_alert("آشپزخانه ویژه شد","false")
                            load_kitchen(kitchens_page);
                          });
                        }
                        function small(kitchen_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.kitchens.small')}}?id=" + kitchen_id,
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
                            toast_alert("آشپزخانه معمولی شد","false")
                            load_kitchen(kitchens_page);
                          });
                        }
                        function inactive(kitchen_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.kitchens.inactive')}}?id=" + kitchen_id,
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
                            toast_alert("آشپزخانه مخفی شد","false")
                            load_kitchen(kitchens_page);
                          });
                        }
                        function active(kitchen_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.kitchens.active')}}?id=" + kitchen_id,
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
                            toast_alert("آشپزخانه فعال شد","false")
                            load_kitchen(kitchens_page);
                          });
                        }
                        function is_new(kitchen_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.kitchens.isnew')}}?id=" + kitchen_id,
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
                            toast_alert("آشپزخانه جدید شد","false")
                              load_kitchen(kitchens_page);
                          });
                        }
                        function arc_is_new(kitchen_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.kitchens.arcisnew')}}?id=" + kitchen_id,
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
                            toast_alert("آشپزخانه غیر جدید شد","false")
                              load_kitchen(kitchens_page);
                          });
                        }
                        function remove(kitchen_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.kitchens.remove')}}?id=" + kitchen_id,
                            "method": "GET",
                            "headers": {
                                "accept": "application/json",
                                "content-type": "application/json"
                            },
                            "processData": false,
                            "data": ''
                          }
                          $.ajax(settings).done(function (response) {
                            if(response == 'done'){
                              toast_alert("آشپزخانه حذف شد","false")
                            }
                            load_kitchen(kitchens_page);
                          });
                        }
                    </script>
                </div>
            </div>
            <div class="tab-pane  p-20" id="accept" role="tabpanel">
                <div class="col-lg-12">
                    <div class="row" style="margin-bottom:40px;">
                        <div class="col-md-6 text-right" style="margin:5px 0;">
                          <div id="example_filter" class="dataTables_filter"><label><input autocomplete="off" type="text" onChange="pending_term_changed(this)" placeholder="جستجوی آشپزخانه..." aria-controls="example"></label></div>
                        </div>
                        {{--  <div class="col-md-6 text-left">
                          <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">فیلتر براساس
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(-45px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <li><a onclick="new_food()" href="#">غذای جدید</a></li>
                                <li><a onclick="new_menu()" href="#">منوی جدید</a></li>
                                <li><a onclick="new_include()" href="#">ترکیب جدید</a></li>
                            </ul>
                          </div>
                        </div>  --}}
                      </div>
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class=" ">ردیف</th>
                                    <th class=" text-center">نام آشپزخانه</th>
                                    <th class=" text-center"> نام </th>
                                    <th class=" text-center"> محله </th>
                                    <th class=" text-center"> جزئیات </th>
                                </tr>
                            </thead>
                            <tbody id="pendings-content">
                            </tbody>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 text-center pagination_area" id="pendings-pagination">
                        </div>
                    </div>
                    <script>
                        let pendings_page = 0;
                        let pendings_count = 0;
                        let pendings_term = '';
                        // fetch the pendings
                        function fetch_pendings(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.kitchens.pending.fetch')}}?page=" + pendings_page + "&term=" + pendings_term,
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
                                    '    <td class="row_col_10" colspan="5"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                                    '</tr>';
                                  $('#pendings-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let pending = response[i];
                                      content +=
                                          '<tr>'+
                                          '    <td data-title="ردیف" class="row_col_10"  scope="row" >'+ (i+1) +'</th>'+
                                          '    <td data-title="نام آشپزخانه" class="simti_td_center">'+ pending.title +'</td>'+
                                          '    <td data-title="نام" class="simti_td_center">'+ pending.user.first_name +' '+ pending.user.last_name +'</td>'+
                                          '    <td data-title="محله" class="simti_td_center">'+ pending.area.title +'</td>'+
                                          '    <td data-title="" class="td_btn_custom_width"><a href="{{route('admin.kitchens.show')}}/'+ pending.id +'"><button type="button" class="btn btn-primary"> مشاهده جزئیات<i class="fa fa-eye"></i> </button></a></td>'+
                                          '</tr>';
                                  }
                                  $('#pendings-content').html(content);
                                }
                            });
                        }

                        // count the pendings
                        function pagination_pendings(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.kitchens.pending.count')}}?term=" + pendings_term,
                                "method": "GET",
                                "headers": {
                                    "accept": "application/json",
                                    "content-type": "application/json"
                                },
                                "processData": false,
                                "data": ''
                            }
                            $.ajax(settings).done(function (response) {
                                pendings_count = response;
                                let last_page = Math.ceil(pendings_count/10)-1;
                                let content = '';
                                if(pendings_page > 1)
                                    content += '...';
                                for(let i=Math.max(0, pendings_page-1); i<=Math.min(pendings_page+1, last_page); i++){
                                  if(i==pendings_page){
                                    content += ' <button onclick="load_pending('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                  }else{
                                    content += ' <button onclick="load_pending('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                  }
                                }
                                if(pendings_page < last_page-1)
                                    content += '...';
                                $('#pendings-pagination').html(content);
                            });
                        }
                        function load_pending(page){
                            pendings_page = page;
                            fetch_pendings();
                            pagination_pendings();
                        }
                        $(document).ready(function(){
                            load_pending(0);
                        });

                        function pending_term_changed(e){
                          pendings_term = e.value;
                          load_pending(0);
                        }
                    </script>
                </div>
            </div>

            <div class="tab-pane  p-20" id="edit" role="tabpanel">
                <div class="col-lg-12">
                    <div class="row" style="margin-bottom:40px;">
                        <div class="col-md-6 text-right" style="margin:5px 0;">
                          <div id="example_filter" class="dataTables_filter"><label><input autocomplete="off" type="text" onChange="edited_term_changed(this)"  placeholder="جستجوی آشپزخانه..." aria-controls="example"></label></div>
                        </div>
                        {{--  <div class="col-md-6 text-left">
                          <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">فیلتر براساس
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(-45px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <li><a onclick="new_food()" href="#">غذای جدید</a></li>
                                <li><a onclick="new_menu()" href="#">منوی جدید</a></li>
                                <li><a onclick="new_include()" href="#">ترکیب جدید</a></li>
                            </ul>
                          </div>
                        </div>  --}}
                      </div>
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class=" ">ردیف</th>
                                    <th class=" text-center">نام آشپزخانه</th>
                                    <th class=" text-center"> نام </th>
                                    <th class=" text-center"> محله </th>
                                    <th class=" text-center"> جزئیات </th>
                                </tr>
                            </thead>
                            <tbody id="edited-content">
                            </tbody>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 text-center pagination_area" id="edited-pagination">
                        </div>
                    </div>
                    <script>
                        let edited_page = 0;
                        let edited_count = 0;
                        let edited_term = '';
                        // fetch the edited
                        function fetch_edited(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.kitchens.edited.fetch')}}?page=" + edited_page + "&term=" + edited_term,
                                "method": "GET",
                                "headers": {
                                    "accept": "application/json",
                                    "content-type": "application/json"
                                },
                                "processData": false,
                                "data": ''
                            }
                            $.ajax(settings).done(function (response) { 
                              console.log(response)
                                let content = '';
                                if(response.length == 0){
                                  content +=
                                    '<tr>'+
                                    '    <td class="row_col_10" colspan="5"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                                    '</tr>';
                                  $('#edited-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let edited = response[i];
                                      content +=
                                          '<tr>'+
                                          '    <td data-title="ردیف" class="row_col_10"  scope="row" >'+ (i+1) +'</th>'+
                                          '    <td data-title="نام آشپزخانه" class="simti_td_center">'+ edited.title +'</td>'+
                                          '    <td data-title="نام" class="simti_td_center">'+ edited.user.first_name + edited.user.last_name +'</td>'+
                                          '    <td data-title="محله" class="simti_td_center">'+ edited.area.title +'</td>'+
                                          '    <td data-title="" class="td_btn_custom_width"><a href="{{route('admin.kitchens.show')}}/'+ edited.id +'"><button type="button" class="btn btn-primary"> مشاهده جزئیات<i class="fa fa-eye"></i> </button></a></td>'+
                                          '</tr>';
                                  }
                                  $('#edited-content').html(content);
                                }
                            });
                        }

                        // count the edited
                        function pagination_edited(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.kitchens.edited.count')}}?term=" + edited_term,
                                "method": "GET",
                                "headers": {
                                    "accept": "application/json",
                                    "content-type": "application/json"
                                },
                                "processData": false,
                                "data": ''
                            }
                            $.ajax(settings).done(function (response) {
                              edited_count = response;
                              let last_page = Math.ceil(edited_count/10)-1;
                              let content = '';
                              if(edited_page > 1)
                                content += '...';
                              for(let i=Math.max(0, edited_page-1); i<=Math.min(edited_page+1, last_page); i++){
                                if(i==edited_page){
                                  content += ' <button onclick="load_edited('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                }else{
                                  content += ' <button onclick="load_edited('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                }
                              }
                              if(edited_page < last_page-1)
                                content += '...';
                              $('#edited-pagination').html(content);
                            });
                        }
                        function load_edited(page){
                            edited_page = page;
                            fetch_edited();
                            pagination_edited();
                        }
                        $(document).ready(function(){
                            load_edited(0);
                        });

                        function edited_term_changed(e){
                          edited_term = e.value;
                          load_edited(0);
                        }
                        
                    </script>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection