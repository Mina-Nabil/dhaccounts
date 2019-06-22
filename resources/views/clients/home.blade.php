@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">العملاء</h4>
                <h6 class="card-subtitle">عرض بيانات العملاء</h6>
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table color-bordered-table table-striped full-color-table full-dark-table hover-table" data-display-length='-1' data-order="[]" >
                        <thead>
                            <tr>
                                <th>اسم العميل</th>
                                <th>نوع الحساب</th>
                                <th>حساب ذهب</th>
                                <th>حساب نقديه</th>
                                <th>رقم العميل</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Clients as $client)
                            <tr>
                                <td>
                                  <a href="{{url('ledger/show/' . $client->id)}}">
                                     {{$client->CLNT_NAME}}
                                   </a>
                                 </td>
                                <td>{{$client->CLNT_ACTP}}</td>
                                <td>{{$client->CLNT_CRGD}}</td>
                                <td>{{$client->CLNT_CRMN}}</td>
                                <td>{{$client->CLNT_MOB}}</td>
                                <td><a href="{{ url('clients/edit/' . $client->id) }}"><img src="{{ asset('images/edit.png') }}" width=25 height=25></img></a></td>
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
