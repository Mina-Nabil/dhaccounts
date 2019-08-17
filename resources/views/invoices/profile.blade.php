@extends('layouts.app')

@section('content')

<script>

function cancel(id){


  swal({
    title: "تأكيد الغاء طلب",
    text: "سوف يتم الغاء الطلب ، هل تريد الاستمرار ؟",
    buttons: true,
    icon: "warning"})
.then((value) => {
  if(value){
    window.location.replace('{{url("invoice/cancel/")}}' + '/' +id)

    }
});

}

function confirmRev(id){


  swal({
    title: "تأكيد طلب",
    text: "سوف يتم تأكيد الطلب ، هل تريد الاستمرار ؟",
    buttons: true,
    icon: "success"})
.then((value) => {
  if(value){
    window.location.replace('{{url("invoice/confirmrevert/")}}' + '/' +id)

    }
});

}

function confirm(id){


  swal({
    title: "تأكيد طلب",
    text: "سوف يتم تأكيد الطلب ، هل تريد الاستمرار ؟",
    buttons: true,
    icon: "success"})
.then((value) => {
  if(value){
    window.location.replace('{{url("invoice/confirm/")}}' + '/' +id)

    }
});

}

function revert(id){


  swal({
    title: "استرجاع الفاتوره",
    text: "سوف يتم استرجاع الفاتوره، هل تريد الاستمرار ؟",
    buttons: true,
    icon: "error"})
.then((value) => {
  if(value){
    window.location.replace('{{url("invoice/revert/")}}' + '/' +id)

    }
});

}

</script>

<div class="card-group">
  <div class="card">
      <div class="card-body">
          <div class="row">
              <div class="col-md-12">
                  <div class="d-flex no-block align-items-center">
                      <div>
                          <h3><i class="text-success fas fa-dollar-sign"></i></h3>
                          <p class="text-muted">اجمالي نقدي</p>
                      </div>
                      <div class="ml-auto">
                          <h2 class="counter text-success"> {{number_format($invoice['invoiceData']->INVC_TOTL, 2)}} جنيه  </h2>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="text-warning icon-diamond"></i></h3>
                            <p class="text-muted">اجمالي ذهب</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-warning"> {{number_format($invoice['invoiceData']->INVC_TOTL_GOLD,3)}} جم  </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="text-danger fas fa-user"></i></h3>
                            <p class="text-muted">اسم العميل</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-danger"> {{$invoice['invoiceData']->CLNT_NAME . ' ' . $invoice['invoiceData']->CLNT_ACTP}}   </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="text-info fas fa-barcode"></i></h3>
                            <p class="text-muted">رقم الطلب</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-info"> {{sprintf('%08d',$invoice['invoiceData']->id)}}  </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<div class="row">

          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">تفاصيل الفاتوره</h4>
                      <h5 class="card-subtitle">{{ $invoiceType }}</h5>
                      <div class="table-responsive m-t-40">

                        <input type=hidden  id="dt-header" value="
                              <th>اسم المستخدم</td>
                              <th > {{ $invoice['invoiceData']->CLNT_NAME}}</th>
                              <th>تاريخ الطلب</th>
                              <th >{{ $invoice['invoiceData']->INVC_DATE }}</th>
                              <th>رقم المسلسل</th>
                              <th>{{sprintf('%08d',$invoice['invoiceData']->id)}}</th>
                         ">

                   <table
                   @if($invoice['invoiceData']->INVC_STAT == 1)
                   id="example233"
                   @else
                   id="myTable2"
                   @endif
                    class="table color-bordered-table table-striped  hover-table" data-display-length='-1' data- >


                       <thead>
                        <tr>
                          <th>مللي</th>
                          <th>جرام</th>
                          <th>عدد</th>
                          <th>نوع</th>
                          <th>فئه</th>
                          <th>اجمالي</th>
                        </tr>
                      </thead>

                      <tbody>
                          @foreach($invoice['invoiceItems'] as $item)
                          <tr>
                            <td>{{$item->INIT_MLLI}}</td>
                            <td>{{$item->INIT_GRAM}}</td>
                            <td>{{$item->INIT_CONT}}</td>
                            <td>{{$item->INIT_ITEM}}</td>
                            <td>{{$item->INIT_PRCE}}</td>
                            <td>{{$item->INIT_PRCE * $item->INIT_CONT}}</td>
                          </tr>
                          @endforeach

                        </tbody>

                        <tfoot>
                          <tr>
                            <td>اجمالي ذهب</td>
                            <td>{{ number_format($invoice['invoiceData']->INVC_TOTL_GOLD, 3)}}</td>
                            <td>عيار {{$invoice['invoiceData']->CLNT_ACTP}}</td>
                            <td></td>
                            <td>اجمالي نقديه</td>
                            <td>{{ number_format($invoice['invoiceData']->INVC_TOTL, 2)}}</td>
                          </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

      <div class="col-md-12">
          <div class="card">
              <div class="card-body">
                  <h3 class="card-title"> تاريخ اصدار الفاتوره:  {{$invoice['invoiceData']->INVC_DATE}}</h3>
                  <p class="card-text">&nbsp </p>
                  @if($invoice['invoiceData']->INVC_STAT == 0)
                  <button onclick="confirm({{$invoice['invoiceData']->id}})" class="btn btn-success">تأكيد الطلب</button>
                  <a href="{{url('invoice/modify/'. $invoice['invoiceData']->id) }}" class="btn btn-info">تعديل الطلب</a>
                  <button onclick="cancel({{$invoice['invoiceData']->id}})" class="btn btn-dark">إلغاء الطلب</button>
                  @elseif($invoice['invoiceData']->INVC_STAT == 1)
                  <button onclick="revert({{$invoice['invoiceData']->id}})" class="btn btn-danger">إسترجاع الفاتوره</button>
                  @elseif($invoice['invoiceData']->INVC_STAT == 3)
                  <button onclick="confirmRev({{$invoice['invoiceData']->id}})" class="btn btn-success">تأكيد الفاتوره المرتجع</button>
                  @endif
              </div>
          </div>
      </div>

</div>
@endsection
