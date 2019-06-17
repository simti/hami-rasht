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
    <div class="half text-left" style="width:100%">
      <button type="button" class="btn btn-primary" onclick="open_modal('list')"> چاپ لیست</button>
      <button type="button" class="btn btn-primary" onclick="open_modal('recite')"> صدور فیش</button>
  </div>
</div>
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
                                    <th>ردیف</th>
                                    <th class=" text-center">نام حامی</th>
                                    <th class=" text-center">کد ملی حامی</th>
                                    <th class=" text-center">نام مددجو</th>
                                    <th class=" text-center">کد ملی مددجو</th>
                                    <th class=" text-center">دوره مالی</th>
                                    <th class=" text-center">کمک هزینه</th>
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
                        let transactions_page = 0;
                        let transactions_count = 0;
                        let transactions_term = '';
                        // fetch the donees
                        function fetch_transactions(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('transactions.fetch')}}?page=" + transactions_page + "&term=" + transactions_term,
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
                                    '    <td class="row_col_10" colspan="8"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                                    '</tr>';
                                  $('#donees-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let transaction = response[i];
                                      content += `
                                        <tr>
                                          <td data-title="ردیف" class=""  scope="row" >${i+1}</th>
                                          <td data-title="نام حامی" class="simti_td_center">${transaction.donor.full_name}</td>
                                          <td data-title="کد ملی حامی" class="simti_td_center">${transaction.donor.national_id}</td>
                                          <td data-title="نام مددجو" class="simti_td_center">${transaction.donee.full_name}</td>
                                          <td data-title="کد ملی مددجو" class="simti_td_center">${transaction.donee.national_id}</td>
                                          <td data-title="دوره مالی" class="simti_td_center">${transaction.period.title}</td>
                                          <td data-title="کمک هزینه" class="simti_td_center">${transaction.type==1?transaction.money_amount:transaction.non_money_detail}</td>
                                          <td data-title="عملیات" class="td_btn_custom_width">
                                            <div class="dropdown simti_test">
                                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">عملیات&nbsp;&nbsp;<span class="caret"></span></button>
                                              <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(120px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <li><a href="{{route('transactions.edit')}}/${transaction.id}">ویرایش</a></li>
                                                <li><a onclick="return confirm(\'آیا اطمینان دارید؟\') ?remove(${transaction.id}):\'\'" href="#">حذف</a></li>
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
                                "url": "{{route('transactions.count')}}?term=" + transactions_term,
                                "method": "GET",
                                "headers": {
                                    "accept": "application/json",
                                    "content-type": "application/json"
                                },
                                "processData": false,
                                "data": ''
                            }
                            $.ajax(settings).done(function (response) {
                                transactions_count = response;
                                let last_page = Math.ceil(transactions_count/10)-1;
                                let content = '';
                                if(transactions_page > 1)
                                    content += '...';
                                for(let i=Math.max(0, transactions_page-1); i<=Math.min(transactions_page+1, last_page); i++){
                                  if(i==transactions_page){
                                    content += ' <button onclick="load_donee('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                  }else{
                                    content += ' <button onclick="load_donee('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                  }
                                }
                                if(transactions_page < last_page-1)
                                    content += '...';
                                $('#donees-pagination').html(content);
                            });
                        }
                        function load_donee(page){
                            transactions_page = page;
                            fetch_transactions();
                            pagination_donees();
                        }
                        $(document).ready(function(){
                            load_donee(0);
                        });

                        function donee_term_changed(e){
                          transactions_term = e.value;
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
                            load_donee(transactions_page);
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
@section('custom_modal')
  <script>
      let donor,donee,period,money,non_money,donation_type,report_type;
      function open_modal(type){
        report_type = type;
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
      function print_list(){
        let period_id = $("#select-period").val();
        if(report_type=="list")
          window.open(`{{route('reports.prints.transactions')}}?period=${period_id}`,'_blank')
        else
          window.open(`{{route('reports.prints.recites')}}?period=${period_id}`,'_blank')
      }
  </script>
  <div  class="simti_overlay"></div>
  <div id="new_simti_modal" class="simti_modal visible">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">انتخاب دوره </label>
              <select class="form-control" id="select-period">
                  <option value="0"> همه</option> 
                @foreach (App\Period::all() as $period)
                  <option value="{{$period->id}}"> {{$period->title}}</option>    
                @endforeach
              </select>
            </div>
          </div>
    </div>
    <button class="btn btn-primary modal-submit" onclick="print_list()">تایید</button>
    <button class="btn btn-primary modal-submit" onclick="close_modal()">بازگشت</button>
  </div>

@endsection