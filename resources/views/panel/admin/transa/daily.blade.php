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
  <div class="col-md-3">
    <div class="card bg-primary p-20">
      <div class="media widget-ten">
        <div class="media-left meida media-middle">
          <span><i class="ti-bar-chart f-s-40"></i></span>
        </div>
        <div class="media-body media-text-right">
          <h2 class="color-white">{{currency_to_per(\App\Transaction::Today()->Paid()->sum('amount'))}} ریال</h2>
          <p class="m-b-0">درآمد کل </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-pink p-20">
      <div class="media widget-ten">
        <div class="media-left meida media-middle">
          <span><i class="ti-shopping-cart f-s-40"></i></span>
        </div>
        <div class="media-body media-text-right">
          <h2 class="color-white">{{eng_to_per(\App\Transaction::Today()->Paid()->count())}} عدد</h2>
          <p class="m-b-0">تعداد کل تراکنش ها </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-success p-20">
      <div class="media widget-ten">
        <div class="media-left meida media-middle">
          <span><i class="ti-money f-s-40"></i></span>
        </div>
        <div class="media-body media-text-right">
          <h2 class="color-white">{{currency_to_per(\App\Transaction::Today()->Paid()->sum('foody_amount'))}} ریال</h2>
          <p class="m-b-0">سهم فودی </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-danger p-20">
      <div class="media widget-ten">
        <div class="media-left meida media-middle">
          <span><i class="ti-money f-s-40"></i></span>
        </div>
        <div class="media-body media-text-right">
            <h2 class="color-white">{{currency_to_per(\App\Transaction::Today()->Paid()->AboutOrder()->sum('dst_amount'))}} ریال</h2>
            <p class="m-b-0">سهم آشپزخانه‌ها </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-m-12">
      <div class="card simti_responsive_table_no_padding">
        <div class="card-body p-b-0">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item simti_tab_50"> <a class="nav-link active" data-toggle="tab" href="#orders" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i><br>سفارشات</span> <span class="hidden-xs-down">سفارشات</span></a> </li>
            <li class="nav-item simti_tab_50"> <a class="nav-link" data-toggle="tab" href="#charges" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i><br>شارژحساب ها</span> <span class="hidden-xs-down">شارژحساب ها</span></a> </li>
            <li class="nav-item simti_tab_50"> <a class="nav-link" data-toggle="tab" href="#withdraws" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i><br>بازگشت وجه‌ها</span> <span class="hidden-xs-down">بازگشت وجه‌ها</span></a> </li>
            <li class="nav-item simti_tab_50"> <a class="nav-link" data-toggle="tab" href="#free" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i><br>تراکنش ادمین</span> <span class="hidden-xs-down">تراکنش ادمین</span></a> </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane  p-20 active" id="orders" role="tabpanel">
              <div class="col-lg-12">
                  <div class="table-responsive">
                    <table class="table table-striped ">
                      <thead>
                        <tr>
                          <th class=" ">تاریخ</th>
                          <th class=" ">مقدار</th>
                          <th class=" ">نام مشتری</th>
                          <th class=" ">شماره سفارش</th>
                        </tr>
                      </thead>
                      <tbody id="orders-transactions-content">
                      </tbody>
                    </table>
                  </div> 
                  <div class="row">
                    <div class="col-md-12 text-center pagination_area" id="orders-transactions-pagination">
                        <button onclick="load_orders_transactions(1)" type="button" class="btn btn-primary pagination-btn">1</button>
                    </div>
                  </div>
                  <script>
                      let orders_transactions_page = 0;
                      let orders_transactions_count = 0;
                      let orders_transactions_term = '';
                      // fetch the orders_transactions
                      function fetch_orders_transactions(){
                          var settings = {
                              "async": true,
                              "crossDomain": true,
                              "url": "{{route('admin.transactions.daily.orders.fetch')}}?page=" + orders_transactions_page + "&term=" + orders_transactions_term,
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
                                  '    <td class="row_col_10" colspan="4"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                                  '</tr>';
                                $('#orders-transactions-content').html(content);
                              }else{
                                for(let i=0; i<response.length; i++){
                                    let transaction = response[i];
                                    content +=`
                                    <tr>
                                      <td data-title="تاریخ" class="row_col_10"  scope="row">${transaction.created_at_str}</td>
                                      <td data-title="مقدار" class="row_col_10"  scope="row">${(transaction.amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال</td>
                                      <td data-title="نامشتری" class="row_col_10"  scope="row">${transaction.src.full_name}</td>
                                      <td data-title="سفارش" class="row_col_10"  scope="row"><a href="{{route('admin.orders.show')}}/${transaction.order.id}">${transaction.order.id_str}</a></td>
                                    </tr>
                                      `;
                                }
                                console.log(response)
                                $('#orders-transactions-content').html(content);
                              }
                          });
                      }

                      // count the transactions
                      function pagination_orders_transactions(){
                          var settings = {
                              "async": true,
                              "crossDomain": true,
                              "url": "{{route('admin.transactions.daily.orders.count')}}?term=" + orders_transactions_term,
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
                                if(i==orders_transactions_page){
                                  content += ' <button onclick="load_orders_transactions('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                }else{
                                  content += ' <button onclick="load_orders_transactions('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                }
                              }
                              if(transactions_page < last_page-1)
                                  content += '...';
                              $('#orders-transactions-pagination').html(content);
                          });
                      }
                      function load_orders_transactions(page){
                          transactions_page = page;
                          fetch_orders_transactions();
                          pagination_orders_transactions();
                      }
                      $(document).ready(function(){
                          load_orders_transactions(0);
                      });
                  </script>
              </div>
            </div>
            <div class="tab-pane  p-20" id="charges" role="tabpanel">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class=" ">تاریخ</th>
                                    <th class=" ">مقدار</th>
                                    <th class=" ">نام مشتری</th>
                                </tr>
                            </thead>
                            <tbody id="charges-transactions-content">
                            </tbody>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 text-center pagination_area" id="charges-transactions-pagination">
                            <button onclick="load_charges_transactions(1)" type="button" class="btn btn-primary pagination-btn">1</button>
                        </div>
                    </div>
                    <script>
                        let charges_transactions_page = 0;
                        let charges_transactions_count = 0;
                        let charges_transactions_term = '';
                        // fetch the charges_transactions
                        function fetch_charges_transactions(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.transactions.daily.charges.fetch')}}?page=" + charges_transactions_page + "&term=" + charges_transactions_term,
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
                                    '    <td class="row_col_10" colspan="4"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                                    '</tr>';
                                  $('#charges-transactions-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let transaction = response[i];
                                      content +=`
                                      <tr>
                                        <td data-title="تاریخ" class="row_col_10"  scope="row">${transaction.created_at_str}</td>
                                        <td data-title="مقدار" class="row_col_10"  scope="row">${(transaction.amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال</td>
                                        <td data-title="کاربر" class="row_col_10"  scope="row">${transaction.dst.full_name}</td>
                                      </tr>
                                        `;
                                  }
                                  console.log(response)
                                  $('#charges-transactions-content').html(content);
                                }
                            });
                        }

                        // count the transactions
                        function pagination_charges_transactions(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.transactions.daily.charges.count')}}?term=" + charges_transactions_term,
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
                                  if(i==charges_transactions_page){
                                    content += ' <button onclick="load_charges_transactions('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                  }else{
                                    content += ' <button onclick="load_charges_transactions('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                  }
                                }
                                if(transactions_page < last_page-1)
                                    content += '...';
                                $('#charges-transactions-pagination').html(content);
                            });
                        }
                        function load_charges_transactions(page){
                            transactions_page = page;
                            fetch_charges_transactions();
                            pagination_charges_transactions();
                        }
                        $(document).ready(function(){
                            load_charges_transactions(0);
                        });
                    </script>
                </div>
            </div>
            <div class="tab-pane  p-20" id="free" role="tabpanel">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class=" ">تاریخ</th>
                                    <th class=" ">مقدار</th>
                                    <th class=" ">نام کاربر</th>
                                </tr>
                            </thead>
                            <tbody id="free-transactions-content">
                            </tbody>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 text-center pagination_area" id="free-transactions-pagination">
                            <button onclick="load_free_transactions(1)" type="button" class="btn btn-primary pagination-btn">1</button>
                        </div>
                    </div>
                    <script>
                        let free_transactions_page = 0;
                        let free_transactions_count = 0;
                        let free_transactions_term = '';
                        // fetch the free_transactions
                        function fetch_free_transactions(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.transactions.daily.free.fetch')}}?page=" + free_transactions_page + "&term=" + free_transactions_term,
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
                                    '    <td class="row_col_10" colspan="4"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                                    '</tr>';
                                  $('#free-transactions-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let transaction = response[i];
                                      content +=`
                                      <tr>
                                        <td data-title="تاریخ" class="row_col_10"  scope="row">${transaction.created_at_str}</td>
                                        <td data-title="مقدار" class="row_col_10"  scope="row">${(transaction.amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال</td>
                                        <td data-title="کاربر" class="row_col_10"  scope="row">${transaction.dst.full_name}</td>
                                      </tr>
                                        `;
                                  }
                                  console.log(response)
                                  $('#free-transactions-content').html(content);
                                }
                            });
                        }

                        // count the transactions
                        function pagination_free_transactions(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.transactions.daily.free.count')}}?term=" + free_transactions_term,
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
                                if(free_transactions_page > 1)
                                    content += '...';
                                for(let i=Math.max(0, free_transactions_page-1); i<=Math.min(free_transactions_page+1, last_page); i++){
                                  if(i==free_free_transactions_page){
                                    content += ' <button onclick="load_free_transactions('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                  }else{
                                    content += ' <button onclick="load_free_transactions('+i+')" type="button" class="btn btn-primary btn-primary-transparent pagination-btn">'+ (i+1) +'</button> ';
                                  }
                                }
                                if(free_transactions_page < last_page-1)
                                    content += '...';
                                $('#free-transactions-pagination').html(content);
                            });
                        }
                        function load_free_transactions(page){
                            free_transactions_page = page;
                            fetch_free_transactions();
                            pagination_free_transactions();
                        }
                        $(document).ready(function(){
                            load_free_transactions(0);
                        });
                    </script>
                </div>
            </div>
            <div class="tab-pane  p-20" id="withdraws" role="tabpanel">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class=" ">تاریخ</th>
                                    <th class=" ">مقدار</th>
                                    <th class=" ">نام مشتری</th>
                                    <th class=" ">وضعیت</th>
                                </tr>
                            </thead>
                            <tbody id="withdraws-transactions-content">
                            </tbody>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 text-center pagination_area" id="withdraws-transactions-pagination">
                            <button onclick="load_withdraws_transactions(1)" type="button" class="btn btn-primary pagination-btn">1</button>
                        </div>
                    </div>
                    <script>
                        let withdraws_transactions_page = 0;
                        let withdraws_transactions_count = 0;
                        let withdraws_transactions_term = '';
                        // fetch the withdraws_transactions
                        function fetch_withdraws_transactions(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.transactions.daily.withdraws.fetch')}}?page=" + withdraws_transactions_page + "&term=" + withdraws_transactions_term,
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
                                    '    <td class="row_col_10" colspan="4"  scope="row" style="text-align:center" >اطلاعاتی ثبت نشده است</th>'+
                                    '</tr>';
                                  $('#withdraws-transactions-content').html(content);
                                }else{
                                  for(let i=0; i<response.length; i++){
                                      let transaction = response[i];
                                      content +=`
                                      <tr>
                                        <td data-title="تاریخ" class="row_col_10"  scope="row">${transaction.created_at_str}</td>
                                        ${transaction.status == {{\App\Transaction::PENDING}}?
                                          `<td data-title="مقدار" class="row_col_10"  scope="row">${(transaction.amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال (${(transaction.src.total_credit).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال اعتبار فعلی)</td>`
                                        :
                                          `<td data-title="مقدار" class="row_col_10"  scope="row">${(transaction.amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} ریال</td>`
                                        }
                                        <td data-title="کاربر" class="row_col_10"  scope="row">${transaction.src.full_name}</td>
                                        ${transaction.status == {{\App\Transaction::PAID}}?
                                          `<td data-title="وضعیت" class="row_col_10"  scope="row">پرداخت شده</td>`
                                        :''}
                                        ${transaction.status == {{\App\Transaction::FAILED}}?
                                          `<td data-title="وضعیت" class="row_col_10"  scope="row">رد شده</td>`
                                        :''}
                                        ${transaction.status == {{\App\Transaction::PENDING}}?
                                          `<td data-title="وضعیت" class="row_col_10"  scope="row">
                                            <button class="btn btn-success" onclick="accept_withdraw(${transaction.id})">پرداخت شده</button>
                                            <button class="btn btn-warning" onclick="refuse_withdraw(${transaction.id})">رد شده</button>
                                          </td>`
                                        :''}
                                      </tr>
                                        `;
                                  }
                                  console.log(response)
                                  $('#withdraws-transactions-content').html(content);
                                }
                            });
                        }

                        // count the transactions
                        function pagination_withdraws_transactions(){
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('admin.transactions.daily.withdraws.count')}}?term=" + withdraws_transactions_term,
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
                                  if(i==withdraws_transactions_page){
                                    content += ' <button onclick="load_withdraws_transactions('+i+')" type="button" class="btn btn-primary pagination-btn">'+ (i+1) +'</button> ';
                                  }else{
                                    content += ' <button onclick="load_withdraws_transactions('+i+')" type="button" class="btn btn-primary btn-primary-transparent  pagination-btn">'+ (i+1) +'</button> ';
                                  }
                                }
                                if(transactions_page < last_page-1)
                                    content += '...';
                                $('#withdraws-transactions-pagination').html(content);
                            });
                        }
                        function load_withdraws_transactions(page){
                            transactions_page = page;
                            fetch_withdraws_transactions();
                            pagination_withdraws_transactions();
                        }
                        $(document).ready(function(){
                            load_withdraws_transactions(0);
                        });
                        function accept_withdraw(transaction_id){
                          var settings = {
                              "async": true,
                              "crossDomain": true,
                              "url": "{{route('admin.transactions.daily.withdraws.accept')}}?transaction_id=" + transaction_id,
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
                              alert('درخواست بازگشت وجه تایید شد');
                              load_withdraws_transactions(withdraws_transactions_page);
                            }else{
                              console.log(response);
                            }
                          });
                        }

                        function refuse_withdraw(transaction_id){
                          var settings = {
                              "async": true,
                              "crossDomain": true,
                              "url": "{{route('admin.transactions.daily.withdraws.refuse')}}?transaction_id=" + transaction_id,
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
                              alert('درخواست بازگشت وجه رد شد');
                              load_withdraws_transactions(withdraws_transactions_page);
                            }else{
                              console.log(response);
                            }
                          });
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