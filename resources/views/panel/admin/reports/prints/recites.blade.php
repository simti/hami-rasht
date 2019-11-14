<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>چاپ فیش مددجو</title>
  <style>
      @font-face {
        font-family: "Bnazanin";
        font-style: normal;
        font-weight: 300;
        src: url(/admin/fonts/BNazanin.ttf);
    }
      body {
        background: rgb(204,204,204); 
        font-family: 'Bnazanin' !important;
      }
      page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        padding:2px;
      }
      page[size="A4"] {  
        width: 21cm;
        height: 29.7cm; 
      }
      page[size="A4"][layout="landscape"] {
        width: 29.7cm;
        height: 21cm;  
        page-break-after: always;
      }
      
      @media print {
        page{
          page-break-after:always;
        }
        body, page {
          margin: 0;
          box-shadow: 0;
        }
        table {
          font-family: 'Bnazanin' !important;
          border-collapse: collapse;
          width: 100%;
          direction: rtl;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: center;
          padding: 8px;
        }
    
        .info {
          display: flex;
          flex-direction: row;
          /* flex-grow: inherit; */
          justify-content: space-around;
          font-size: 18px;
      }
        .header{
          display: flex;
          flex-direction: column;
          background: #dddddd !important;
          -webkit-print-color-adjust: exact;
          padding: 5px 100px;
          direction: rtl;
        }
    
        .title {
          text-align: center;
          font-size: larger;
          font-weight: bold;
          padding: 10px 0;
          /* border-bottom: 1px solid; */
          /* border: 1px solid; */
        }
        .left{
          display: flex;
          flex: 0.5;
          justify-content: space-around;
        }

        .type{
          flex:1;
        }
      }
    table {
      font-family: 'Bnazanin' !important;
      border-collapse: collapse;
      width: 100%;
      direction: rtl;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: center;
      padding: 8px;
    }

    .info {
      display: flex;
      flex-direction: row;
      /* flex-grow: inherit; */
      justify-content: space-around;
      font-size: 18px;
  }
    .header{
      display: flex;
      flex-direction: column;
      background: #dddddd;
      padding: 5px 100px;
      direction: rtl;
    }

    .title {
      text-align: center;
      font-size: larger;
      font-weight: bold;
      padding: 10px 0;
      /* border-bottom: 1px solid; */
      /* border: 1px solid; */
    }
    .left{
      display: flex;
      flex: 0.5;
      justify-content: space-around;
    }

    .type{
      flex:1;
    }

    {{--  new  --}}
    .body{
      display: flex;
      text-align: right;
      direction: rtl;
      flex-direction: column;
      border-bottom: 1px solid;
      margin-bottom: 1px;
    }
    .body-top{
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      font-weight: 700;
      font-size: large;
      border-bottom: 2px dotted #777;
      padding: 5px 20px
    }
    .body-top-right{
      flex: 1;
      padding:0px 20px;
    }
    .body-top-left{
      flex: 1;
      padding:0px 20px;
      text-align: center;
    }
    .body-bottom {
      display: flex;
      justify-content: space-around;
      padding: 10px;
      font-size: large;
      font-weight: bold;
  }
    
    </style>
