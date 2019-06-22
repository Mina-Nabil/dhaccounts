@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $pageTitle }}</h4>
                <h5 class="card-subtitle">{{ $pageDescription }}</h5>
                <form class="form pt-3" method="post" action="{{ $formURL }}" enctype="multipart/form-data" >
                @csrf
                    <div class="form-group">
                        <label>اسم الصنف*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-list-ul"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Name" name=name aria-label="Name" aria-describedby="basic-addon11" value="{{ (isset($inventory)) ? $inventory->INVT_NAME : old('name')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>الموديل</label>
                        <div class="input-group mb-3">
                            <select name=modlID class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                <option disabled>اختر نوع الموديل</option>
                                @foreach($Models as $model)
                                <option value="{{ $model->id }}"
                                @if(isset($inventory) && $model->id == $inventory->INVT_MODL_ID)
                                    selected
                                @endif
                                >{{$model->MODL_NAME}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">الكميه المتاحه</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon22"><i class="fas fa-boxes"></i></span>
                            </div>
                            <input type="number" class="form-control" name=count placeholder="Available in Stock" aria-label="Available in Stock" aria-describedby="basic-addon22" value="{{ (isset($inventory)) ? $inventory->INVT_CONT : old('count')}}" >
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{url('inventory/show') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
