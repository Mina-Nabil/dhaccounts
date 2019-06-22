@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">الاصناف</h4>
                <h6 class="card-subtitle">عرض الاصناف المتاحه</h6>
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table color-bordered-table table-striped full-color-table full-dark-table hover-table" data-display-length='-1' data-order="[]" >
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الموديل</th>
                                <th>الكميه المتاحه</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Inventory as $item)
                            <tr>
                                <td>{{$item->INVT_NAME}}</td>
                                <td>{{$item->MODL_NAME}}</td>
                                <td>{{$item->INVT_CONT}}</td>
                                <td><a href="{{ url('inventory/edit/' . $item->id) }}"><img src="{{ asset('images/edit.png') }}" width=25 height=25></img></a></td>
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
