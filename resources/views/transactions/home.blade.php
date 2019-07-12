@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تعاملات الورش</h4>
                <h6 class="card-subtitle">عرض تعاملات الورش</h6>
                <div class="table-responsive m-t-40">
                    <table id="yomeya" class="table color-bordered-table table-striped full-color-table full-dark-table hover-table" data-display-length='50' data-order=[]  >
                        <thead>
                            <tr>
                                <th>تاريخ</th>
                                <th>من</th>
                                <th>الي</th>
                                <th>دهب ٢١</th>
                                <th>دهب ١٨</th>
                                <th>نقديه</th>
                                <th>مخازن</th>
                                <th>كميه</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $key => $item)
                            <tr>
                                <td>{{$item->WKTN_DATE}}</td>
                                <td>{{($item->WKTN_WKSP_FROM == 0)?'يوميه' : $item->fromWKSP }}</td>
                                <td>{{($item->WKTN_WKSP_TO == 0)?'مخزن' : $item->toWKSP }}</td>
                                <td>{{number_format($item->WKTN_GD21, 3)}}</td>
                                <td>{{number_format($item->WKTN_GD18, 3)}}</td>
                                <td>{{number_format($item->WKTN_MONY, 2)}}</td>
                                <td>{{$item->INVT_NAME}}</td>
                                <td>{{$item->WKTN_INVT_CONT}}</td>
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
