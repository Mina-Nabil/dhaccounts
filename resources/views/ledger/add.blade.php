@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافه يوميه</h4>
                <form class="form pt-3" method="post" action="{{ $formURL }}" enctype="multipart/form-data" >
                @csrf
                    <div class="form-group">
                        <label>اسم العميل*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-account"></i></span>
                            </div>
                            <select class="select2 form-control  custom-select" style="height:50px;"  name="clientID" id=clientSelect onchange="setGoldVisible()" required >
                            <option selected disabled>اختر العميل</option>
                            <option value=0>بدون عميل</option>
                            @foreach($Clients as $client)
                            <option value="{{ $client->id }}">
                              {{$client->CLNT_NAME}} - {{$client->CLNT_ACTP}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <small> {{$errors->first('clientName')}} </small>
                    </div>

                    <div id=yesClient  style="display:none;"  class="form-group">
                      <label>الذهب</label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon11"><i class="fas fa-gem"></i></span>
                          </div>
                          <input type="number" min=0 step="0.01" class="form-control"  placeholder="Gold Entry" name=Gold  aria-label="Gold Entry" aria-describedby="basic-addon11" value="{{  old('ledgerGold')}}">
                      </div>
                      <div class="row col-sm-8">
                          <div class="custom-control custom-radio">
                              <input type="radio" id="goldRadio1" name="goldRadio" value="1" class="custom-control-input" checked>
                              <label class="custom-control-label p-l-30" for="goldRadio1">داخل</label>
                          </div>
                          <div class="custom-control custom-radio">
                              <input type="radio" id="goldRadio2" name="goldRadio" value="-1" class="custom-control-input">
                              <label class="custom-control-label p-l-30" for="goldRadio2">خارج</label>
                          </div>
                        </div>
                    </div>

                    <div id=noClient  style="display:none;"  class="form-group">
                      <label>ذهب ١٨</label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon11"><i class="fas fa-gem"></i></span>
                          </div>
                          <input type="number" min=0 step="0.01" class="form-control" placeholder="Gold 18 Entry" name=Gold18 aria-label="Gold 18 Entry" aria-describedby="basic-addon11" value="{{  old('Gold18')}}">
                      </div>
                      <div class="row col-sm-8">
                          <div class="custom-control custom-radio">
                              <input type="radio" id="gold18Radio1" name="gold18Radio" value="1" class="custom-control-input" checked>
                              <label class="custom-control-label p-l-30" for="gold18Radio1">داخل</label>
                          </div>
                          <div class="custom-control custom-radio">
                              <input type="radio" id="gold18Radio2" name="gold18Radio" value="-1" class="custom-control-input">
                              <label class="custom-control-label p-l-30" for="gold18Radio2">خارج</label>
                          </div>
                        </div>
                      <label>ذهب ٢١</label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon11"><i class="fas fa-gem"></i></span>
                          </div>
                          <input type="number" min=0 step="0.01" class="form-control" placeholder="Gold 21 Entry" name=Gold21 aria-label="Gold 21 Entry" aria-describedby="basic-addon11" value="{{  old('Gold21')}}">
                      </div>
                      <div class="row col-sm-8">
                          <div class="custom-control custom-radio">
                              <input type="radio" id="gold21Radio1" name="gold21Radio" value="1" class="custom-control-input" checked>
                              <label class="custom-control-label p-l-30" for="gold21Radio1">داخل</label>
                          </div>
                          <div class="custom-control custom-radio">
                              <input type="radio" id="gold21Radio2" name="gold21Radio" value="-1" class="custom-control-input">
                              <label class="custom-control-label p-l-30" for="gold21Radio2">خارج</label>
                          </div>
                        </div>
                    </div>


                    <div class="form-group">
                      <label>قيد نقدي</label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon11"><i class="fas fa-donate"></i></span>
                          </div>
                          <input type="number" min=0 step="0.01" class="form-control" placeholder="Money Entry" name=Money aria-label="Money Entry" aria-describedby="basic-addon11" value="{{ old('Money')}}">
                      </div>
                      <div class="row col-sm-8">
                          <div class="custom-control custom-radio">
                              <input type="radio" id="moneyRadio1" name="moneyRadio" value="1" class="custom-control-input" checked>
                              <label class="custom-control-label p-l-30" for="moneyRadio1">داخل</label>
                          </div>
                          <div class="custom-control custom-radio">
                              <input type="radio" id="moneyRadio2" name="moneyRadio" value="-1" class="custom-control-input">
                              <label class="custom-control-label p-l-30" for="moneyRadio2">خارج</label>
                          </div>
                        </div>
                    </div>

                    <div class="form-group" id=noClient2 style="display:none" >
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="checkbox10" name=isGoldDiff value="check">
                            <label class="custom-control-label" for="checkbox10">&nbsp &nbsp &nbsp &nbsp فرق دهب </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Comment</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon22"><i class="fas fa-list-ul"></i></span>
                            </div>
                            <input type="text" class="form-control" name=ledgerComment placeholder="Enter Comment" aria-label="Enter Comment" aria-describedby="basic-addon22" value="{{ old('LDGR_CMNT')}}" >
                        </div>
                    </div>

                    <button type="submit" id=submit class="btn btn-success mr-2" disabled>Submit</button>
                    <a href="{{url('home') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>


function setGoldVisible(){
  if(document.getElementById("clientSelect").selectedIndex == 1){
    document.getElementById("submit").disabled = "";
    document.getElementById("yesClient").style.display = "none";
    document.getElementById("noClient").style.display = "";
    document.getElementById("noClient2").style.display = "none";
  }
  else {
    document.getElementById("submit").disabled = "";
    document.getElementById("noClient").style.display = "none";
    document.getElementById("yesClient").style.display = "";
    document.getElementById("noClient2").style.display = "";
  }
}


</script>

@endsection
