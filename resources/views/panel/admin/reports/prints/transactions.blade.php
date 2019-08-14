<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>چاپ لیست هزینه ها</title>
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
          justify-content: space-between;
          font-size: 18px;
      }
        .header{
          display: flex;
          flex-direction: column;
          background: #dddddd !important;
          -webkit-print-color-adjust: exact;
          padding: 10px 5px;
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
      justify-content: space-between;
      font-size: 18px;
  }
    .header{
      display: flex;
      flex-direction: column;
      background: #dddddd;
      padding: 10px 5px;
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

    
    
    
    </style>
</head>
<body>
  @if($total>$per_page)
    @php
     $index =0; 
     $total_money = 0;  
    @endphp
    @for ($i = 0; $i <ceil($total/$per_page); $i++)
      <page size="A4" layout="landscape">
        <div class="header">
            <div class="title">اداره بهزیستی شهرستان رشت</div>
            <div class="info">
              <div class="type">لیست هزینه</div>
              <div class="year">
                <span>سال: </span>
                <span>{{$year}}</span>
                
              </div>
              <div class="month">
                <span>ماه: </span>
                <span>
                  @switch($month)
                    @case("همه")
                      همه
                      @break
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
              <div class="bank">
                <span>بانک: </span>
                <span>ملت</span>
              </div>
              <div class="branch">
                <span>شعبه: </span>
                <span>نامجو</span>
              </div>
              <div class="page">
                <span>صفحه: </span>
                <span>{{($i+1)}}</span>
              </div>
            </div>
    
        </div>
        <div class="table">
          <table>
            <tr>
              <th>ردیف</th>
              <th>حامی</th>
              <th>مددجو</th>
              <th>شماره حساب</th>
              <th>گیرنده وجه</th>
              <th>علل حمایت</th>
              <th>هزینه</th>
              
            </tr>
            @for ($j= 0; $j < $per_page; $j++)
              @if($index<$total)
                <tr>
                  <td>{{($index+1)}}</td>
                  <td>{{$transactions[$index]->donor->full_name}}</td>
                  <td>{{$transactions[$index]->donee->full_name}}</td>
                  <td>{{$transactions[$index]->donee->bank_account_number}}</td>
                  <td>{{$transactions[$index]->donee->bank_account_owner}}</td>
                  <td>{{$transactions[$index]->donee->reasons_to_help}}</td>
                  <td>{{$transactions[$index]->money_amount}}</td>
                </tr>
                @php
                  $total_money+=$transactions[$index]->money_amount;
                  $index++;
                @endphp
              @endif
            @endfor
            @if($i==ceil($total/$per_page)-1)
              <tr>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="font-weight:bold;">مجموع</td>
                <td style="font-weight:bold;">{{$total_money}}</td>
              </tr>
            @endif
          </table>
        </div>
      </page> 
    @endfor
  @else
    @php
     $index =0;   
     $total_money =0;
    @endphp
    <page size="A4" layout="landscape">
      <div class="header">
          <div class="title">اداره بهزیستی شهرستان رشت</div>
          <div class="info">
            <div class="type">لیست هزینه</div>
            <div class="year">
              <span>سال: </span>
              <span>{{$year}}</span>
              
            </div>
            <div class="month">
              <span>ماه: </span>
              <span>
                   @switch($month)
                   @case("همه")
                      همه
                      @break
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
            <div class="bank">
              <span>بانک: </span>
              <span>ملت</span>
            </div>
            <div class="branch">
              <span>شعبه: </span>
              <span>نامجو</span>
            </div>
            <div class="page">
              <span>صفحه: </span>
              <span>1</span>
            </div>
          </div>

      </div>
      <div class="table">
        <table>
          <tr>
            <th>ردیف</th>
            <th>حامی</th>
            <th>مددجو</th>
            <th>شماره حساب</th>
            <th>گیرنده وجه</th>
            <th>علل حمایت</th>
            <th>هزینه</th>
          </tr>
          @for ($j= 0; $j < $total; $j++)
            <tr>
              <td>{{($index+1)}}</td>
              <td>{{$transactions[$j]->donor->full_name}}</td>
              <td>{{$transactions[$j]->donee->full_name}}</td>
              <td>{{$transactions[$j]->donee->bank_account_number}}</td>
              <td>{{$transactions[$j]->donee->bank_account_owner}}</td>
              <td>{{$transactions[$j]->donee->reasons_to_help}}</td>
              <td>{{$transactions[$j]->money_amount}}</td>
            </tr>
            @php
              $total_money+=$transactions[$index]->money_amount;
              $index++;
            @endphp
            @endfor  
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="font-weight:bold;">مجموع</td>
                <td style="font-weight:bold;">{{$total_money}}</td>
            </tr>
        </table>
      </div>
    </page> 
  @endif

</body>
</html>