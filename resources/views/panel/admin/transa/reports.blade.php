@extends('layouts.admin.panel')
@section('page_title')
  <div class="col-md-5 align-self-center">
      <h3 class="text-primary">تراکنش‌ها </h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">تراکنش ها</li>
      </ol>
  </div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12 col-m-12">
    <div class="card simti_responsive_table_no_padding">
      <div class="card-body p-b-0">
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table table-striped ">
              <thead>
                <tr>
                  <th class=" ">آشپزخانه</th>
                  <th class=" ">درآمد روزاخیر</th>
                  <th class=" ">تعداد فروش</th>
                  <th class=" ">تعداد مانده</th>
                  <th class=" ">هزینه ظروف مصرفی</th>
                  <th class=" ">مقدار طلب از فودی</th>
                  <th class=" ">عملیات</th>
                </tr>
              </thead>
              <tbody id="orders-reports-content">
              </tbody>
            </table>
          </div> 
          <div class="row">
            <div class="col-md-12 text-center pagination_area" id="orders-reports-pagination">
                <button onclick="load_reports(1)" type="button" class="btn btn-primary pagination-btn">1</button>
            </div>
          </div>
          <script>
              let reports_page = 0;
              let reports_count = 0;
              let reports_term = '';

              function make_withdraw(user_id, amount){
                if(confirm(`آیا مطمئن هستید که ${amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال  برای این کاربر واریز کرده اید؟`)){
                  var settings = {
                      "async": true,
                      "crossDomain": true,
                      "url": "{{route('admin.transactions.reports.make_withdraw')}}/" + user_id,
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
                        toast_alert('تراکنش تسویه‌حساب ثبت شد', true);
                        load_reports(0);
                      }else
                        toast_alert('ثبت تراکنش تسویه‌حساب با خطا مواجه شد', false)
                  });
                }
              }
              // fetch the reports
              function fetch_reports(){
                  var settings = {
                      "async": true,
                      "crossDomain": true,
                      "url": "{{route('admin.transactions.reports.fetch')}}?page=" + reports_page + "&term=" + reports_term,
                      "method": "GET",
                      "headers": {
                          "accept": "application/json",
                          "content-type": "application/json"
                      },
                      "processData": false,
                      "data": ''
                  }
                  $.ajax(settings).done(function (response) {
                    console.log(response);
                      let content = '';
                      if(response.length == 0){
                        content +=
                          '<tr>'+
                          '    <td class="row_col_10" colspan="7"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                          '</tr>';
                        $('#orders-reports-content').html(content);
                      }else{
                        for(let i=0; i<response.length; i++){
                            let report = response[i];
                            content +=`
                            <tr>
                              <td data-title="آشپزخانه" class="row_col_10"  scope="row">${report.kitchen.title}</td>
                              <td data-title="درآمد روزاخیر" class="row_col_10"  scope="row">${(report.sold_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال</td>
                              <td data-title="تعداد فروش" class="row_col_10"  scope="row">${report.sold_count}</td>
                              <td data-title="تعداد مانده" class="row_col_10"  scope="row">${report.remain_count}</td>
                              <td data-title="هزینه ظروف مصرفی" class="row_col_10"  scope="row">${(report.circ_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال</td>
                              <td data-title="موجودی مانده" class="row_col_10"  scope="row">${(report.remain_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال</td>
                              <td data-title="عملیات" class="row_col_10">
                                <div class="dropdown simti_test">
                                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">عملیات&nbsp;&nbsp;<span class="caret"></span></button>
                                  <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(120px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    ${report.bank_account_id != 0? `<li><a href="{{route('admin.bank_accounts.show')}}/${report.bank_account_id}">مشاهده حساب بانکی</a></li>`: `<li><a href="{{route('admin.bank_accounts.create')}}">ساخت حساب بانکی</a></li>`}
                                    <li><a href="#" onclick="make_withdraw(${report.id}, ${report.remain_amount})">ثبت تسویه حساب</a></li>
                                  </ul>
                                </div>
                              </td>
                            </tr>
                            `;
                        }
                        console.log(response)
                        $('#orders-reports-content').html(content);
                      }
                  });
              }

              // count the reports
              function pagination_reports(){
                  var settings = {
                      "async": true,
                      "crossDomain": true,
                      "url": "{{route('admin.transactions.reports.count')}}?term=" + reports_term,
                      "method": "GET",
                      "headers": {
                          "accept": "application/json",
                          "content-type": "application/json"
                      },
                      "processData": false,
                      "data": ''
                  }
                  $.ajax(settings).done(function (response) {
                      reports_count = response;
                      let last_page = Math.ceil(reports_count/10)-1;
                      let content = '';
                      if(reports_page > 1)
                          content += '...';
                      for(let i=Math.max(0, reports_page-1); i<=Math.min(reports_page+1, last_page); i++){
                        if(i==reports_page){
                          content += ' <button onclick="load_reports('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                        }else{
                          content += ' <button onclick="load_reports('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                        }
                      }
                      if(reports_page < last_page-1)
                          content += '...';
                      $('#orders-reports-pagination').html(content);
                  });
              }
              function load_reports(page){
                  reports_page = page;
                  fetch_reports();
                  pagination_reports();
              }
              $(document).ready(function(){
                  load_reports(0);
              });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection