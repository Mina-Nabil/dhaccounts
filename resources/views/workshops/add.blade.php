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
                        <label>اسم الورشه*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-account"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Name" name=name aria-label="Name" aria-describedby="basic-addon11" value="{{ (isset($workshop)) ? $workshop->WKSP_NAME : old('name')}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>حساب دهب ١٨*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-gem"></i></span>
                            </div>
                            <input type="number" step="0.01" class="form-control" placeholder="Gold18 Balance" name=gold18 aria-label="Gold18" aria-describedby="basic-addon11" value="{{ (isset($workshop)) ? $workshop->WKSP_GD18 : old('gold18')}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>حساب دهب ٢١*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-gem"></i></span>
                            </div>
                            <input type="number" step="0.01" class="form-control" placeholder="Gold21 Balance" name=gold21 aria-label="Gold21" aria-describedby="basic-addon11" value="{{ (isset($workshop)) ? $workshop->WKSP_GD21 : old('gold21')}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>حساب نقديه*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-donate"></i></span>
                            </div>
                            <input type="number" step="0.01" class="form-control" placeholder="Money Balance" name=money aria-label="Money" aria-describedby="basic-addon11" value="{{ (isset($workshop)) ? $workshop->WKSP_MONY : old('money')}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>رقم التليفون</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" maxlength="11" placeholder="Mobile Number" name=mobNumber aria-label="Mobile Number" aria-describedby="basic-addon11" value="{{ (isset($workshop)) ? $workshop->WKSP_MOBN : old('mobNumber')}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label>عنوان</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Address" name=address aria-label="Address" aria-describedby="basic-addon11" value="{{ (isset($workshop)) ? $workshop->WKSP_ADRS : old('address')}}" >
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1">وصف الورشه</label>
                        <div class="input-group mb-3">

                            <textarea type="number" class="form-control" name=comment placeholder="Workshop Comment" aria-label="Available in Stock" aria-describedby="basic-addon22" >{{ (isset($workshop)) ? $workshop->WKSP_CMNT : old('comment')}}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{url('workshops/show') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
