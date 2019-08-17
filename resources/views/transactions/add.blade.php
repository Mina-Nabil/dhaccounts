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
                        <label>من*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-account"></i></span>
                            </div>
                            <select class="select2 form-control  custom-select" style="height:55px;"  name="fromID" required >
                            <option selected disabled>اختر الورشه</option>
                            <option value=0>اليوميه</option>
                            @foreach($workshops as $workshop)
                            <option value="{{ $workshop->id }}">
                              {{$workshop->WKSP_NAME}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <small> {{$errors->first('fromID')}} </small>
                    </div>
                    <div class="form-group">
                        <label>الي*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-account"></i></span>
                            </div>
                            <select class="select2 form-control  custom-select" style="height:55px;"  name="toID"  required >
                            <option selected disabled>اختر الورشه</option>
                            <option value=0>اليوميه</option>
                            @foreach($workshops as $workshop)
                            <option value="{{ $workshop->id }}">
                              {{$workshop->WKSP_NAME}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <small> {{$errors->first('toID')}} </small>
                    </div>

                  <label>ذهب ١٨</label>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon11"><i class="fas fa-gem"></i></span>
                      </div>
                      <input type="number" min=0 step="0.01" class="form-control" placeholder="Gold 18 Entry" name=Gold18 aria-label="Gold 18 Entry" aria-describedby="basic-addon11" value="{{  (old('Gold18')) ? old('Gold18') : 0 }}">
                  </div>

                  <label>ذهب ٢١</label>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon11"><i class="fas fa-gem"></i></span>
                      </div>
                      <input type="number" min=0 step="0.01" class="form-control" placeholder="Gold 21 Entry" name=Gold21 aria-label="Gold 21 Entry" aria-describedby="basic-addon11" value="{{  (old('Gold21')) ? old('Gold21') : 0}}">
                  </div>

                    <div class="form-group">
                      <label>قيد نقدي</label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon11"><i class="fas fa-donate"></i></span>
                          </div>
                          <input type="number" min=0 step="0.01" class="form-control" placeholder="Money Entry" name=Money aria-label="Money Entry" aria-describedby="basic-addon11" value="{{ (old('Money')) ? old('Money') : 0}}">
                      </div>
                    </div>

					<div class="form-group"  >
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id=checkbox10 name=isSalary value="check">
                            <label class="custom-control-label" for="checkbox10">&nbsp &nbsp &nbsp &nbsp اجره </label>
                        </div>
                    </div>
                    <label>Comment</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-comment-text-outline"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Comment" name=comment aria-label="comment" aria-describedby="basic-addon11" value="{{ (old('comment')) ? old('comment') : '' }}">
                    </div>

                    <div class="form-group">
                        <label>صنف</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-account"></i></span>
                            </div>
                            <select class="select2 form-control  custom-select" style="height:55px;"  name="inventoryID"  >
                            <option selected disabled>اختر الصنف</option>
                            <option value=null>عملبه بدون اصناف</option>
                            @foreach($inventory as $item)
                            <option value="{{ $item->id }}">
                              {{$item->INVT_NAME}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <small> {{$errors->first('inventoryID')}} </small>
                    </div>

                    <label>كميه</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon11"><i class="mdi mdi-cart-outline"></i></span>
                        </div>
                        <input type="number" min=0 step="1" class="form-control" placeholder="Items Count" name=count aria-label="Count" aria-describedby="basic-addon11" value="{{ (old('count')) ? old('count') : 0 }}">
                    </div>


                    <button type="submit" id=submit class="btn btn-success mr-2">Submit</button>
                    <a href="{{url('home') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