</head>
<body>
  @if($total>$per_page)
    @php
     $index =0;   
    @endphp
    @for ($i = 0; $i <ceil($total/$per_page); $i++)
      <page size="A4">
          @for ($j= 0; $j < $per_page; $j++)
            @if($index<$total)
              <div class="recite">
                  <div class="header">
                      <div class="title">اداره بهزیستی شهرستان رشت</div>
                      <div class="info">
                        <div class="type">فیش مستمری مددجویان(کمک هزینه)</div>
                        <div class="left">
                          <div class="year">
                            <span>سال: </span>
                            <span>{{explode("-",$transactions[$index]->period->title)[0]}}</span>
                          </div>
                          <div class="month">
                            <span>ماه: </span>
                            <span>
                              @switch(explode("-",$transactions[$index]->period->title)[1])
                                @case("1")
                                  "فروردین"
                                  @break
                                @case("2")
                                  "اردیبهشت"
                                  @break
                                @case("3")
                                  "خرداد"
                                  @break
                                @case("4")
                                  "تیر"
                                  @break
                                @case("5")
                                  "مرداد"
                                  @break
                                @case("6")
                                  "شهریور"
                                  @break
                                @case("7")
                                  "مهر"
                                  @break
                                @case("8")
                                  "آبان"
                                  @break
                                @case("9")
                                  "آذر"
                                  @break
                                @case("10")
                                  "دی"
                                  @break
                                @case("11")
                                  "بهمن"
                                  @break
                                @default
                                  "اسفند"
                                    
                              @endswitch
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="body">
                      <div class="body-top">
                        <div class="body-top-right">
                          <div class="row">
                            نام و نام خانوادگی:  
                            <span>{{$transactions[$index]->donee->full_name}}</span>
                          </div>
                          <div class="row">
                              علل حمایت:  
                              <span>{{$transactions[$index]->donee->reasons_to_help}}</span>
                          </div>
                          <div class="row">
                              گیرنده وجه :  
                              <span>{{$transactions[$index]->donee->bank_account_owner}}</span>
                          </div>
                          <div class="row">
                              حامی:  
                              <span>{{$transactions[$index]->donor->full_name}}</span>
                          </div>
                        </div>
                        <div class="body-top-left">
                          <div class="row">
                              بانک:  
                              <span>{{$transactions[$index]->donee->bank_name}}</span>
                          </div>
                          <div class="row">
                              شعبه :  
                              <span>{{$transactions[$index]->donee->bank_branch_name}}</span>
                          </div>
                          <div class="row">
                              شماره حساب:  
                              <span>{{$transactions[$index]->donee->bank_account_number}}</span>
                          </div>
                        </div>
                      </div>
                      <div class="body-bottom">
                        <div class="cost">
                            مبلغ هزینه :  
                            <span>{{$transactions[$index]->money_amount}}</span>
                        </div>
                        <div class="loan">
                            مبلغ وام :  
                            <span>0</span>
                        </div>
                        <div class="total">
                            خالص دریافتی :  
                            <span>{{$transactions[$index]->money_amount}}</span>
                        </div>
                      </div>
                    </div>
              </div>
            @endif
            @php
              $index++;
            @endphp
          @endfor
      </page> 
    @endfor
  @else
    <page size="A4">
      @foreach ($transactions as $transaction)
      <div class="recite">
          <div class="header">
              <div class="title">اداره بهزیستی شهرستان رشت</div>
              <div class="info">
                <div class="type">فیش مستمری مددجویان(کمک هزینه)</div>
                <div class="left">
                  <div class="year">
                    <span>سال: </span>
                    <span>{{explode("-",$transaction->period->title)[0]}}</span>
                  </div>
                  <div class="month">
                    <span>ماه: </span>
                    <span>
                      @switch(explode("-",$transaction->period->title)[1])
                        @case("1")
                          فروردین
                          @break
                        @case("2")
                          اردیبهشت
                          @break
                        @case("3")
                          خرداد
                          @break
                        @case("4")
                          تیر
                          @break
                        @case("5")
                          مرداد
                          @break
                        @case("6")
                          شهریور
                          @break
                        @case("7")
                          مهر
                          @break
                        @case("8")
                          آبان
                          @break
                        @case("9")
                          آذر
                          @break
                        @case("10")
                          دی
                          @break
                        @case("11")
                          بهمن
                          @break
                        @default
                          اسفند
                            
                      @endswitch
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="body">
              <div class="body-top">
                <div class="body-top-right">
                  <div class="row">
                    نام و نام خانوادگی:  
                    <span>{{$transaction->donee->full_name}}</span>
                  </div>
                  <div class="row">
                      علل حمایت:  
                      <span>{{$transaction->donee->reasons_to_help}}</span>
                  </div>
                  <div class="row">
                      گیرنده وجه :  
                      <span>{{$transaction->donee->bank_account_owner}}</span>
                  </div>
                  <div class="row">
                      حامی:  
                      <span>{{$transaction->donor->full_name}}</span>
                  </div>
                </div>
                <div class="body-top-left">
                  <div class="row">
                      بانک:  
                      <span>{{$transaction->donee->bank_name}}</span>
                  </div>
                  <div class="row">
                      شعبه :  
                      <span>{{$transaction->donee->bank_branch_name}}</span>
                  </div>
                  <div class="row">
                      شماره حساب:  
                      <span>{{$transaction->donee->bank_account_number}}</span>
                  </div>
                </div>
              </div>
              <div class="body-bottom">
                <div class="cost">
                    مبلغ هزینه :  
                    <span>{{$transaction->money_amount}}</span>
                </div>
                <div class="loan">
                    مبلغ وام :  
                    <span>0</span>
                </div>
                <div class="total">
                    خالص دریافتی :  
                    <span>{{$transaction->money_amount}}</span>
                </div>
              </div>
            </div>
      </div>    
      @endforeach
    </page> 
  @endif

</body>
</html>