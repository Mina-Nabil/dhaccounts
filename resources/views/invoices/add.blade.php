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
                    <div class="input-group col-lg-11 mb-3">
                      <label>اسم العميل  &nbsp</label>
                      <select class="select2 form-control  custom-select" style="height:50px;"  name="clientID" required>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}"
                          @if(isset($invoice) && $invoice['invoiceData']->INVC_CLNT_ID == $client->id)
                          selected
                          @endif
                           >{{$client->CLNT_NAME . ' ' . $client->CLNT_ACTP}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                    @if(isset($invoice['invoiceItems']) && count($invoice['invoiceItems']) > 0)

                    <div class="row ">
                      <label class="col-sm-12 nopadding" for="input-file-now-custom-1">تفاصيل الطلب</label>
                      <div class="col-lg-12" id="dynamicContainer"></div>
                      @foreach($invoice['invoiceItems'] as $key => $item)
                      <div class="form-group row col-lg-12 removeclass{{$key+1}}">

                        <div class="col-lg-1 ">
                          <div class="form-group">
                            <input value="{{$item->INIT_MLLI}}"  type="number" step="0.01" min=0 class="form-control" name="milli[]" placeholder="مللي">
                          </div>
                        </div>
                        <div class="col-lg-2 ">
                          <div class="form-group">
                            <input value="{{$item->INIT_GRAM}}" type="number" step="0.01" min=0  class="form-control" name="gram[]" placeholder="جرام">
                          </div>
                        </div>
                        <div class="col-lg-2 ">
                          <div class="form-group">
                            <input value="{{$item->INIT_CONT}}" type="number" step="0.01" min=1 class="form-control" name="count[]" placeholder="عدد">
                          </div>
                        </div>
                        <div class="col-lg-4 ">
                          <div class="form-group">
                            <select name="item[]" class="select form-control custom-select" required>
                              @foreach($inventory as $models)
                                <option value="{{$models->INVT_NAME}}"
                                  @if(strcmp($models->INVT_NAME, $item->INIT_ITEM)==0)
                                  selected
                                  @endif
                                  >{{$models->INVT_NAME . ' - عدد:  ' . $models->INVT_CONT}}</option>
                              @endforeach
                            </select>

                          </div>
                        </div>

                        <div class="col-sm-3 nopadding">
                          <div class="form-group">
                          <div class="input-group">
                              <input value="{{$item->INIT_PRCE}}" type="number" step=0.01 min=0 class="form-control" name="price[]" placeholder="فئه">
                            <div class="input-group-append">
                              @if(isset($invoice['invoiceItems'][$key+1]))
                              <button class="btn btn-danger" type="button"  onclick="remove_education_fields({{++$key}});"> <i class="fa fa-minus"></i> </button>
                              @else
                              <button class="btn btn-success" id="dynamicAddButton" type="button" onclick="education_fields();"><i class="fa fa-plus"></i></button>
                              @endif
                            </div>
                          </div>
                          </div>
                        </div>

                      </div>
                    @endforeach

                    </div>

                    @else
                    <div class="row">
                      <label class="col-sm-12 nopadding" for="input-file-now-custom-1">تفاصيل الطلب</label>
                      <div class="col-lg-12" id="dynamicContainer"></div>
                      <div class="col-lg-1 ">
                        <div class="form-group">
                          <input type="number" step="0.01" class="form-control" name="milli[]" min=0  placeholder="مللي">
                        </div>
                      </div>
                      <div class="col-lg-2 ">
                        <div class="form-group">
                          <input type="number" step="0.01" class="form-control" name="gram[]" min=0 placeholder="جرام">
                        </div>
                      </div>
                      <div class="col-lg-2 ">
                        <div class="form-group">
                          <input type="number" step="1" min=1 class="form-control" name="count[]" min=1  placeholder="عدد" required>
                        </div>
                      </div>
                      <div class="col-lg-4 ">
                        <div class="form-group">
                          <select name="item[]" class="select form-control custom-select" required>
                            @foreach($inventory as $models)
                              <option value="{{$models->INVT_NAME}}">
                                {{$models->INVT_NAME . ' - عدد:  ' . $models->INVT_CONT}}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                        <div class="col-sm-3 nopadding">
                          <div class="form-group">
                          <div class="input-group">
                              <input type="number" step=0.01 class="form-control" name="price[]" min=0  placeholder="فئه">
                            <div class="input-group-append">
                              <button class="btn btn-success" id="dynamicAddButton" type="button" onclick="education_fields();"><i class="fa fa-plus"></i></button>
                            </div>
                          </div>
                          </div>
                        </div>
                    </div>
                    @endif

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{route('home') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
