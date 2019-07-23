@extends('layouts.app')

@section('content')
<h4 class="d-inline m-b-15">الخزنه</h4>
<div class="card-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="icon-diamond"></i></h3>
                            <p class="text-muted">رصيد ذهب ٢١</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-primary"> {{number_format($maxLedger->LDGR_GD21_CURR)}} جم  </h2>
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
                            <h3><i class=" icon-diamond"></i></h3>
                            <p class="text-muted">رصيد ذهب ١٨</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-cyan"> {{number_format($maxLedger->LDGR_GD18_CURR)}} جم  </h2>
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
                            <h2 class="counter text-success"> {{number_format($maxLedger->LDGR_MONY_CURR)}} جنيه  </h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<h4 class="d-inline m-b-15">العملاء</h4>
<div class="card-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <p class="text-muted">اجمالي رصيد ذهب ٢١</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-primary"> {{number_format($clients['gold21'])}} جم  </h2>
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
                          <p class="text-muted">اجمالي رصيد ذهب ١٨</p>
                        </div>
                        <div class="ml-auto">
                          <h2 class="counter text-cyan"> {{number_format($clients['gold18'])}} جم  </h2>
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
                        <p class="text-muted">اجمالي رصيد نقديه</p>
                      </div>
                      <div class="ml-auto">
                        <h2 class="counter text-success"> {{number_format($clients['money'])}} جنيه  </h2>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
<h4 class="d-inline m-b-15">الورش</h4>
<div class="card-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <p class="text-muted">اجمالي رصيد ذهب ٢١</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-primary"> {{number_format($workshops['gold21'])}} جم  </h2>
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
                          <p class="text-muted">اجمالي رصيد ذهب ١٨</p>
                        </div>
                        <div class="ml-auto">
                          <h2 class="counter text-cyan"> {{number_format($workshops['gold18'])}} جم  </h2>
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
                        <p class="text-muted">اجمالي رصيد نقديه</p>
                      </div>
                      <div class="ml-auto">
                        <h2 class="counter text-success"> {{number_format($workshops['money'])}} جنيه  </h2>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
