@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تعاملات الورش</h4>
                @if($workshopPage)
                <h5 class="card-subtitle">عرض تعاملات {{$workshop->WKSP_NAME}}</h5>
                @else
                <h5 class="card-subtitle">عرض تعاملات الورش</h5>
                @endif
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
                                <td>
                                  <a href="{{url('transactions/show/' . $item->WKTN_WKSP_FROM)}}" >
                                    {{($item->WKTN_WKSP_FROM == 0)?'يوميه' : $item->fromWKSP }}
                                  </a>
                                </td>
                                <td>
                                  <a href="{{url('transactions/show/' . $item->WKTN_WKSP_TO)}}" >
                                    {{($item->WKTN_WKSP_TO == 0)?'مخزن' : $item->toWKSP }}
                                  </a>
                                </td>
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

@if($workshopPage && $workshop->id != 0)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">كشف حساب</h4>
                <form class="form pt-3" method="post" action="{{ $workshopFormURL }}" enctype="multipart/form-data" >
            @csrf

            <input type=hidden name=workshopID value="{{$workshop->id}}">

              <div class="form-group">
                  <label>من*</label>
                  <div class="input-group mb-3">
                      <input type="date" class="form-control" placeholder="Start Date" name=startDate aria-describedby="basic-addon11" >
                  </div>
              </div>
              <div class="form-group">
                  <label>الي*</label>
                  <div class="input-group mb-3">
                      <input type="date" class="form-control" placeholder="End Date" name=endDate aria-describedby="basic-addon11" value="{{date('Y-m-d')}}" >
                  </div>
              </div>

              <button type="submit" id=submit class="btn btn-success mr-2" >Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endif
@endsection
