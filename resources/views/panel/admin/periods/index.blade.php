@extends('layouts.admin.panel')
@section('page_title')
  <div class="col-md-5 align-self-center">
      <h3 class="text-primary">مدیریت دوره های مالی </h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active"> های دوره مالی </li>
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
              <li class="nav-item simti_tab_33"> <a class="nav-link active" data-toggle="tab" href="#periods" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i><br>اشپزخانه ها</span> <span class="hidden-xs-down"> لیست دوره های مالی  </span></a> </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane  p-20 active" id="periods" role="tabpanel">
                <div class="col-lg-12">
                    <div class="row" style="margin-bottom:40px;">
                        <div class="col-md-6 text-right" style="margin:5px 0;">
                          <div id="example_filter" class="dataTables_filter">
                            <label>
                              <input autocomplete="off" type="text" onChange="period_term_changed(this)" placeholder="جستجوی دوره مالی..." aria-controls="example">
                            </label>
                          </div>
                        </div>

                      </div>
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class=" ">ردیف</th>
                                    <th>نام دوره مالی</th>
                                </tr>
                            </thead>
                            <tbody id="periods-content">
                            </tbody>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 text-center pagination_area" id="periods-pagination">
                        </div>
                    </div>
                    <script>
                        let periods_page = 0;
                        let periods_count = 0;
                        let periods_term = '';
                        // fetch the periods
                        function fetch_periods(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('periods.fetch')}}?page=" + periods_page + "&term=" + periods_term,
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
                                  $('#periods-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let period = response[i];
                                      content += `
                                        <tr>
                                          <td data-title="ردیف" class="row_col_10"  scope="row" >${i+1}</th>
                                          <td data-title="نام دوره مالی">${period.title}</td>
                                        </tr>
                                      `;
                                  }
                                  $('#periods-content').html(content);
                                }
                            });
                        }

                        // count the periods
                        function pagination_periods(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('periods.count')}}?term=" + periods_term,
                                "method": "GET",
                                "headers": {
                                    "accept": "application/json",
                                    "content-type": "application/json"
                                },
                                "processData": false,
                                "data": ''
                            }
                            $.ajax(settings).done(function (response) {
                                periods_count = response;
                                let last_page = Math.ceil(periods_count/10)-1;
                                let content = '';
                                if(periods_page > 1)
                                    content += '...';
                                for(let i=Math.max(0, periods_page-1); i<=Math.min(periods_page+1, last_page); i++){
                                  if(i==periods_page){
                                    content += ' <button onclick="load_period('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                  }else{
                                    content += ' <button onclick="load_period('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                  }
                                }
                                if(periods_page < last_page-1)
                                    content += '...';
                                $('#periods-pagination').html(content);
                            });
                        }
                        function load_period(page){
                            periods_page = page;
                            fetch_periods();
                            pagination_periods();
                        }
                        $(document).ready(function(){
                            load_period(0);
                        });

                        function period_term_changed(e){
                          periods_term = e.value;
                          load_period(0);
                        }

                        /**
                          action functions
                         */
                        {{--  function remove(period_id){
                          var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "{{route('admin.periods.remove')}}?id=" + period_id,
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
                              toast_alert("دوره مالی حذف شد","false")
                            }
                            load_period(periods_page);
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