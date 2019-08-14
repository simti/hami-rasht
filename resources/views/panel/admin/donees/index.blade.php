@extends('layouts.admin.panel')
@section('page_title')
  <div class="col-md-5 align-self-center">
      <h3 class="text-primary">مدیریت مددجو ها </h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">مددجو ها</li>
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
              <li class="nav-item simti_tab_33"> <a class="nav-link active" data-toggle="tab" href="#donees" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i><br>اشپزخانه ها</span> <span class="hidden-xs-down"> لیست مددجو ها </span></a> </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane  p-20 active" id="donees" role="tabpanel">
                <div class="col-lg-12">
                    <div class="row" style="margin-bottom:40px;">
                        <div class="col-md-6 text-right" style="margin:5px 0;">
                          <div id="example_filter" class="dataTables_filter">
                            <label>
                              <input autocomplete="off" type="text" onChange="donee_term_changed(this)" placeholder="جستجوی مددجو..." aria-controls="example">
                            </label>
                          </div>
                        </div>

                      </div>
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class=" ">ردیف</th>
                                    <th class=" text-center">نام مددجو</th>
                                    <th class=" text-center">کد ملی</th>
                                    <th class=" text-center">حامی ها</th>
                                    <th class=" text-center">  عملیات </th>
                                </tr>
                            </thead>
                            <tbody id="donees-content">
                            </tbody>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 text-center pagination_area" id="donees-pagination">
                        </div>
                    </div>
                    <script>
                        let donees_page = 0;
                        let donees_count = 0;
                        let donees_term = '';
                        // fetch the donees
                        function fetch_donees(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('donees.fetch')}}?page=" + donees_page + "&term=" + donees_term,
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
                                  $('#donees-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let donee = response[i];
                                      content += `
                                        <tr>
                                          <td data-title="ردیف" class="row_col_10"  scope="row" >${i+1}</th>
                                          <td data-title="نام مددجو" class="simti_td_center">${donee.full_name}</td>
                                          <td data-title="کد ملی" class="simti_td_center">${donee.national_id}</td>
                                          <td data-title="حامی ها" class="simti_td_center">`
                                          let arr = [];
                                          Object.values(donee.donors).forEach(function(donor){
                                            arr.push(donor.full_name)
                                          })
                                          content+=`${arr.join(", ")}`
                                          content+=`</td>
                                          <td data-title="عملیات" class="td_btn_custom_width">
                                            <div class="dropdown simti_test">
                                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">عملیات&nbsp;&nbsp;<span class="caret"></span></button>
                                              <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(120px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <li><a href="{{route('donees.edit')}}/${donee.id}">ویرایش</a></li>
                                                <li><a onclick="return confirm(\'آیا اطمینان دارید؟\')" href="{{route("donees.deactivate")}}/${donee.id}">غیرفعال کردن</a></li>
                                              </ul>
                                            </div>
                                          </td>
                                        </tr>
                                      `;
                                  }
                                  $('#donees-content').html(content);
                                }
                            });
                        }

                        // count the donees
                        function pagination_donees(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('donees.count')}}?term=" + donees_term,
                                "method": "GET",
                                "headers": {
                                    "accept": "application/json",
                                    "content-type": "application/json"
                                },
                                "processData": false,
                                "data": ''
                            }
                            $.ajax(settings).done(function (response) {
                                donees_count = response;
                                let last_page = Math.ceil(donees_count/10)-1;
                                let content = '';
                                if(donees_page > 1)
                                    content += '...';
                                for(let i=Math.max(0, donees_page-1); i<=Math.min(donees_page+1, last_page); i++){
                                  if(i==donees_page){
                                    content += ' <button onclick="load_donee('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                  }else{
                                    content += ' <button onclick="load_donee('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                  }
                                }
                                if(donees_page < last_page-1)
                                    content += '...';
                                $('#donees-pagination').html(content);
                            });
                        }
                        function load_donee(page){
                            donees_page = page;
                            fetch_donees();
                            pagination_donees();
                        }
                        $(document).ready(function(){
                            load_donee(0);
                        });

                        function donee_term_changed(e){
                          donees_term = e.value;
                          load_donee(0);
                        }

                        /**
                          action functions
                         */
                        {{--  function remove(donee_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.donees.remove')}}?id=" + donee_id,
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
                              toast_alert("مددجو حذف شد","false")
                            }
                            load_donee(donees_page);
                          });
                        }  --}}
                    </script>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection