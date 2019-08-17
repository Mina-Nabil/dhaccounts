@extends('layouts.app')

@section('content')
<script>

function cancel(id){


  swal({
    title: "تأكيد الغاء الفاتوره",
    text: "سوف يتم الغاء الفاتوره ، هل تريد الاستمرار ؟",
    buttons: true,
    icon: "warning"})
.then((value) => {
  if(value){
    window.location.replace('{{url("invoice/cancel/")}}' + '/' +id)

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


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">الفواتير</h4>
                <h6 class="card-subtitle">عرض بيانات الفواتير</h6>
                <div class="table-responsive m-t-40">
                    <table id="yomeya" class="table color-bordered-table table-striped full-color-table full-dark-table hover-table" data-display-length='50' data-order=[]  >
                        <thead>
                            <tr>
                                <th>تاريخ</th>
                                <th>العميل</th>
                                <th>اجمالي دهب</th>
                                <th>اجمالي نقديه</th>
                                <th>حاله الفاتوره</th>
                                <th>تفاصيل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Invoices as $key => $invoice)
                            <tr>
                                <td>{{$invoice->INVC_DATE}}</td>
                                <td>
                                  <a href="{{url('ledger/show/' . $invoice->INVC_CLNT_ID)}}" >
                                    {{$invoice->CLNT_NAME . ' ' . $invoice->CLNT_ACTP}}
                                  </a>
                                </td>
                                <td>{{number_format($invoice->INVC_TOTL_GOLD, 3)}}</td>
                                <td>{{number_format($invoice->INVC_TOTL, 2)}}</td>
                                <td>
                                  <a href="{{ url('invoice/show/' . $invoice->id) }}">
                                  @if($invoice->INVC_STAT == 0)
                                    <span class="label label-info">جديده</span>
                                  @elseif($invoice->INVC_STAT == 1)
                                  <span class="label label-success">مؤكده</span>
                                  @elseif($invoice->INVC_STAT == 2)
                                  <span class="label label-warning">ملغي</span>
                                  @elseif($invoice->INVC_STAT == 4)
                                  <span class="label label-danger">تم استرجاع الفاتوره</span>
                                  @elseif($invoice->INVC_STAT == 5)
                                  <span class="label label-danger">فاتوره مرتجع</span>
                                  @elseif($invoice->INVC_STAT == 3)
                                  <span class="label label-warning"> فاتوره مرتجع غير مؤكده</span>
                                  @endif
                                </a>
                                </td>
                                <td>
                                  <a href="{{ url('invoice/show/' . $invoice->id) }}"><i class="m-l-10 fas fa-search" style="color:#00c292; font-size: 20px;"></i></a>
                                  @if($invoice->INVC_STAT == 0)
                                  <a href="{{ url('invoice/modify/' . $invoice->id) }}"><i class="m-l-10  fas fa-edit" style="color:#343a40; font-size: 20px;"></i></a>
                                  <button class="btn" onclick="cancel({{$invoice->id}})"><i class="m-l-10 fas fa-window-close" style="color:#e46a76; font-size: 20px;"></i></button>
                                  @elseif($invoice->INVC_STAT == 1)
                                  <button class="btn" onclick="revert({{$invoice->id}})"><i class="m-l-10 fas fa-window-close" style="color:#e46a76; font-size: 20px;"></i></button>
                                  @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
