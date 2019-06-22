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
                        <label>اسم العميل*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-account"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Client Full Name" name=clientName aria-label="Client Full Name" aria-describedby="basic-addon11" value="{{ (isset($client)) ? $client->CLNT_NAME : old('clientName')}}" required>
                        </div>
                        <small> {{$errors->first('clientName')}} </small>
                    </div>
                    <div class="form-group">
                        <label>نوع العميل</label>
                        <div class="input-group mb-3">
                            <select name=clientType class="select form-control custom-select" style="width: 100%; height:36px;" required>
                              <option disabled>اختر نوع الحساب</option>

                              <option value="18"
                                @if(isset($client) && ($client->CLNT_ACTP == 18))
                                  selected
                                @endif
                              >عيار ١٨
                              </option>
                              <option value="21"
                                @if(isset($client) && ($client->CLNT_ACTP == 21))
                                  selected
                                @endif
                              >عيار ٢١
                             </option>

                            </select>
                        </div>
                        <small>{{$errors->first('clientType')}}</small>
                    </div>


                    <div class="form-group">
                      <div>رصيد الذهب</div>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon11"><i class="fas fa-gem"></i></span>
                          </div>
                          <input type="number" step="0.01" class="form-control" placeholder="Client Gold Balance" name=clientGold aria-label="Client Gold Balance" aria-describedby="basic-addon11" value="{{ (isset($client)) ? $client->CLNT_CRGD : old('clientGold')}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <div>رصيد نقدي</div>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon11"><i class="fas fa-donate"></i></span>
                          </div>
                          <input type="number" step="0.01" class="form-control" placeholder="Client Money Balance" name=clientMoney aria-label="Client Money Balance" aria-describedby="basic-addon11" value="{{ (isset($client)) ? $client->CLNT_CRMN : old('clientMoney')}}">
                      </div>
                    </div>

                    <div class="form-group">
                        <label>رقم العميل</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-cellphone"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Client Mobile Number" name=clientMob aria-label="Client Mobile Number" aria-describedby="basic-addon11" value="{{ (isset($client)) ? $client->CLNT_MOB : old('clientMob')}}">
                        </div>
                        <small> {{$errors->first('clientMob')}} </small>
                    </div>

                    <div class="form-group">
                        <label>عنوان العميل</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-google-maps"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Client Address" name=clientAddress aria-label="Client Address" aria-describedby="basic-addon11" value="{{ (isset($client)) ? $client->CLNT_ADRS : old('clientAddress')}}" >
                        </div>
                        <small> {{$errors->first('clientAddress')}} </small>
                    </div>

                    <div class="form-group">
                        <label>الرقم التجاري</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-barcode-scan"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Client Commercial Serial Number" name=clientScid aria-label="Client Commercial Serial Number" aria-describedby="basic-addon11" value="{{ (isset($client)) ? $client->CLNT_SCID : old('clientScid')}}" >
                        </div>
                        <small> {{$errors->first('clientScid')}} </small>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Comment</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon22"><i class="fas fa-list-ul"></i></span>
                            </div>
                            <input type="text" class="form-control" name=clientComment placeholder="Client Comment" aria-label="Client Comment" aria-describedby="basic-addon22" value="{{ (isset($client)) ? $client->CLNT_CMNT : old('CLNT_CMNT')}}" >
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{url('clients/show') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
