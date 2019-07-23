@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
<h4 class="d-inline m-b-15">الخزنه</h4>
<div class="card-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                          @if(!$clientPage)
                            <h3><i class="icon-diamond"></i></h3>
                            <p class="text-muted">رصيد ذهب ٢١</p>
                          @else
                          <h3><i class=" icon-book-open"></i></h3>
                          <p class="text-muted">نوع الحساب </p>
                          @endif
                        </div>
                        <div class="ml-auto">
                          @if(!$clientPage)
                            <h2 class="counter text-primary"> {{number_format($maxLedger->LDGR_GD21_CURR)}} جم  </h2>
                          @else
                            <h2 class="counter text-primary"> {{$client->CLNT_ACTP}} </h2>
                          @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                          @if(!$clientPage)
                            <h3><i class=" icon-diamond"></i></h3>
                            <p class="text-muted">رصيد ذهب ١٨</p>
                          @else
                            <h3><i class=" icon-diamond"></i></h3>
                            <p class="text-muted">رصيد ذهب</p>
                          @endif
                        </div>
                        <div class="ml-auto">
                          @if(!$clientPage)
                            <h2 class="counter text-cyan"> {{number_format($maxLedger->LDGR_GD18_CURR)}} جم  </h2>
                          @else
                            <h2 class="counter text-cyan"> {{number_format($client->CLNT_CRGD)}} جم  </h2>
                          @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Column -->

    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="fas fa-dollar-sign"></i></h3>
                            <p class="text-muted">رصيد نقديه</p>
                        </div>
                        <div class="ml-auto">
                          @if(!$clientPage)
                            <h2 class="counter text-success"> {{number_format($maxLedger->LDGR_MONY_CURR)}} جنيه  </h2>
                          @else
                            <h2 class="counter text-success"> {{number_format($client->CLNT_CRMN)}} جنيه  </h2>
                          @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- End Info box -->
<!-- ============================================================== -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اليوميه</h4>
                <h6 class="card-subtitle">عرض بيانات اليوميه</h6>
                <div class="table-responsive m-t-40">
                  @if($clientPage)
                  <input type=hidden  id="dt-header" value="

                        <th>اسم العميل</th>
                        <th > {{ $client->CLNT_NAME}}</th>
                        <th></th>
                        <th>رصيد ذهب</th>
                        <th >{{ number_format($client->CLNT_CRGD) }}</th>
                        <th>نقديه</th>
                        <th>{{number_format($client->CLNT_CRMN)}}</th>
                   ">
                   @endif
                    <table id="yomeya" class="table color-bordered-table table-striped full-color-table full-dark-table hover-table" data-display-length='50' data-order=[]  >
                        <thead>
                            <tr>
                                <th>تاريخ</th>
                                <th>العميل</th>
                                <th>٢١</th>
                                <th>١٨</th>
                                @if($clientPage)
                                <th>رصيد ذهب</th>
                                @endif
                                <th>نقديه</th>
                                @if($clientPage)
                                <th>رصيد نقديه</th>
                                @endif
                                @if(!$clientPage)
                                <th>اجمالي ٢١</th>
                                <th>اجمالي ١٨</th>
                                <th>اجمالي نقديه</th>
                                <th>User</th>
                                <th>حذف</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Ledger as $key => $ledgeraya)
                            <tr
                            @if(isset($ledgeraya->LDGR_CMNT))
                            title='{{$ledgeraya->LDGR_CMNT}}'
                            @endif
                            >
                                <td>{{$ledgeraya->LDGR_DATE}}</td>
                                  @if(isset($ledgeraya->LDGR_CLNT_ID))
                                  <td
                                  @if(isset($ledgeraya->LDGR_CMNT))

                                  title="{{$ledgeraya->LDGR_CMNT}}"
                                  @endif
                                  >
                                  <a href="{{url('ledger/show/' . $ledgeraya->LDGR_CLNT_ID)}}" >
                                  @if(isset($ledgeraya->LDGR_CMNT))<em>@endif
                                    {{$ledgeraya->CLNT_NAME . ' ' . $ledgeraya->CLNT_ACTP}}
                                    @if(isset($ledgeraya->LDGR_CMNT))</em>@endif
                                  </a>
                                  </td>
                                  @elseif(isset($ledgeraya->LDGR_CMNT))
                                  <td class="text-black" >
                                  {{$ledgeraya->LDGR_CMNT}}
                                  </td>
                                  @endif
                                <td>{{number_format($ledgeraya->LDGR_GD21_AMNT)}}</td>
                                <td>{{number_format($ledgeraya->LDGR_GD18_AMNT)}}</td>
                                @if($clientPage)
                                <td>{{number_format($ledgeraya->LDGR_GOLD_CLNT)}}</td>
                                @endif
                                <td>{{number_format($ledgeraya->LDGR_MONY_AMNT)}}</td>
                                @if($clientPage)
                                <td>{{number_format($ledgeraya->LDGR_MONY_CLNT)}}</td>
                                @endif
                                @if(!$clientPage)
                                <td>{{number_format($ledgeraya->LDGR_GD21_CURR)}}</td>
                                <td>{{number_format($ledgeraya->LDGR_GD18_CURR)}}</td>
                                <td>{{number_format($ledgeraya->LDGR_MONY_CURR)}}</td>
                                <td>{{$ledgeraya->username}}</td>
                                <td>
                                @if ($key==0 && !(isset($ledgeraya->LDGR_CMNT)
                                && strpos($ledgeraya->LDGR_CMNT, 'فاتوره') !== false
                                || strpos($ledgeraya->LDGR_CMNT, 'من اليوميه') !== false
                                || strpos($ledgeraya->LDGR_CMNT, 'من ورشه') !== false
                                )
                                )
                                  <a href="{{ url('ledger/delete') }}"  onclick="return confirm('هل انت متاكد انك تريد الغاء المعامله؟')"><img src="{{ asset('images/del.png') }}" width=25 height=25></img></a>
                                @endif
                                </td>
                                @endif
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($clientPage)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">كشف حساب</h4>
                <form class="form pt-3" method="post" action="{{ $clientFormURL }}" enctype="multipart/form-data" >
            @csrf

            <input type=hidden name=clientID value="{{$client->id}}">

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
