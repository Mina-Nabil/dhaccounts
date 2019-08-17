@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">الورش</h4>
                <h6 class="card-subtitle">عرض الورش</h6>
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table color-bordered-table table-striped full-color-table full-dark-table hover-table" data-display-length='-1' data-order="[]" >
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>حساب دهب ١٨</th>
                                <th>حساب دهب ٢١</th>
                                <th>حساب نقديه</th>
                                <th>رقم تليفون</th>
                                <th>عنوان</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Tabledata as $workshop)
                            <tr title="{{$workshop->WKSP_CMNT}}">
                                <td>
                                  <a href="{{url('transactions/show/' . $workshop->id)}}" >
                                    {{$workshop->WKSP_NAME}}
                                  </a>
                                </td>
                                <td>{{$workshop->WKSP_GD18}}</td>
                                <td>{{$workshop->WKSP_GD21}}</td>
                                <td>{{$workshop->WKSP_MONY}}</td>
                                <td>{{$workshop->WKSP_MOBN}}</td>
                                <td>{{$workshop->WKSP_ADRS}}</td>
                                <td><a href="{{ url('workshops/modify/' . $workshop->id) }}"><img src="{{ asset('images/edit.png') }}" width=25 height=25></img></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                          <td>اجمالي</td>
                          <td>{{$totals['gold18']}}</td>
                          <td>{{$totals['gold21']}}</td>
                          <td>{{$totals['money']}}</td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
