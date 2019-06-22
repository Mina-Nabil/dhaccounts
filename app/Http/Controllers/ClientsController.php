<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Clients;

class ClientsController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }

    public function home($type = 0){
      switch ($type) {
        case 0:
          $Clients = Clients::getClients();
          break;

        case '18':
          $Clients = Clients::getClientsByType($type);
          break;

        case '21':
          $Clients = Clients::getClientsByType($type);
          break;

        default:
          $Clients = Clients::getClients();
          break;
      }

      $data['Clients'] = $Clients;
      return view('clients/home', $data);
    }

    public function add(){

      $data['pageTitle'] = 'اضافه عميل';
      $data['pageDescription'] = 'اضافه عميل جديد';
      $data['formURL'] = url('clients/insert');

      return view('clients/add', $data);
    }

    public function insert(Request $request){

      $validate = $request->validate([
        'clientName' => "required",
        'clientType' => "required"
      ]);

      $id = Clients::insertClient($request->clientName, $request->clientType, $request->clientGold, $request->clientMoney, $request->clientAddress, $request->clientMob, $request->clientScid, $request->clientComment);
      return redirect('clients/show');
    }

    public function edit($id){

      $data['client'] = Clients::getClient($id);

      $data['pageTitle'] =  'تعديل عميل';
      $data['pageDescription'] = 'تعديل العميل ' . '( '. $data['client']->CLNT_NAME . ' )' ;
      $data['formURL'] = url('clients/modify/' . $id);

      return view('clients/add', $data);
    }

    public function modify($id, Request $request){

      $validate = $request->validate([
        'clientName' => "required",
        'clientType' => "required"
      ]);

      $id = Clients::editClient($id, $request->clientName, $request->clientType, $request->clientGold, $request->clientMoney, $request->clientAddress, $request->clientMob, $request->clientScid, $request->clientComment);
      return redirect('clients/show');
    }
}
